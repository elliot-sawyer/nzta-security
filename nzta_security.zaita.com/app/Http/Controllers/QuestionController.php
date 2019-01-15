<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade as PDF;

class QuestionController extends Controller
{
  protected $table_name_;
  protected $json_file_name_;
  protected $business_owner_approval_required = True;
  protected $ciso_approval_required = True;
  protected $security_architect_approval_required = True;
  protected $send_links_email_ = True;
  protected $requires_component_selection_task_ = False;
  
  /**
   * Load the intial page that displays basic information and
   * collects the user's details. These will be stored and used
   * to generate a uuid
   * we want answered
   * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
   */
  public function Index(Request $request) {    
    $request->session()->flush();
    $request->session()->regenerateToken();
    
    return view($this->view_prefix_.'.index')
      ->with('error', $request->session()->get('error', ''));
  }
  
  /**
   * This method kicks off our questionaire setup. We do this
   * so we can create the associated database records with the
   * submitter information. Then we automatically redirect to the
   * questions.
   * @param Request $request
   */
  public function Start(Request $request) {   
    $email = $request->get('email');
    $nzta = '@nzta.govt.nz';
    $zaita = '@zaita.com';
    if (!(substr($email, -strlen($nzta)) === $nzta) && !(substr($email, -strlen($zaita)) === $zaita)) {
      $request->flash();
      return back()->with('error', 'Email must be a valid @nzta.govt.nz email address');
    }    
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $request->flash();
      return back()->with('error', 'Email must be a valid @nzta.govt.nz email address');
    }
    
    // create new database record    
    $json = Storage::disk('local')->get($this->json_file_name_);
    
    $uuid = uniqid();
    $id = DB::table($this->table_name_)->insertGetId([
      'uuid' => $uuid,
      'name' => $request->get('product_name', ''),
      'submitter_name' => $request->get('name'),
      'submitter_role' => $request->get('role'),
      'submitter_email' => $request->get('email'),
      'data' => $json
    ]);
        
    $request->session()->put('id', $id);
    $request->session()->put('uuid', $uuid);
    
    if ($this->send_links_email_) {
      // email submitter details so they can use links
      // to check on status or edit questions    
//     Mail::to($email)
//     ->queue(new \App\Mail\SubmitterLinks($id, $uuid, $request->get('name'), $email, $this->title_));    
//     return view('Email.submitter_links')->with('id', $id)->with('name', $request->get('name'));
      \App\Jobs\SendLinkEmail::dispatch($this->url_prefix_, $this->title_, $this->logo_text_, $id, $uuid, $request->get('name'), $email, $this->title_);        
    }
    return redirect($this->url_prefix_.'/questions');
  }
  
  /**
   * Load the intial page that asks the user all of the questions
   * we want answered
   * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
   */
  public function Questions(Request $request) {
    $id = $this->get_id($request, True, True);
    
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    $recordArr = array($record->data);
    
    return view('common.question-list')
    ->with('inputJson', json_encode($recordArr))
    ->with('id', $id);
  }
  
  /**
   * Return JSON object containing all of the questions
   * @return mixed
   */
  public function Load_Questions(Request $request) {
    $id = $this->get_id($request, False, False);
    
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    $recordArr = $record->data;
    
    return response($recordArr)->header('Content-Type', 'application/json');
  }
  
  /**
   * This method takes the request and pulls the text from the
   * body to save in the database. Whenever a user updates a question
   * answer this is called asynchronously to update the database.
   *
   * This allows user to continue/edit/go-back etc.
   */
  public function Save_Answers(Request $request) {
    $id = $this->get_id($request, False);
    
    $json = json_decode(file_get_contents('php://input'));
    DB::table($this->table_name_)->where('id', $id)->update(['data' => json_encode($json)]);
        
    return response($json)->header('Content-Type', 'application/json');
  }
  
  /**
   * Allow the user to review their answers before they submit them
   * @param Request $request
   * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
   */
  public function Review_Answers(Request $request) {
    $id = $this->get_id($request, False);
    
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    $recordArr = json_decode($record->data);
    
    return view('common.review-answers')
    ->with('questions', $recordArr);
  }
  
  /**
   * This method will use the submit the approvals
   * based on flags setup by the child classes
   * submit the relevant approvals for this
   */
  public function Submit_For_Approval(Request $request) {
    $id = $this->get_id($request, False);
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    
    // Create The Tasks JSON
    $task_json = json_decode("{}");
    // populate it with existing objects. This is so we don't lose
    // any established and finished tasks
    if (isset($record->tasks) && $record->tasks)
      $task_json = json_decode($record->tasks);
    
    $data = json_decode($record->data);
    foreach ($data as $question) {      
      if (isset($question->answer) && $question->answer != '') {
        $answer = strtolower($question->answer);
        
        if (isset($question->actions)) {
          foreach($question->actions as $input) {
            if ($answer == strtolower($input->text) && strtolower($input->action) == "create_task") {
              // Handle the Information Classification Task
              if (strtolower($input->target) == "information_classification") {
                if (!isset($task_json->information_classification)) {
                  $uuid = uniqid();
                  $task_id = DB::table('information_classification_tasks')->insertGetId([
                    'uuid' => $uuid,
                    'result' => 'pending',
                    'parent_id' => $id,
                    'parent_table' => $this->table_name_,
                    'parent_summary_url' => '/'.$this->url_prefix_.'/summary?id='.$id
                  ]);
                                  
                  $task_json->information_classification = array();
                  $task_json->information_classification['id'] = $task_id;
                  $task_json->information_classification['uuid'] = $uuid;
                  $task_json->information_classification['status'] = 'pending';                  
                }
              } // if (strtolower($input->target) == "information_classification") 
            } // if ($answer == strtolower($input->text) && strtolower($input->action) == "create_task")
          } // foreach($question->actions as $input) {
        } // if (isset($question->actions)) {
      } // if (isset($question->answer) && $question->answer != '')
    } // foreach ($data as $question) 
        
    //
    DB::table($this->table_name_)
    ->where('id', $record->id)
    ->update(['tasks' => json_encode($task_json)]);   
    
    // Send Email With Task Links
    if (isset($task_json->information_classification)) {
      $tasks = array();
      $tasks[0] = array();
      $tasks[0]['name'] = 'Information Classification';
      $tasks[0]['url'] = 'tasks/information-classification?id='.$task_json->information_classification['id'].'&uuid='
        .$task_json->information_classification['uuid'];
      
      Mail::to($record->submitter_email)
      ->send(new \App\Mail\TaskLinks($record->submitter_name, $record->id, $this->url_prefix_, $this->title_, $this->logo_text_, $tasks));
    }
    
    // TODO: Queue these
    if ($this->business_owner_approval_required)
      $this->create_business_owner_approval($id, $record, $request);
    if ($this->ciso_approval_required)
      $this->create_ciso_approval($id, $record, $request);
    
    return redirect($this->url_prefix_.'/summary');    
  }
      
  /**
   * Download a PDF
   * @param Request $request
   */
  public function Download_Pdf(Request $request) {
    $id = $this->get_id($request, True, False);
        
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    $recordArr = json_decode($record->data);
     
    $pdf = PDF::loadView('common.download-pdf', ['questions' => $recordArr, 'record' => $record]);
    return $pdf->download($this->url_prefix_.'-request-form.pdf');
  }
  
  
  /**
   * Summary Page
   */
  public function Summary(Request $request) {
    $id = $this->get_id($request, True, False);
    
    $record = DB::table($this->table_name_)->where('id', $id)->first();    
    $ciso_approval = '';
    if (isset($record->ciso_approval)) {
      $ciso_approval = json_decode($record->ciso_approval);
    }
    
    $business_owner_approval = '';
    if (isset($record->business_owner_approval)) {
      $business_owner_approval = json_decode($record->business_owner_approval);
    }
    
    $architect_approvals = '';
    if (isset($record->security_architect_approval)) {
      $architect_approvals = json_decode($record->security_architect_approval);
    }
    
    return view('common.summary')
    ->with('record', $record)
    ->with('ciso_approval', $ciso_approval)
    ->with('business_owner_approval', $business_owner_approval)
    ->with('security_architect_approva', $architect_approvals);
  }
  
  /**
   * This method will create the database json object for the
   * CISO approval, store it in the database field ciso_approval
   * and then email the CISO for approval
   */
  protected function create_ciso_approval(int $id, object $record, Request $request) {
    $recordArr = json_decode($record->data);
    
    $ciso_json = array();
    $ciso_json['uuid'] = uniqid();
    $ciso_json['name'] = Config::get('constants.ciso_name');
    $ciso_json['approved'] = 'pending';
    $ciso_email = Config::get('constants.ciso_email');
    $ciso_url = Config::get('app.url').'/'.$this->url_prefix_.'/ciso-approval?'.http_build_query(['id' => $record->id, 'uuid' => $ciso_json['uuid']]);
    
    DB::table($this->table_name_)
    ->where('id', $id)
    ->update(['ciso_approval' => json_encode($ciso_json)]);
    
    Mail::to($ciso_email)
    ->send(new \App\Mail\CISOApproval($record, $recordArr, $ciso_url, $this->title_, $this->logo_text_));
  }  
  
  /**
   * This method handles the approval for CISO. This is invoked when the
   * CISO clicks on the link provided in their email.
   * @param Request $request
   * @return string
   */
  public function Ciso_Approval(Request $request) {
    $id = $request->get('id', '');
    if ($id == '') {
      return "No such Proof of Concept ID exists";
    }
    
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    if (!$record) {
      return "No such Proof of Concept ID exists";
    }
    
    $ciso_approval = json_decode($record->ciso_approval);
    $uuid = $request->get('uuid', '');
    if ($uuid == '' || $uuid != $ciso_approval->uuid) {
      return "UUID is invalid";
    }
    
    $action = $request->get('action', '');
    if ($action == '') {
      return "No action has been provided";
    }
    
    $json = array();
    $json['uuid'] = $uuid;
    $json['name'] = Config::get('constants.ciso_name');
    $json['approved'] = 'pending';
    
    if ($action == 'approve') {
      $json['approved'] = 'approved';
    } else if ($action == 'deny') {
      $json['approved'] = 'denied';
    }
    
    DB::table($this->table_name_)->where('id', $id)->update(['ciso_approval' => json_encode($json)]);
    return redirect($this->url_prefix_.'/summary?id='.$id);
  }
  
  /**
   * This method will create the database json object for the
   * CISO approval, store it in the database field ciso_approval
   * and then email the CISO for approval
   */
  protected function create_business_owner_approval(int $id, object $record, Request $request) {
    $recordArr = json_decode($record->data);
    $business_owner = array();
    foreach($recordArr as $question) {
      if ($question->id == 'business_owner') {
        foreach($question->inputs as $input) {
          $business_owner[strtolower($input->name)] = $input->answer;
        }
        break;
      }
    }
    
    $business_owner_json = array();
    $business_owner_json['uuid']  = uniqid();
    $business_owner_json['name']  = $business_owner['full name'];
    $business_owner_json['role']  = $business_owner['role at nzta'];
    $business_owner_json['email'] = $business_owner['email'];
    $business_owner_json['approved'] = 'pending';
    $url = Config::get('app.url').'/'.$this->url_prefix_.'/business-owner-approval?'.http_build_query(['id' => $record->id, 'uuid' => $business_owner_json['uuid']]);
    
    DB::table($this->table_name_)
    ->where('id', $id)
    ->update(['business_owner_approval' => json_encode($business_owner_json)]);
    
    Mail::to($business_owner_json['email'])
    ->send(new \App\Mail\BusinessOwnerApproval($record, $recordArr, $url, $business_owner_json['name'], $this->title_, $this->logo_text_));
  }
  
  /**
   * This method processes the business owner approval. This is invokved when
   * the business owner clicks on the link provided in their email.
   */
  public function Business_Owner_Approval(Request $request) {
    $id = $request->get('id', '');
    if ($id == '') {
      return "No such Proof of Concept ID exists";
    }
    
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    if (!$record) {
      return "No such Proof of Concept ID exists";
    }
    
    $approval = json_decode($record->business_owner_approval);
    $uuid = $request->get('uuid', '');
    if ($uuid == '' || $uuid != $approval->uuid) {
      return "UUID is invalid";
    }
    
    $action = $request->get('action', '');
    if ($action == '') {
      return "No action has been provided";
    }
    
    $json = array();
    $json['uuid'] = $uuid;
    $json['name'] = $approval->name;
    $json['role'] = $approval->role;
    $json['email'] = $approval->email;
    $json['approved'] = 'pending';
    
    if ($action == 'approve') {
      $json['approved'] = 'approved';
    } else if ($action == 'deny') {
      $json['approved'] = 'denied';
    }
    
    DB::table($this->table_name_)->where('id', $id)->update(['business_owner_approval' => json_encode($json)]);
    return redirect($this->url_prefix_.'/summary?id='.$id);
  }
}

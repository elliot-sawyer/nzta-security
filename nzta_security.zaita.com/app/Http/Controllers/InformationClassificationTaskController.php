<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InformationClassificationTaskController extends QuestionController
{
  public function __construct() {
    $this->json_file_name_  = 'information-classification-questions.json';
    $this->table_name_      = 'information_classification_tasks';
    $this->view_prefix_     = 'InformationClassification';
    $this->url_prefix_      = 'tasks/information-classification';
    $this->title_           = 'NZTA SDLT - Information Classification Task';
    $this->logo_text_       = 'Information Classification Task';
    
    $this->business_owner_approval_required = False;
    $this->ciso_approval_required = False;
    $this->security_architect_approval_required = False;
    
    View::share('url_prefix', '/'.$this->url_prefix_);
    View::share('title', $this->title_);
    View::share('logo_text', $this->logo_text_);    
  }
  
  public function Index(Request $request) {
    $request->session()->flush();
    $request->session()->regenerateToken();
    
    $id = $this->get_id($request, True);
        
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    if (!$record) {
      return "No such Information Classification Task exists";
    }
    
    if (!isset($record->data)) {
      $json = Storage::disk('local')->get($this->json_file_name_);
      DB::table($this->table_name_)->where('id', $id)->update(['data' => $json]);      
    }
    
    return redirect($this->url_prefix_.'/questions');
  }
  
  public function finish(Request $request) {
    $id = $this->get_id($request, false);
    $result = $request->get('result');   
    
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    if (!$record) {
      return "No such Information Classification Task exists";
    }
    DB::table($this->table_name_)->where('id', $id)->update([ 'result' => $result ]);
        
    $parent = DB::table($record->parent_table)->where('id', $record->parent_id)->first();
    if (!$parent) {
      return "Could not find parent";
    }
    
    $task_array = json_decode($parent->tasks);
    $task_array->information_classification->status = $result;
    
    DB::table($record->parent_table)
    ->where('id', $record->parent_id)
    ->update(['tasks' => json_encode($task_array)]);  
    
    
    // Load parent and update task result
    $summary_url = $record->parent_summary_url;
    return redirect($summary_url);
  }
  
  
  
}

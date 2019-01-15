<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SolutionInitialRiskAssessmentController extends QuestionController
{
  public function __construct() {
    $this->json_file_name_  = 'solution-initial-risk-assessment-questions.json';
    $this->table_name_      = 'solution_initial_risk_assessment';
    $this->view_prefix_     = 'Solution.IRA';
    $this->url_prefix_      = 'solution-ira';
    $this->title_           = 'NZTA SDLT - Solution - Initial Risk Assessment';
    $this->logo_text_       = 'Solution - Initial Risk Assessment';
    
    $this->business_owner_approval_required = False;
    $this->ciso_approval_required = False;
    $this->security_architect_approval_required = False;
    
    $this->send_links_email_ = False;
    
    View::share('url_prefix', '/'.$this->url_prefix_);
    View::share('title', $this->title_);
    View::share('logo_text', $this->logo_text_);    
  }
  
   
  public function finish(Request $request) {
    $id = $this->get_id($request, false);
    $result = $request->get('result');   
    
    $record = DB::table($this->table_name_)->where('id', $id)->first();
    if (!$record) {
      return "No such solution initial risk assessment exists";
    }
    DB::table($this->table_name_)->where('id', $id)->update([ 'result' => $result ]);
    $record = DB::table($this->table_name_)->where('id', $id)->first();
        
    // Send Emails
//     Mail::to($record->submitter_email)
//     ->send(new \App\Mail\SolutionInitialRiskRating($this->url_prefix_, $this->title_, $this->logo_text_, $request->get('name'), $this->title_, $record));
    
    // Load parent and update task result
    return view($this->view_prefix_.".finish")
    ->with('record', $record);    
  }
}

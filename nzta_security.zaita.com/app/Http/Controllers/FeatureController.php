<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FeatureController extends QuestionController
{
  public function __construct() {
    $this->json_file_name_  = 'feature-questions.json';
    $this->table_name_      = 'feature';
    $this->view_prefix_     = 'Feature';
    $this->url_prefix_      = 'feature-bug-fix';
    $this->title_           = 'NZTA SDL - Feature/Bug-Fix Form';
    $this->logo_text_       = 'Feature or Bug Fix Implementation Request Form';
    
    $this->business_owner_approval_required = True;
    $this->ciso_approval_required = False;
    $this->security_architect_approval_required = True;
    
    View::share('url_prefix', '/'.$this->url_prefix_);
    View::share('title', $this->title_);
    View::share('logo_text', $this->logo_text_);
  }  
  
  public function Start(Request $request) {
    abort(404, "Not yet implemented");
  }  
}

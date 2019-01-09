<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SolutionController extends QuestionController
{
  public function __construct() {
    $this->json_file_name_  = 'solution-questions.json';
    $this->table_name_      = 'solution';
    $this->view_prefix_     = 'Solution';
    $this->url_prefix_      = 'solution';
    $this->title_           = 'NZTA SDL - Solution/Product/Project Form';
    $this->logo_text_       = 'Product, Project or Solution Request Form';
    
    $this->business_owner_approval_required = True;
    $this->ciso_approval_required = True;
    $this->security_architect_approval_required = True;
    
    View::share('url_prefix', '/'.$this->url_prefix_);
    View::share('title', $this->title_);
    View::share('logo_text', $this->logo_text_);
  }
  
  public function Start(Request $request) {
    abort(404, "Not yet implemented");      
  }  
}

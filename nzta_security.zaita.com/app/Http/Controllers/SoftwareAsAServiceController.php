<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class SoftwareAsAServiceController extends QuestionController
{
  public function __construct() {
    $this->json_file_name_  = 'software-as-a-service-questions.json';
    $this->table_name_      = 'software_as_a_service';
    $this->view_prefix_     = 'SaaS';
    $this->url_prefix_      = 'software-as-a-service';
    $this->title_           = 'NZTA SDLT - Software as a Service Request Form';
    $this->logo_text_       = 'Software as a Service Request Form';
    
    $this->business_owner_approval_required = True;
    $this->ciso_approval_required = False;
    $this->security_architect_approval_required = True;
    
    View::share('url_prefix', '/'.$this->url_prefix_);
    View::share('title', $this->title_);
    View::share('logo_text', $this->logo_text_);
  } 
}

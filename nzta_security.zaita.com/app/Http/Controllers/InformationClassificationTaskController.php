<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class InformationClassificationController extends QuestionController
{
  public function __construct() {
    $this->json_file_name_  = 'information-classification-questions.json';
    $this->table_name_      = 'information_classification_tasks';
    $this->view_prefix_     = 'InformationClassification';
    $this->url_prefix_      = 'tasks/information-classification';
    
    View::share('url_prefix', '/'.$this->url_prefix_);
    View::share('title', 'NZTA SDL - Information Classification Task');
    View::share('logo_text', 'Information Classification Task');
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProofOfConceptController extends QuestionController
{
  public function __construct() {    
    $this->json_file_name_  = 'proof-of-concept-questions.json';
    $this->table_name_      = 'proof_of_concept';
    $this->view_prefix_     = 'POC';
    $this->url_prefix_      = 'proof-of-concept';
    $this->title_           = 'NZTA SDLT - Proof of Concept/Software Trial Form';
    $this->logo_text_       = 'Proof of Concept or Software Trial Request Form';
    
    $this->business_owner_approval_required = True;
    $this->ciso_approval_required = True;
    $this->security_architect_approval_required = False;
    
    View::share('url_prefix', '/'.$this->url_prefix_);
    View::share('title', $this->title_);  
    View::share('logo_text', $this->logo_text_);
  } 
  
  public function Test(Request $request) {    
    return view('test')->with('sa', Config::get('constants.security_architects'));
  }
  
}


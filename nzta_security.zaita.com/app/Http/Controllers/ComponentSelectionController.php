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

class ComponentSelectionController extends Controller
{
  protected $table_name_;
  
  public function __construct() {
    $this->view_prefix_     = 'Component';
    $this->url_prefix_      = 'component-selection';
    $this->title_           = 'NZTA SDL - Component Selection Form';
    $this->logo_text_       = 'Component Selection Form';
    $this->table_name_      = 'component_selection';
    
    View::share('url_prefix', '/'.$this->url_prefix_);
    View::share('title', $this->title_);
    View::share('logo_text', $this->logo_text_);
  }
  
  /**
   * This method handles loading the Initial Risk Assessment
   * index page
   * @param Request $request
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
    $json = json_encode("{}");
    
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
    
    return redirect($this->url_prefix_.'/selection');
  }
  
  
  public function Selection(Request $request) { 
    $id = $this->get_id($request, True, True);
    
    return view($this->view_prefix_.'.selection')    
    ->with('id', $id);
  }
  
  /**
   * Load list of components from the database
   * @param Request $request
   * @return unknown
   */
  public function Load_Components(Request $request) {
    $id = $this->get_id($request, False, False);
    
    $record = json_encode(DB::table('component')->get());
        
    return response($record)->header('Content-Type', 'application/json');
  }
  
  /**
   * Load list of components from the database
   * @param Request $request
   * @return unknown
   */
  public function Load_Component_Controls(Request $request) {
    $id = $this->get_id($request, False, False);
    
    $component_id = DB::table('component')->where('name', $request->get('name'))->first()->id;
        
    $record = DB::table('component_control')->where('component_id', $component_id)->get();
    
    return response($record)->header('Content-Type', 'application/json');
  }
  
}

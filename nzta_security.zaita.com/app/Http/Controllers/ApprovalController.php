<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
  
  
  
  
  /**
   * This method will email the business owner and ciso for POC approval
   * {@inheritDoc}
   * @see \App\Http\Controllers\QuestionController::HandleApprovals()
   */
  protected function HandleApprovals(int $id, object $record, Request $request) {
    /**
     * Email Business Owner
     * @var Ambiguous $recordArr
     */
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
    ->send(new \App\Mail\ProofOfConceptBusinessOwnerApproval($record, $recordArr, $url, $business_owner_json['name']));
    
    /**
     * Email CISO
     * @var array $ciso_json
     */
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
    ->send(new \App\Mail\ProofOfConceptCISOApproval($record, $recordArr, $ciso_url));
    
    return redirect($this->url_prefix_.'/summary');
  }
  
  
  public function Test(Request $request) {
    
    
    return view('test')->with('sa', Config::get('constants.security_architects'));
  }
  
}


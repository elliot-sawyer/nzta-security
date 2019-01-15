<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $id;
    protected $uuid;
    protected $view_prefix_;
    protected $url_prefix_;
    protected $title_;
    protected $logo_text_;
    
    /**
     * This is a helper function to set verify and set the id and
     * uuid values for requests and the session. This is used by almost
     * every other method to validate the id. This has security functions
     * as it stops people from just changing the URL values.
     *
     * @param Request $request
     * @param bool $allow_request
     * @param bool $requires_uuid
     * @return int
     */
    public function get_id(Request $request, bool $allow_request, bool $requires_uuid = True) {
      $id = $allow_request ? $request->get('id', '') : '';
      $uuid = $allow_request ?  $request->get('uuid', '') : '';
      
      $id = $id == '' ? $request->session()->get('id', '') : $id;
      $uuid = $uuid == '' ? $request->session()->get('uuid', '') : $uuid;
      
      if ($id != '' && is_numeric($id)) {
        $record = DB::table($this->table_name_)->where('id', $id)->first();
        if (!$record)
          abort(404, "The id {$id} could not be found or is invalid");
          
          if ($requires_uuid && ($uuid == '' || $uuid != $record->uuid))
            abort(404, "The uuid {$uuid} does not match the private one established for the id {$id}");
      } else {
        if ($request->get('id', '') != '' && !$allow_request)
          abort(404, "Specifying id as a request parameter is not allowed for this operation");
          else
            abort(404, "No valid id has been provided to find relevent record");
      }
      
      $this->id = $id;
      $this->uuid = $uuid;
      $request->session()->put('id', $this->id);
      $request->session()->put('uuid', $this->uuid);
      
      return $this->id;
    }
}

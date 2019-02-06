@extends('app')

@section('js')
<script src="{{ secure_asset('js/component-handler.js') }}"></script>
@endsection

@section('content')
<div class="left-panel" style="float: left; width: 240px;">
	<div class="panel-default">
		<div class="panel-heading" class="panel-heading">Components:</div>
		<div class="panel-body">
			<ul style="padding-left: 20px;" id="component-list">				
			</ul>
		</div>
	</div>
	&nbsp;
</div>

<style>
div {
border: 0px solid black;
word-wrap: break-word;
}

a.clean-link {
  color: #000000;
  cursor: pointer;
}

#add-button {
  width: 15%;   
  background-color: #00AA00;
  color: #FFFFFF;
}

</style>

<div class="middle-panel">	
	<div class="panel-body">
    @include('common.errors')
    <input type="hidden" id="url_prefix" value="{{ $url_prefix }}"/>
    <input type="hidden" id="id" value="{{ $id }}"/>
    <div id="question_block">
      <div class="row" style="margin-top: 0px;">
      	<div class="col-sm-12 control-label">Component Search:</div>
      	<div class="col-sm-12 wow">
      	<input type="text" class="form-control" id="selection" name="selection" style="float: left; width: 80%"/>
      	<input type="button" id="add-button" value="Add" class="form-control"/>
      	</div>
      </div>    		
  		<div class="row" style="margin-top: 10px;"><div class="col-sm-12" id="question-input-error">&nbsp;</div></div>    				
    </div>
    Required Security Controls:<br/>
    <br/>    
    <div id="selected-components"></div> 
	</div>
</div>
@endsection
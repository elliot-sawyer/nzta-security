@extends('app')

@section('js')
<script src="{{ secure_asset('js/question-handler.js') }}"></script>
@endsection

@section('content')
<div class="left-panel" style="float: left; width: 240px;">
	<div class="panel-default">
		<div class="panel-heading" class="panel-heading">Questions:</div>
		<div class="panel-body">
			<ul style="padding-left: 20px;" id="question-list">				
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
</style>

<div class="middle-panel">	
	<div class="panel-body">
    @include('common.errors')
    <input type="hidden" id="url_prefix" value="{{ $url_prefix }}"/>
    <input type="hidden" id="id" value="{{ $id }}"/>
    <div id="question_block">
      <form class="form-horizontal">
    		<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">  		
    		<div class="row" style="margin-top: 10px; width: 720px;"><div class="col-sm-12 panel-heading" id="question-text">&nbsp;</div></div>
    		<div class="row" style="margin-top: 10px;"><div class="col-sm-12" id="question-description">&nbsp;</div></div>   
    		<div class="row" style="margin-top: 10px;"><div class="col-sm-12" id="question-input">&nbsp;</div></div> 		
    		<div class="row" style="margin-top: 10px;"><div class="col-sm-12" id="question-input-error">&nbsp;</div></div>   
  			<div class="row" style="margin-top: 5px;" id="answers">
  				<div class="col-sm-6" id="answer_1">Answer 1</div>
  				<div class="col-sm-6" id="answer_2">Answer 2</div>
  			</div>
  			<div class="row" style="margin-top: 10px;"><div class="col-sm-10 small" id="question-message" style="font-weight:bold;"></div>    				
  			</div>
      </form>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>    
    <div id="answers_debug" style="color: blue;"></div> 
</div>
</div>
@endsection
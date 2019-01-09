@extends('app')

@section('content')
<style>
div {
border: 0px solid black;
word-wrap: break-word;
}

.intro-box {
width: 30%;
vertical-align: middle;
margin: 0px 10px;
padding: 5px 5px;
}

.information-list {
  list-style: decimal; 
  padding-left: 15px;
  padding-top: 10px;
}

.information-list li {
margin-bottom: 20px;
}

.key-information {
  font-weight: bold;
  font-size: 20px;
  margin-bottom: 10px;
}
</style>


<div class="middel-panel">
<div class="intro-box">
<span class="key-information">Key Information:</span>
<ol class="information-list">
<li>This form will ask you a series of questions about the product you wish to concept/trial. Please ensure you have key
information about the product and people using it available before you start.</li>

<li>Completion of this form should take 15-30 minutes depending on the complexity of the product.</li>

<li>This form will be emailed to the relevant Transport Agency staff for approval. Approvals will be handled automatically
through this process and you will be contacted when they have been completed.</li>

<li>By entering your email address below, you will be emailed a link to this questionaire with a unique ID. This can be used
to review your answers, or finish the questionaire at a later date if you cannot complete it in one sitting.</li>
</ol>

<form action="/proof-of-concept/start" method="post">
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
<div class="row" style="margin-top: 0px;">
	<div class="col-sm-4 control-label">Your Name:</div>
	<div class="col-sm-6 wow"><input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required/></div>
</div>
<div class="row" style="margin-top: 0px;">
	<div class="col-sm-4 control-label">Your Role:</div>
	<div class="col-sm-6 wow"><input type="text" class="form-control" id="role" name="role" value="{{ old('role') }}" required/></div>
</div>
<div class="row" style="margin-top: 0px;">
	<div class="col-sm-4 control-label">Email Address:</div>
	<div class="col-sm-6 wow"><input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required/></div>
</div>
<div class="row" style="margin-top: 10px;">
	<div class="col-sm-10 small" id="question-message" style="font-weight:bold;">
	@include('common.errors')
	</div>
</div>
<div class="row" style="margin: 10px 10px;">
	<div class="col-sm-6"><input type="submit" class="btn btn-xs btn-primary-variant-1" value="Start"/></div>
</div>
</form>


</div>	
	
</div>
@endsection

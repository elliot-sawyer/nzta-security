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
<li>This form will ask you a series of questions about the feature or bug fix you wish to implement. Please ensure you have key
information about the feature and people using it available before you start.</li>

<li>Completion of this form should take 15-30 minutes depending on the complexity of the product. This form will
email you supplementary forms to fill out covering Privacy Impact Assessments etc.</li>

<li>This form will be emailed to the relevant Transport Agency staff for approval. Approvals will be handled automatically
through this process and you will be contacted when they have been completed.</li>

<li>By entering your email address below, you will be emailed a link to this questionaire with a unique ID. This can be used
to review your answers, or finish the questionaire at a later date if you cannot complete it in one sitting.</li>
</ol>

<form action="{{ $url_prefix }}/start" method="get">
<div class="row" style="margin-top: 0px;">
	<div class="col-sm-4 control-label">Your Name:</div>
	<div class="col-sm-6 wow"><input type="text" class="form-control" id="name" name="name" value=""/></div>
</div>
<div class="row" style="margin-top: 0px;">
	<div class="col-sm-4 control-label">Your Role:</div>
	<div class="col-sm-6 wow"><input type="text" class="form-control" id="role" name="role" value=""/></div>
</div>
<div class="row" style="margin-top: 0px;">
	<div class="col-sm-4 control-label">Email Address:</div>
	<div class="col-sm-6 wow"><input type="text" class="form-control" id="email" name="email" value=""/></div>
</div>
<div class="row" style="margin: 10px 10px;">
<div class="col-sm-6"><input type="submit" class="btn btn-xs btn-primary-variant-1" value="Start"/></div>
</div>
</form>


</div>	
	
</div>
@endsection

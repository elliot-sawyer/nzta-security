@extends('app')

@section('content')
@include ('common.question-responses')	
<script>
function edit_answers_click() {
  window.location.href = "questions";
}

function download_click() {
	 document.getElementById('my_iframe').src = '{{ $url_prefix}}/download-pdf';
}

function submit() {
  window.location.href = "submit-for-approval";
}
</script>
<div class="row" style="margin-top: 5px;" id="answers">
	<div class="col-sm-2" id="answer_1"><input type="button" class="btn btn-xs btn-primary-variant-1" style="margin-left: 10px" onclick="edit_answers_click();" value="Edit Answers"/></div>
	<div class="col-sm-2" id="answer_2"><input type="button" class="btn btn-xs btn-primary-variant-1" style="margin-left: 10px" onclick="download_click();" value="Download PDF"/></div>
	<div class="col-sm-2" id="answer_2"><input type="button" class="btn btn-xs btn-primary-variant-1" style="margin-left: 10px; background-color: #007700;" onclick="submit();" value="Submit for Approval"/></div>	
</div>
<iframe id="my_iframe" style="display:none;"></iframe>
@endsection

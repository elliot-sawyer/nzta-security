@extends('app')

@section('menu')
@endsection

@section('content')
<style>
div {
border: 0px solid black;
word-wrap: break-word;
}

.question {
 font-weight: 900;
 color: black;
}

.answer {
  padding-bottom: 25px;
  padding-top 0px;
}
</style>


<div class="middel-panel">	
	<div class="panel-body" style="padding-left: 10px;">
	<div class="row" style="margin-top: 10px; width: 720px;"><div class="col-sm-12 panel-heading" id="question-text">Proof of Concept Request Form - Review Responses</div></div>
    @foreach ($answers as $answer)
    <div class="row" style="margin-top: 10px; width: 720px;"><div class="col-sm-12 question" id="question-text">{{ $loop->index + 1 }}. {{ $answer['question'] }}</div></div>
    <div class="row" style="margin-top: 10px; width: 720px;"><div class="col-sm-12 answer" id="question-text">
    @isset($answer['answer'])
    	{{ $answer['answer'] }}<br/>
    @else
    	@isset($answer['answers'])
    		@foreach ($answer['answers'][0] as $key => $value)
    		{{ $key }} - {{ $value }}<br/>
    		@endforeach
    	@else
    	No answer provided.<br/>
    	@endisset    	
    @endisset
    </div></div>
    @endforeach
	</div>
</div>
<script>
function download_click() {
	 document.getElementById('my_iframe').src = '{{ $url_prefix}}/download-pdf';
}

</script>
<input type="button" class="btn btn-xs btn-primary-variant-1" style="margin-left: 10px" onclick="download_click();" value="Download PDF"/>
<iframe id="my_iframe" style="display:none;"></iframe>

<br/>
<br/>
@endsection

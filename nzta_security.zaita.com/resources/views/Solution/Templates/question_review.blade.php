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
	<div class="row" style="margin-top: 10px; width: 720px;"><div class="col-sm-12 panel-heading" id="question-text">Software as a Service Request Form - Review Responses</div></div>	
    @foreach ($questions as $question)
    <div class="row" style="margin-top: 10px; width: 720px;"><div class="col-sm-12 question" id="question-text">{{ $loop->index + 1 }}. {{ $question->question }}</div></div>
    <div class="row" style="margin-top: 10px; width: 720px;"><div class="col-sm-12 answer" id="question-text">
    @isset($question->answer)
    	{{ $question->answer }}<br/>
    @else    
      <?php 
      if (isset($question->inputs)) {
        foreach($question->inputs as $input) {
          if ($input->name == "Description") {
            if (isset($input->answer) and $input->answer != '')
              echo str_replace(PHP_EOL, '<br/>', $input->answer);
            else
              echo "No answer provided.<br/>";
          } else {
            if (isset($input->answer))
              echo $input->name." - ".$input->answer."<br/>";
            else
              echo $input->name." - No answer provided<br/>";
          }          
        }
      } else {
         echo "No answer provided.<br/>";
      } ?> 	
    @endisset
    </div></div>
    @endforeach
	</div>
</div>

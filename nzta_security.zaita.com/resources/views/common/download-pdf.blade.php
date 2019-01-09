<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta charset="utf-8">	
<style>
div, body {
border: 0px solid black;
word-wrap: break-word;
margin: 0px 0px 0px 0px;
}

.question {
 font-weight: 900;
 color: black;
}

.answer {
  padding-bottom: 25px;
  padding-top 0px;
}

.top_blue_bar {
content: '';
left: 0;
height: 49px;
width: 100%;
background-image: url({{ secure_asset('images/bg_pattern_coloured.png') }});
}

.footer_blue_bar {
content: '';
left: 0;
height: 49px;
width: 100%;
background-image: url({{ secure_asset('images/bg_pattern_coloured.png') }});
}

.logo_title_bar {
background-image: url({{ secure_asset('images/nzta_logo.png') }});
background-repeat: no-repeat;
height: 49px;
padding-left: 175px;
margin-left: 25px;
margin-top: 10px;
vertical-align: top;
margin-bottom: 25px;
}

.logo_text, .logo_sub_text {
color: rgb(0, 64, 113);
font-family: Montserrat, sans-serif ;
font-size: 20px;
font-style: normal;
font-weight: 300;
line-height: 20px;
}

.logo_sub_text {
font-size: 12px;
}

.response_row {
width: 100px;
display: block;
margin-top: 10px;
padding-left: 10px;
}

.question, .answer {
font-family: Montserrat, sans-serif;
font-size: 12px;
font-style: normal;
font-weight: 900;

}

.answer {
font-weight: 300;
}

.no_answer {
font-style: italic;
}

.copyright {
 color: #FFF;
 margin-left: 25px;
 padding-top: 10px;
}

.sign_offs {
margin-top: 50px;
color: rgb(0, 64, 113);
font-family: Montserrat, sans-serif ;
font-size: 20px;
font-style: normal;
font-weight: 300;
line-height: 20px;
}

.sign_off_box {
  border: 1px solid black;
  margin-top: 10px;
  margin-left: 10px;
  width: 300px;
  height: 150px;
  color: rgb(0, 0, 0);
  font-size: 12px; 
  position:relative;
  padding-left: 10px;
  vertical-align: bottom;
}

.role, .email {
font-family: Montserrat, sans-serif ;
font-size: 12px;
}

</style>
</head>
<!-- The Main Wrapper -->
<div class="page">
<div class="top_blue_bar"></div>
<div class="logo_title_bar"><span class="logo_text">{{ $title }}</span><br/>
<span class="logo_sub_text">Security Development Lifecycle Tool</span></div>       

<div class="answers">
<div class="response_row" style="margin-top: 10px; width: 720px;">
<span class="question">
A {{ $logo_text }} has been submitted by:<br/>
<span style="color: #0000AA">{{ $record->submitter_name }}</span></span><br/>
<span class="role">{{ $record->submitter_role }}</span><br/>
<span class="email">{{ $record->submitter_email }}</span>
</div>
<br/>
<div class="response_row" style="margin-top: 10px; width: 720px;">
<span class="question" style="color: #0000AA">Responses:</span></div>
    @foreach ($questions as $question)
        <div class="response_row" style="margin-top: 10px; width: 720px;"><span class="question">{{ $loop->index + 1 }}. {{ $question->question }}</span></div>
        <div class="response_row" style="margin-top: 10px; width: 720px;"><span class="answer">
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
        </span>
        </div>      
    @endforeach	
</div>
<div class="footer_blue_bar"><p class="copyright">&copy; 2019 | NZ Transporty Agency</p></div>
		
</div> <!--  Page  -->

</body>
</html>

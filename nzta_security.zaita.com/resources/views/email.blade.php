<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta charset="utf-8">	
	<link href="{{ secure_asset('css/shortcodes.css') }}" rel="stylesheet">
	<link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ secure_asset('css/private.css') }}" rel="stylesheet">		
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

.logo_title_bar {
background-image: url({{ secure_asset('images/nzta_logo.png') }});
background-repeat: no-repeat;
background-position: 10px 0px;
height: 49px;
padding-left: 175px;
padding-top: 10px;
vertical-align: top;
padding-bottom: 50px;
border-bottom: 1px groove rgba(62, 69, 76, 0.3);
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
  padding-bottom: 25px;
  padding-top 0px;
}

.no_answer {
font-style: italic;
}

.copyright {
 color: #FFF;
 margin-left: 25px;
 padding-top: 10px;
}

div {
border: 0px solid black;
word-wrap: break-word;
}

.question {
 color: black;
}
</style>
</head>

<body>
<!-- The Main Wrapper -->
<div class="page">
<div class="top_blue_bar"></div>
<div class="logo_title_bar">
	<img src="{{ secure_asset('images/nzta_logo.png') }}" style="width: 0px;"/>
	<span class="logo_text">{{ $title }}</span><br/>
	<span class="logo_sub_text">Security Development Lifecycle Tool</span>
</div>     
    
<div class="content" style="padding-left: 10px;">
	@yield('content')<br/>
  Regards,<br/>
	<br/>
	<span lang="EN-US" style="font-size:8pt; font-family:&quot;Lucida Sans Unicode&quot;,sans-serif,serif,EmojiFont; color:rgb(118,146,60)">The Cyber Security Team&nbsp;</span>
	<p class="x_MsoNormal" style="margin:0cm 0cm 6pt; font-size:11pt; font-family:Calibri,sans-serif; color:rgb(33,33,33)"> <b><span style="font-size:8pt; font-family:&quot;Lucida Sans&quot;,sans-serif,serif,EmojiFont; color:rgb(0,69,107)">National Office</span></b><span style="font-size:8pt; font-family:&quot;Lucida Sans Unicode&quot;,sans-serif,serif,EmojiFont; color:rgb(118,146,60)">&nbsp;</span><b><span style="font-size:8pt; font-family:&quot;Lucida Sans&quot;,sans-serif,serif,EmojiFont; color:rgb(118,146,60)">/</span></b><span style="font-size:8pt; font-family:&quot;Lucida Sans Unicode&quot;,sans-serif,serif,EmojiFont; color:rgb(0,69,107)">&nbsp;50  Victoria Street,&nbsp;<br> Private Bag 6995, Wellington 6141, New Zealand</span></p>	
</div>
		
<!-- Footer -->
<div class="top_blue_bar"><p class="copyright">&copy; 2019 | NZ Transport Agency</p></div>
		
</div> <!--  Page  -->
</body>
</html>
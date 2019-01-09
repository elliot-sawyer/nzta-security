@extends('email')

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
	Hello {{ $name }},<br/>
	<br/>
	The following link is your unique link to the Proof of Concept/Software Trial questionaire. This link can be used to re-visit/edit
	answers you've supplied for questions. If you modify an answer you will be able to re-submit the form for approval.<br/>
	<br/>
	Link: <a href="{{ secure_url('/proof-of-concept/questions') }}?id={{ $id }}">{{ secure_url('/proof-of-concept/questions') }}?id={{ $id }}</a><br/>
	<br/>
	<br/>
	Regards,<br/>
	<br/>
	<span lang="EN-US" style="font-size:8pt; font-family:&quot;Lucida Sans Unicode&quot;,sans-serif,serif,EmojiFont; color:rgb(118,146,60)">The Cyber Security Team&nbsp;</span>
	<p class="x_MsoNormal" style="margin:0cm 0cm 6pt; font-size:11pt; font-family:Calibri,sans-serif; color:rgb(33,33,33)"> <b><span style="font-size:8pt; font-family:&quot;Lucida Sans&quot;,sans-serif,serif,EmojiFont; color:rgb(0,69,107)">National Office</span></b><span style="font-size:8pt; font-family:&quot;Lucida Sans Unicode&quot;,sans-serif,serif,EmojiFont; color:rgb(118,146,60)">&nbsp;</span><b><span style="font-size:8pt; font-family:&quot;Lucida Sans&quot;,sans-serif,serif,EmojiFont; color:rgb(118,146,60)">/</span></b><span style="font-size:8pt; font-family:&quot;Lucida Sans Unicode&quot;,sans-serif,serif,EmojiFont; color:rgb(0,69,107)">&nbsp;50  Victoria Street,&nbsp;<br> Private Bag 6995, Wellington 6141, New Zealand</span></p>
	</div>
</div>
@endsection

@extends('email')

@section('content')
<div class="middel-panel">	
	<br/>
	Hello {{ $name }},<br/>
	<br/>
	<span style="font-weight: bold">This is an automatically generated email from the Transport Agency Security Development Lifecycle Tool.</span><br/>
	<br/>
	You have submitted a {{ $title }}.<br/>
	As part of this process you have answered questions that require additional tasks to be completed.<br/>
	<br/>
	You need to complete the following tasks:<br/>
	<ul>
	<?php foreach($tasks as $task): ?>
	<li><a href="{{ secure_url('/'.$task['url']) }}">{{$task['name']}}</a></li>
	<?php endforeach;?>
	</ul>
	<br/>
	You can check the status of your tasks at the standard summary page by following  
	<a href="{{ secure_url($url_prefix.'/summary') }}?id={{ $id }}">this link.</a><br/>
	<br/>
	<br/>
	If you have any questions of concerns about this process, please email <a href="mailto:sdlt@nzta.govt.nz">sdlt@nzta.govt.nz</a>.<br/>	
</div>
@endsection

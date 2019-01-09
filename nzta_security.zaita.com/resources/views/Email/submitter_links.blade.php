@extends('email')

@section('content')
<div class="middel-panel">	
	<br/>
	Hello {{ $name }},<br/>
	<br/>
	<span style="font-weight: bold">This is an automatically generated email from the Transport Agency Security Development Lifecycle Tool.</span><br/>
	<br/>
	You have just started to work through the {{ $title }}.<br/>
	As part of this process you will be able to go back to modify your answers if required. To do that please use
	<a href="{{ secure_url($url_prefix.'/questions') }}?id={{ $id }}&uuid={{ $uuid }}">this link.</a><br/>
	<br/>	
	Once you have submitted the request for approval, you'll be able to check the status of approvals through 
	<a href="{{ secure_url($url_prefix.'/summary') }}?id={{ $id }}">this link.</a><br/>
	<br/>
	<br/>
	If you have any questions of concerns about this process, please email <a href="mailto:sdlt@nzta.govt.nz">sdlt@nzta.govt.nz</a>.<br/>	
</div>
@endsection

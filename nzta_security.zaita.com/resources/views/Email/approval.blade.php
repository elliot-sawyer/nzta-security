@extends('email')

@section('content')
Hello {{ $name }},<br/>
<br/>
Please review and approve the following {{ $logo_text }} that has been submitted by:<br/>
Name: {{ $submitter_name }}, {{ $submitter_role }}.<br/>
Email: {{ $submitter_email }}<br/>
<br/>
@include ('common.question_review')
<br/>
<a href="{{ $url }}&action=approve">Click here Approve</a> - <a href="{{ $url }}&action=deny">Click here to Deny</a><br/>
<br/>
To view the status of the other approvers please visit <a href="{{ secure_url($url_prefix.'/summary') }}?id={{ $id }}">this link.</a><br/><br/>
@endsection

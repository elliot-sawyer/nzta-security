@extends('app')

@section('content')
<div class="middel-panel">
<?php if (isset($record->name)):?>
Summary for {{ $record->name }}<br/>
<?php endif;?>
<span class="question">Request Information</span><br/>
Request submitted by: {{ $record->submitter_name }}<br/>
Role: {{ $record->submitter_role }}<br/>
Email: {{ $record->submitter_email }}<br/>
<br/>
<a href="{{ $url_prefix }}/download-pdf?id={{ $record->id }}">Download PDF of information submitted</a><br/>
<br/>
<br/>
<?php if (isset($record->tasks) && $record->tasks != ''):?>
<?php $tasks = json_decode($record->tasks); ?>
<span class="question">Tasks</span><br/>
	<?php if (isset($tasks->information_classification)): ?>
	Information Classification - {{ $tasks->information_classification->status }}<br/> 
	<?php endif;?>
<br/>
<br/>
<?php endif;?>
<span class="question">Approvals</span><br/>
<br/>
<?php if ($ciso_approval != ''):?>
Chief Information Security Officer - {{ $ciso_approval->name }} - <span class="question">
	<?php if (isset($ciso_approval->approved)):?>
{{ $ciso_approval->approved }}
	<?php else:?>
pending
	<?php endif;?>
	</span><br/>
<?php endif;?>
<?php if ($business_owner_approval != ''):?>
Business Owner - {{ $business_owner_approval->name }} - {{ $business_owner_approval->role }} - <span class="question">
	<?php if (isset($business_owner_approval->approved)):?>
{{ $business_owner_approval->approved }}
	<?php else:?>
pending
	<?php endif;?>
	</span><br/>
<?php endif;?>
</div>
@endsection
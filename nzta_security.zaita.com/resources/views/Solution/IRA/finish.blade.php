@extends('app')

@section('content')
<div class="middel-panel">
<?php if (isset($record->name)):?>
Summary for <span class="question">{{ $record->name }}</span><br/>
<br/>
<?php endif;?>
<span class="question">Request Information</span><br/>
Request submitted by: {{ $record->submitter_name }}<br/>
Role: {{ $record->submitter_role }}<br/>
Email: {{ $record->submitter_email }}<br/>
<br/>
<br/>
Thank you for completing the Solution - Initial Risk Assessment. These results have been emailed to yourself
and the Transport Agency Security Architects. These will be reviewed and appropriate security resources
will be assigned to your project.<br/>
<br/>
Your initial risk rating is <span class="question">{{ $record->result }}</span><br/>
<br/>
<br/>
<span class="question">Impact of this risk rating:</span><br/>
<br/>
<?php if ($record->result == 'High Risk'):?>
The delivery of this solution poses a High Risk to the Transport Agency. As such it is likely that your
project will have daily involvement with a security resource.<br/>
<br/>
A security resource will be assigned to review designs, attend project meetings and ensure the 
project is proceeding in line with Transport Agency and Government standards.

<?php elseif ($record->result == 'Medium Risk'):?>
The delivery of this solution poses a Medium Risk to the Transport Agency. As such it is likely that
your project will have weekly involvement with a security resource.<br/>
<Br/>
A security resource will be assigned to review designs, attend project meetings and ensure the 
project is proceeding in line with Transport Agency and Government standards.

<?php elseif ($record->result == 'Low Risk'):?>
The delivery of this solution poses a Low Risk to the Transport Agency. As such it is likely that
your project will have monthly involvement with a security resource.<br/>
<Br/>
A security resource will be assigned to your project. They will be available for queries/questions,
but will not attend project meetings etc.<br/>
<?php endif;?>
</div><br/>
<br/>
<br/>
Debug:<br/>
<?php echo session('id'); ?><br/>
<?php echo session('uuid'); ?><br/>
@endsection
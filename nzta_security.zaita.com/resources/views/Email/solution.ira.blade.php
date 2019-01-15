@extends('email')

@section('content')
<div class="middel-panel">	
	<br/>
	Hello {{ $name }},<br/>
	<br/>
	<span style="font-weight: bold">This is an automatically generated email from the Transport Agency Security Development Lifecycle Tool.</span><br/>
	<br/>
	You have submitted an initial risk assessment for the delivery of the solution.<br/>
	As part of this process you have answered questions that assign you deliverable a risk rating.<br/>
	<br/>
	Your risk rating is: <span style="font-weight: bold">{{ $record->result }}</span><br/><br/>
	<br/>
	<br/>
	<span style="font-weight: bold">Impact of this risk rating:</span><br/>
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
  but will not attend project meetings etc. We recommend keeping in touch with your security resource
  to ensure your design and delivery stays secure.<br/>
  <?php endif;?>
	<br/>
	<br/>
	If you have any questions of concerns about this process, please email <a href="mailto:sdlt@nzta.govt.nz">sdlt@nzta.govt.nz</a>.<br/>	
</div>
@endsection

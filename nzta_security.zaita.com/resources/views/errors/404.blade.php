@extends('app')

@section('content')
<div class="middel-panel">
<span class="question">An error has occurred while processing your request:</span><br/>
<br/>
<span class="answer">
<?php if (isset($exception) && $exception->getMessage() != ''): ?>
{{ $exception->getMessage() }}
<?php else: ?>
The page you are looking for cannot be found. Please check the URL entered and try again.
<?php endif;?>
</span>
<br/>
<?php echo session('id');?><br/>
<?php echo session('uuid'); ?><br/>
</div>
@endsection
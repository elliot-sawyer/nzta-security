@if (isset($message) && $message != '')
    <!-- Form Error List -->
    <div class="alert alert-success" style="margin: 10px 10px 10px 10px">
        <strong>&raquo; {{$message}}</strong>
    </div>
@endif
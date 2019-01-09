@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger" style="margin: 10px 10px 10px 10px">
        <strong>Whoops! Something went wrong!</strong>
        <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>&raquo;&raquo; {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif (isset($error) && $error != '')
    <!-- Form Error List -->
    <div class="alert alert-danger" style="margin: 10px 10px 10px 10px">
        <strong>Whoops! Something went wrong!</strong>
        <br>
        <ul>
            <li>&raquo;&raquo; {{ $error }}</li>
        </ul>
    </div>
@endif
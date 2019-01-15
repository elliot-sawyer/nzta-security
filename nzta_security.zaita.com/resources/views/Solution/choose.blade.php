@extends('app')

@section('content')
<style>
div {
border: 0px solid black;
word-wrap: break-word;
}

.intro-box {
width: 30%;
vertical-align: middle;
margin: 0px 10px;
padding: 5px 5px;
}

.information-list {
  list-style: decimal; 
  padding-left: 15px;
  padding-top: 10px;
}

.information-list li {
margin-bottom: 20px;
}

.key-information {
  font-weight: bold;
  font-size: 20px;
  margin-bottom: 10px;
}

.btn-custom {
  margin-top: 10px;
}

</style>

<div class="middel-panel">
<div class="intro-box">
<span class="key-information">Please choose:</span>
<br/>
<br/>
If you are at the start of your Project and want to determine how much security involvement your
project needs please complete the:
<form action="/solution-ira" method="get">
<input type="submit" class="btn btn-xs btn-primary-variant-1 btn-custom" value="Initial Risk Assessment"/>
</form>
<br/>
<br/>
If you are building the project and want to now what controls you need to have in place for different
components of your solution, please complete the:
<form action="/component-selection" method="get">
<input type="submit" class="btn btn-xs btn-primary-variant-1 btn-custom" value="Component Selection"/>
</form>
<br/>
<br/>
If you have completed the high-level design for your solution and want to know what security requirements
you will have before you can deliver please complete the:
<form action="{{ $url_prefix }}" method="get">
<input type="submit" class="btn btn-xs btn-primary-variant-1 btn-custom" value="Solution Delivery Assessment"/>
</form>
</div>	
	
</div>
@endsection

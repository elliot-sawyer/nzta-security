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
</style>


<div class="middel-panel">
  <div class="intro-box">
  <span class="key-information">Approval has been sent.</span>
  </div>
</div>
@endsection

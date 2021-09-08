@extends('layouts.app')
@section('css')
    <style>

    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h6>Trace User by email only</h6>
        <div class="dropdown-item">
            <form action="/trace-user" method="post" id="trace-user">
                @csrf
                <div class="form-group">
                    <div class="form-group-item">
                        <label for="trace_email">Enter Email address: </label>
                        <input type="search" id="trace_email" placeholder="Enter email address" class="form-control" name="email_trace" autocomplete="off">
                    </div>
                    
                </div>
                <button id="start_tracking" type="submit" class="btn btn-success btn-sm">Start Tracking</button> 
            </form>
        </div>
    </div>
</div>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Task Managers 2020</div>
            <div>
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
    
@endsection

@section('scripts')
<script>
    // valid email address
$(document ).ready(function() {
    alert('ready');
    function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

// enable button if email is valid
  $('#trace_email').on('keyup', function(){
     var email = $(this).val();
     if(isValidEmailAddress(email)){
         $('#send_invite').prop('disabled', false);
     }else{
       $('#send_invite').prop('disabled', true);
     }
  });
  });

</script>
    
@endsection
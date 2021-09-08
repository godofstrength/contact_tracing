@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('statusmessages')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div id="success">

                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <p>To enable proper contact tracing, please update your location</p>
                    <button class="btn btn-success" id="update-location">Update my Location</button>
                </div>
                <div id="status">
              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  $( document ).ready(function() {
      $('#update-location').on('click', function(){
        navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
}) 
    
    function successFunction(position) {
    var lat = position.coords.latitude;
    var long = position.coords.longitude;
    var href =  `/update-location`;
    let token  = $('meta[name="csrf-token"]').attr('content');

    $('#status').html(`<div class="spinner-border" role="status">
  <span class="sr-only">Loading...</span>
</div>`);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'post',
        url: href,
        // let fd=new FormData();
        // fd.append(longitude, long)
        // fd.append(latitude, lat)
        data:{
            longitude : long,
            latitude: lat,
        },
        success: function(data){
                    var result = `<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    `+data['success']+`
                    </div>`
                    $('#status').html(result);
                 
                },
                error : function(data){
                    console.log(data);
                    var result = `<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    `+data.statusText+`
                    </div>`
                    $('#status').html(result);
                }
    })
  
}
 function errorFunction(position) {
    alert('please allow location');
    }


});
</script>
    
@endsection

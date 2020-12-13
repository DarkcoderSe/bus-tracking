@extends('layouts.user')
{{-- This page shows create page of drivers  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header p-1">
                    <div class="row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>
                                {{-- heading  --}}
                                 Vehicle Current Location 
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('admin/driver') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                            {{-- back button  --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Location: </strong> 
                      <span id="locationStr"></span>
                    </div>
                    
                    <script>
                      $(".alert").alert();
                    </script>
                    <div id="googleMap" style="width:100%;height:400px;"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script>
    var lat = {{ $vehicle->latitude }};
    var lon = {{ $vehicle->longitude }};

    function myMap() {
        var mapProp= {
        center:new google.maps.LatLng(lat,lon),
        zoom:5,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }

    // 
    var tokenGeo = 'pk.f7d9f53f456dd5fe54efce36b3827e4b';
    var urlGeo = `https://us1.locationiq.com/v1/reverse.php?key=${tokenGeo}&format=json&lat=${lat}&lon=${lon}`;    
    $.get(urlGeo, function(res){
        // console.log(res);
        $('#locationStr').text(res.display_name);
    });

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCH7NwmI6J1AfLef9DDhNbaRx0NqmvMOvY&callback=myMap"></script>
@endpush

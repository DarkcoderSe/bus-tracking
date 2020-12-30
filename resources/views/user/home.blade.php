@extends('layouts.user')

@section('pageTitle', 'Home - BTrack')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @php 
                        $user = Auth::user();
                        
                    @endphp
            @if($user->UserVehicle->Vehicle)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>Location: </strong> 
                <span id="locationStr"></span>
                
                <a href="{{ URL::to('user/vehicle/location', $user->UserVehicle->Vehicle->id) }}" class="btn btn-link btn-sm">
                    See Current Location on the Map
                </a>
              </div>
            @endif
              
            <div class="card">
                <div class="card-header">
                    <h4>Transport Information</h4>
                    <span class="text-muted">
                        You are registered in this current vehicle.
                    </span>
                </div>

                <div class="card-body p-0">
                    
                    @if($user->UserVehicle)
                    <table class="table table-striped m-0">
                        <tbody>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($user->UserVehicle && $user->UserVehicle->Vehicle->status)
                                    <span class="text-success">
                                        Active
                                    </span>
                                    @else 
                                    <span class="text-danger">
                                        Not-Active
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Registration No</th>
                                <td>
                                     {{ $user->UserVehicle->Vehicle->registration_no }}
                                </td>
                            </tr>
                            <tr>
                                <th>Driver Name</th>
                                <td>
                                     {{ $user->UserVehicle->Vehicle->Driver ? $user->UserVehicle->Vehicle->Driver->name : 'TBA' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Total Seats</th>
                                <td>
                                     {{ $user->UserVehicle->Vehicle->seats }}
                                </td>
                            </tr>
                            <tr>
                                <th>Route</th>
                                <td>
                                     {{ $user->UserVehicle->Vehicle->route }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h4>
                        Notifications & Updates
                    </h4>
                    
                </div>

                <div class="card-body">
                    @if($notifications->count() > 0)
                    @foreach($notifications as $not)
                    <b>{{ $not->title }} </b><br>
                    {{ $not->message }} <hr>
                    @endforeach
                    @else 
                    <p>
                        No notifications avialable!
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
<script>
    @if($user->UserVehicle->Vehicle)
    var lat = {{ $user->UserVehicle->Vehicle->latitude }};
    var lon = {{ $user->UserVehicle->Vehicle->longitude }};
    @endif
    $(document).ready(function(){
        var tokenGeo = 'pk.f7d9f53f456dd5fe54efce36b3827e4b';
        var urlGeo = `https://us1.locationiq.com/v1/reverse.php?key=${tokenGeo}&format=json&lat=${lat}&lon=${lon}`;    
        $.get(urlGeo, function(res){
            // console.log(res);
            $('#locationStr').text(res.display_name);
        });

    });
</script>
@endpush
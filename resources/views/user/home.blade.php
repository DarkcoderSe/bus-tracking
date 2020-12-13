@extends('layouts.user')

@section('pageTitle', 'Home - BTrack')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Transport Information</h4>
                    <span class="text-muted">
                        You are registered in this current vehicle.
                    </span>
                </div>

                <div class="card-body p-0">
                    @php 
                        $user = Auth::user();
                        
                    @endphp
                    @if($user->UserVehicle)
                    <table class="table table-striped m-0">
                        <tbody>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($user->UserVehicle->Vehicle->status)
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

@extends('layouts.driver')

@section('pageTitle', 'Home - BTrack')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>My Vehicle</h4>
                </div>

                <div class="card-body p-0">
                    @php 
                        $user = Auth::user();
                        
                    @endphp
                    @if($user->Vehicle)
                    <table class="table table-striped m-0">
                        <tbody>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($user->Vehicle->status)
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
                                     {{ $user->Vehicle->registration_no }}
                                </td>
                            </tr>
                          
                            <tr>
                                <th>Total Seats</th>
                                <td>
                                     {{ $user->Vehicle->seats }}
                                </td>
                            </tr>
                            <tr>
                                <th>Route</th>
                                <td>
                                     {{ $user->Vehicle->route }}
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

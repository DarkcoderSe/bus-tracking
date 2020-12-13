@extends('layouts.master')

{{-- This page shows the list of vehicles  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header p-1">
                    <div class="row">
                        {{-- URL::to is built in laravel function redirect to specific route  --}}
                        <div class="col-md-4">
                            <a href="{{ URL::to('admin/vehicle/create') }} " class="btn btn-success">
                                Add new vehicle
                            </a>
                            {{-- add new vehicle button  --}}
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>
                                Vehicles
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/home') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                            {{-- back button  --}}
                        </div>

                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped m-0">
                        <thead>
                            <tr>
                                {{-- vehicle info table heading  --}}
                                <th>Registration No.</th>
                                <th>Seats</th>
                                <th>Route</th>
                                <th>Status</th>
                                <th>Driver</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- running loop to show vehicle here  --}}
                            @foreach($vehicles as $vehicle)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('admin/vehicle/edit', $vehicle->id) }} ">
                                    {{ $vehicle->registration_no }}
                                    </a>
                                    {{-- vehicle edit page button  --}}
                                </td>
                                <td>
                                    {{ $vehicle->seats }}
                                </td>
                                <td>{{ $vehicle->route }} </td>
                                <td>{{ $vehicle->status == 1 ? 'Active' : 'Not Active' }} </td>
                                <td>{{ $vehicle->Driver->name }} </td>
                                <td>
                                    <a href="{{ URL::to('admin/vehicle/location', $vehicle->id) }}" class="btn btn-warning btn-sm">
                                        Current Location
                                    </a>
                                    <a href="{{ URL::to('admin/vehicle/delete', $vehicle->id) }} " class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                    {{-- vehicle delete button  --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

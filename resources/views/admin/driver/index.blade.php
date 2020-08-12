@extends('layouts.master')

{{-- This page shows the list of drivers  --}}
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
                            <a href="{{ URL::to('admin/driver/create') }} " class="btn btn-success">
                                Add new driver
                            </a>
                            {{-- add new driver button  --}}
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>
                                Drivers
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
                                {{-- driver info table heading  --}}
                                <th>Name</th>
                                <th>Contact No</th>
                                <th>Vehicle/Route</th>
                                <th>Status</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- running loop to show driver here  --}}
                            @foreach($drivers as $driver)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('admin/driver/edit', $driver->id) }} ">
                                    {{ $driver->name }}
                                    </a>
                                    {{-- driver edit page button  --}}
                                </td>
                                <td>
                                    {{ $driver->contact_no }}
                                </td>
                                <td>
                                    {{-- fetching the relationship record with driver  --}}
                                    {{ $driver->Vehicle->registration_no }} <br>
                                    <span class="small text-secondary">
                                        {{ $driver->Vehicle->route }}
                                    </span>
                                </td>
                                {{-- fetcing addtional driver info from driver info table  --}}
                                <td>{{ $driver->DriverInfo ? ($driver->DriverInfo->status == 1 ? 'Active' : 'Not Active') : '' }} </td>
                                <td>
                                    <a href="{{ URL::to('admin/driver/delete', $driver->id) }} " class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                    {{-- driver delete button  --}}
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

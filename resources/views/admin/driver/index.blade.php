@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-1">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ URL::to('/driver/create') }} " class="btn btn-success">
                                Add new Driver
                            </a>
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
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped m-0">
                        <thead>
                            <tr>
                                <th>Pciture</th>
                                <th>Name</th>
                                <th>Phone No.</th>
                                <th>Bus No.</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($drivers as $driver)
                            <tr>
                                <td>
                                    <img src="{{ URL::to('uploads/profilePicture', $driver->picture ? $driver->picture : '/404.png' ) }} " alt="loading.." style="width: 40px;">
                                </td>
                                <td>
                                    <a href="{{ URL::to('/driver/edit', $driver->id) }} ">
                                        {{ $driver->name }} {{ $driver->father_name }}
                                    </a>
                                </td>
                                <td>{{ $driver->phone_no }} </td>
                                <td>{{ $driver->Bus->name }} </td>
                                <td>
                                    <a href="{{ URL::to('/driver/delete', $driver->id) }} " class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
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

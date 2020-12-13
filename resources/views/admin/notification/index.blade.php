@extends('layouts.master')

{{-- This page shows the list of notifications  --}}
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
                            <a href="{{ URL::to('admin/notification/create') }} " class="btn btn-success">
                                Add new notification
                            </a>
                            {{-- add new notification button  --}}
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>
                                notifications
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
                                {{-- notification info table heading  --}}
                                <th>Title</th>
                                <th>Message</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- running loop to show notification here  --}}
                            @foreach($notifications as $notification)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('admin/notification/edit', $notification->id) }} ">
                                    {{ $notification->title }}
                                    </a>
                                </td>
                                <td>
                                    {{ $notification->message }}
                                </td>
                                <td>
                                    <a href="{{ URL::to('admin/notification/delete', $notification->id) }} " class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                    {{-- notification delete button  --}}
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

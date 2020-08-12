@extends('layouts.master')

{{-- This page shows the list of users  --}}
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
                            <a href="{{ URL::to('admin/user/create') }} " class="btn btn-success">
                                Add new user
                            </a>
                            {{-- add new user button  --}}
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>
                                Users (Faculty, Students)
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
                                {{-- user info table heading  --}}
                                <th>Name / Reg No.</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- running loop to show user here  --}}
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('admin/user/edit', $user->id) }} ">
                                    {{ $user->name }}
                                    </a><br>
                                    <span class="small text-secondary">
                                        {{ $user->reg_no }}
                                    </span>
                                    {{-- user edit page button  --}}
                                </td>
                                <td>
                                    {{ $user->contact_no }}
                                </td>
                                <td>
                                   {{ $user->email }}
                                </td>
                                <td>
                                    <a href="{{ URL::to('admin/user/delete', $user->id) }} " class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                    {{-- user delete button  --}}
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

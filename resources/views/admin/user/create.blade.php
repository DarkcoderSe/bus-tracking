@extends('layouts.master')
{{-- This page shows create page of users  --}}
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
                                Add New user.
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('admin/user') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                            {{-- back button  --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- creating form to submit data of user to controller  --}}
                    <form action="{{ URL::to('admin/user/submit') }} " method="post">
                        @csrf 
                        {{-- csrf is token for laravel form validation it is a security point --}}
                        <div class="form-row">
                            {{-- role of user html field  --}}
                            <div class="form-group col-md-6">
                                {{-- defining role here  --}}
                                <label>Role</label>
                                <select name="role" class="custom-select">
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                </select>

                                
                            </div>

                            {{-- role of user html field  --}}
                            <div class="form-group col-md-6">
                                {{-- defining role here  --}}
                                <label>Select Route</label>
                                <select name="vehicle_id" class="custom-select">
                                    @foreach($vehicles as $vehicle)
                                    {{-- showing the list of route and vehicles to link with user  --}}
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->registration_no }} - {{ $vehicle->route }}
                                    </option>
                                    @endforeach
                                </select>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('vehicle_id') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- first row  --}}
                        <div class="form-row">

                            {{-- registration number of user html field  --}}
                            <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>

                            {{-- contact_no of user html field  --}}
                            <div class="form-group col-md-4">
                                <label>Contact No.</label>
                                <input type="text" name="contact_no" class="form-control" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('contact_no') }}
                                </span>
                                @endif
                            </div>

                            {{-- reg no of user html field  --}}
                            <div class="form-group col-md-4">
                                <label>Reg. No.</label>
                                <input type="text" name="reg_no" class="form-control" required>
                                
                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('reg_no') }}
                                </span>
                                @endif
                            </div>

                        </div>

                        {{-- 2nd row  --}}
                        <div class="form-row">

                            {{-- email of user html field  --}}
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('email') }}
                                </span>
                                @endif
                            </div>

                            {{-- Password of user html field  --}}
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                {{-- setting default password 123456  --}}
                                <input type="text" name="password" class="form-control" value="123456" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('password') }}
                                </span>
                                @endif
                            </div>

                        </div>

                        {{-- 3rd row  --}}
                        <div class="form-row">
                            {{-- address of driver html field  --}}
                            <div class="form-group col-md-12">
                                <label>Address</label>
                                <textarea name="address" class="form-control"></textarea>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('address') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- saving form data to controller  --}}
                        <button type="submit" class="btn btn-primary">
                            Create User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

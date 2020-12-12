@extends('layouts.master')
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
                                Add New Driver.
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
                    {{-- creating form to submit data of driver to controller  --}}
                    <form action="{{ URL::to('admin/driver/submit') }} " method="post">
                        @csrf 
                        {{-- csrf is token for laravel form validation it is a security point --}}
                        {{-- first row  --}}
                        <div class="form-row">

                            {{-- registration number of driver html field  --}}
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

                            {{-- contact_no of driver html field  --}}
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

                            {{-- vehicle of driver html field  --}}
                            <div class="form-group col-md-4">
                                <label>Vehicle</label>
                                <select name="vehicle_id"  class="custom-select">
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->registration_no }}
                                    </option>
                                    @endforeach
                                </select>
                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('vehicle_id') }}
                                </span>
                                @endif

                                @if($vehicles->count() <= 0)
                                <span class="small text-secondary">
                                    Please add some <a href="{{ URL::to('/admin/vehicle') }} ">vehicles</a> first.
                                </span>
                                @endif
                            </div>

                        </div>

                        {{-- 2nd row  --}}
                        <div class="form-row">

                            {{-- email of driver html field  --}}
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

                            {{-- Password of driver html field  --}}
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" required>

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

                            {{-- license of driver html field  --}}
                            <div class="form-group col-md-4">
                                <label>License No.</label>
                                <input type="text" name="license_no" class="form-control" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('license_no') }}
                                </span>
                                @endif
                            </div>

                            {{-- experience of driver html field  --}}
                            <div class="form-group col-md-4">
                                <label>Experience</label>
                                <input type="text" name="experience" class="form-control" >

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('experience') }}
                                </span>
                                @endif
                            </div>

                            {{-- pay of driver html field  --}}
                            <div class="form-group col-md-4">
                                <label>Pay</label>
                                <input type="text" name="pay" class="form-control" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('pay') }}
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

                        {{-- status of driver checkbox  --}}

                        <div class="form-row">
                            <div class="form-check ml-2 mb-2">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="status" checked>
                                Active 
                              </label>
                            </div>
                        </div>

                        {{-- saving form data to controller  --}}
                        <button type="submit" class="btn btn-primary">
                            Submit Driver Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

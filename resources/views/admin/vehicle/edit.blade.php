@extends('layouts.master')
{{-- This page shows create page of vehicles  --}}
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
                                Modify Vehicle Record.
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('admin/vehicle') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                            {{-- back button  --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- creating form to submit data of vehicle to controller  --}}
                    <form action="{{ URL::to('admin/vehicle/update') }} " method="post">
                        @csrf 
                        {{-- adding new hidden field to specifiy the vehicle while updating it.  --}}
                        <input type="hidden" name="id" value="{{ $vehicle->id }}">
                        {{-- csrf is token for laravel form validation it is a security point --}}
                        {{-- first row  --}}
                        <div class="form-row">

                            {{-- registration number of vehicle html field  --}}
                            <div class="form-group col-md-4">
                                <label>Registration No.</label>
                                <input type="text" name="registration_no" class="form-control" value="{{ $vehicle->registration_no }}" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('registration_no') }}
                                </span>
                                @endif
                            </div>

                            {{-- seats of vehicle html field  --}}
                            <div class="form-group col-md-4">
                                <label>No. of Seats</label>
                                <input type="text" name="seats" class="form-control" value="{{ $vehicle->seats }}" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('seats') }}
                                </span>
                                @endif
                            </div>

                            {{-- driver of vehicle html field  --}}
                            <div class="form-group col-md-4">
                                <label>Driver</label>
                                <select name="driver_id" class="custom-select" required>
                                    <option value="{{ $vehicle->driver_id }}"> 
                                        {{ $vehicle->Driver->name }} - SELECTED
                                        {{-- getting select driver name  --}}
                                    </option>
                                    {{-- showing list of all drivers in select field  --}}
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }} "> {{ $driver->name }}</option>
                                    @endforeach
                                </select>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('driver_id') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- second row  --}}
                        <div class="form-row">

                            {{-- route of vehicle html field  --}}
                            <div class="form-group col-md-6">
                                <label>Route</label>
                                <textarea name="route" id="" cols="30" rows="5" class="form-control">{{ $vehicle->route }}</textarea>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('route') }}
                                </span>
                                @endif
                            </div>

                            {{-- description of vehicle html field  --}}
                            <div class="form-group col-md-6">
                                <label>Description</label>
                                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $vehicle->description }}</textarea>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('description') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- status of vehicle checkbox  --}}

                        <div class="form-row">
                            <div class="form-check ml-2 mb-2">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="status" {{ $vehicle->status == 1 ? 'checked' : '' }}>
                                Active
                              </label>
                            </div>
                        </div>

                        {{-- saving form data to controller  --}}
                        <button type="submit" class="btn btn-success">
                            Update Vehicle Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

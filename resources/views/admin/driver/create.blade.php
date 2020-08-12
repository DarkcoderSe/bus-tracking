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
                                <input type="text" name="registration_no" class="form-control" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('registration_no') }}
                                </span>
                                @endif
                            </div>

                            {{-- seats of driver html field  --}}
                            <div class="form-group col-md-4">
                                <label>No. of Seats</label>
                                <input type="text" name="seats" class="form-control" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('seats') }}
                                </span>
                                @endif
                            </div>

                            {{-- driver of driver html field  --}}
                            <div class="form-group col-md-4">
                                <label>Driver</label>
                                <select name="driver_id" class="custom-select">
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

                            {{-- route of driver html field  --}}
                            <div class="form-group col-md-6">
                                <label>Route</label>
                                <textarea name="route" id="" cols="30" rows="5" class="form-control"></textarea>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('route') }}
                                </span>
                                @endif
                            </div>

                            {{-- description of driver html field  --}}
                            <div class="form-group col-md-6">
                                <label>Description</label>
                                <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('description') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- status of driver checkbox  --}}

                        <div class="form-row">
                            <div class="form-check ml-2 mb-2">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="status" checked>
                                driver Status
                              </label>
                            </div>
                        </div>

                        {{-- saving form data to controller  --}}
                        <button type="submit" class="btn btn-primary">
                            Submit driver Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

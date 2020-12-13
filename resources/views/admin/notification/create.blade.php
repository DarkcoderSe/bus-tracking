@extends('layouts.master')
{{-- This page shows create page of notifications  --}}
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
                                Add New notification.
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('admin/notification') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                            {{-- back button  --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- creating form to submit data of notification to controller  --}}
                    <form action="{{ URL::to('admin/notification/submit') }} " method="post">
                        @csrf 
                 
                        {{-- first row  --}}
                        <div class="form-row">

                            {{-- registration number of notification html field  --}}
                            <div class="form-group col-md-12">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('title') }}
                                </span>
                                @endif
                            </div>


                        </div>


                        {{-- 3rd row  --}}
                        <div class="form-row">
                            {{-- address of driver html field  --}}
                            <div class="form-group col-md-12">
                                <label>Message</label>
                                <textarea name="message" class="form-control"></textarea>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('message') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- saving form data to controller  --}}
                        <button type="submit" class="btn btn-primary">
                            Create notification
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

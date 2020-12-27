@extends('layouts.driver')
{{-- This page shows create page of attendences  --}}
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
                                Add New Attendence.
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('driver/attendence') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                            {{-- back button  --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- creating form to submit data of attendence to controller  --}}
                    <form action="{{ URL::to('driver/attendence/submit') }} " method="post">
                        @csrf 

                        {{-- 3rd row  --}}
                        <div class="form-row">
                            {{-- address of attendence html field  --}}
                            <div class="form-group col-md-12">
                                <label>Notes</label>
                                <textarea name="note" class="form-control"></textarea>

                                {{-- checking validation errors for above field here  --}}
                                @if($errors->any())
                                <span class="small text-danger">
                                    {{ $errors->first('note') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Payment Status</th>
                                        <th>Attendence</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userVehicles as $userVehicle)
                                    <tr>
                                        <td>{{ $userVehicle->User->name ?? '' }} </td>
                                        <td>
                                            @if($userVehicle->User)
                                                @if($userVehicle->User->next_payment == '' || $userVehicle->User->next_payment < Carbon\Carbon::now())
                                                <span class='text-danger'>Not Paid</span>
                                                @else 
                                                <span class="text-success">Paid</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user[]" value="{{ $userVehicle->User->id ?? '' }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        {{-- saving form data to controller  --}}
                        <button type="submit" class="btn btn-primary">
                            Submit Attendence
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

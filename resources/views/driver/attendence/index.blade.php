@extends('layouts.driver')

{{-- This page shows the list of attendences  --}}
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
                            <a href="{{ URL::to('driver/attendence/create') }}" class="btn btn-success">
                                Add new attendence
                            </a>
                            {{-- add new attendence button  --}}
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>
                                Attendences
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/home') }}" class="btn btn-primary" style="float: right;">
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
                                {{-- attendence info table heading  --}}
                                <th>Note</th>
                                <th>Date</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- running loop to show attendence here  --}}
                            @foreach($attendences as $attendence)
                            <tr>
                                <td>
                                    {{ $attendence->note }}
                                    {{-- attendence edit page button  --}}
                                </td>
                                <td>
                                    {{ $attendence->created_at }}
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#aa{{ $attendence->id }}">
                                      Detail
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="aa{{ $attendence->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Attendence Detail </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
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
                                                            @php 
                                                                $fa = $attendence->Attendence->where('user_id', $userVehicle->User->id ?? '')->first();
                                                                // dd($fa);
                                                            @endphp 
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
                                                                    <input type="checkbox" name="user[]" value="{{ $userVehicle->User->id ?? '' }}" {{ $fa ? 'checked' : '' }} disabled>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

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

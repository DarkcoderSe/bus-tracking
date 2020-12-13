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
                                <th>Payment Status</th>
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
                                    @if($user->next_payment != '' || $user->next_payment > Carbon\Carbon::now())
                                    <span class="text-success">
                                        <b>Paid</b>
                                        <br>
                                        <span class="small text-muted">
                                            Next Payment: {{ $user->next_payment }}
                                        </span>
                                    </span>
                                    @else 
                                    <span class="text-danger">
                                        <b>Not Paid</b>
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#payment{{ $user->id }}">
                                      Add Payment
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="payment{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add new Payment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ URL::to('admin/user/payment/submit') }} " method="post" enctype="multipart/form-data">
                                                        @csrf 
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Amount</label>
                                                                <input type="text" name="amount" class="form-control">
                                                                @if($errors->any())
                                                                <span class="text-danger small">
                                                                    {{ $errors->first('amount') }}
                                                                </span>
                                                                @endif
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Challan Image/Pdf</label>
                                                                <input type="file" name="challan" class="form-control">
                                                                @if($errors->any())
                                                                <span class="text-danger small">
                                                                    {{ $errors->first('challan') }}
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">
                                                            Add
                                                        </button>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
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

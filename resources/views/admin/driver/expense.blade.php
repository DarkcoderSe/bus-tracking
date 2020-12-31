@extends('layouts.master')

@section('pageTitle', 'Expenses')
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
                            <!-- Button trigger modal -->
                            
                            {{-- add new user button  --}}
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>
                                {{ $user->name }}'s Expenses
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
                <div class="card-body p-0">
                    <table class="table table-striped m-0">
                        <thead>
                            <tr>
                                {{-- user info table heading  --}}
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Detail</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $total = 0;
                                $transactions = $user->Expenses;
                            @endphp 
                            {{-- running loop to show user here  --}}
                            @if($user->Expenses->count() > 0)
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>
                                    @if($transaction->type == '+')
                                    <span class="text-success">+ Added</span>
                                    @else
                                    <span class="text-danger">- Subtracted</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $transaction->amount }}
                                    @php 
                                        if($transaction->type == '+')
                                            $total += $transaction->amount;
                                        else 
                                            $total -= $transaction->amount;
                                    @endphp 
                                </td>
                                <td>
                                    {{ $transaction->title }}
                                </td>
                               
                            </tr>
                            @endforeach

                            <tr>
                                <th>Total</th>
                                <td class="pl-0">{{ $total }} Rupees
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            @else 
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h1>
                                        No Transactions Found!
                                    </h1>
                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.driver')

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
                            <a href="{{ URL::to('/driver/expense/create') }} " class="btn btn-primary btn-sm">
                                Add new Expense
                            </a>
                            {{-- add new user button  --}}
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>
                                Expenses
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
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Detail</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $total = 0;
                            @endphp 
                            {{-- running loop to show user here  --}}
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
                                <td>
                                    
                                    <a href="{{ URL::to('driver/expense/edit', $transaction->id) }} " class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{ URL::to('driver/expense/delete', $transaction->id) }} " class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                    {{-- user delete button  --}}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>Total</th>
                                <td class="pl-0">{{ $total }} Rupees
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

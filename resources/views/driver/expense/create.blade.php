@extends('layouts.driver')
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
                                Add New Expense.
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('driver/expense') }} " class="btn btn-primary" style="float: right;">
                                Back
                            </a>
                            {{-- back button  --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- creating form to submit data of user to controller  --}}
                    <form action="{{ URL::to('driver/expense/submit') }} " method="post">
                        @csrf 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Transaction Type</label>
                                <select name="type"  class="custom-select">
                                    <option value="+">+ Add</option>
                                    <option value="-">- Subtract</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Amount (Pkr)</label>
                                <input type="text" name="amount" class="form-control">
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Expense Detail *</label>
                                <textarea name="title"  class="form-control"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            Create new Expense
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

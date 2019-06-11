@extends('layouts.admin.master')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                @if(session('status'))
                                {{session('status')}}
                                @endif
                                @if($errors->all())
                                @foreach($errors->all() as $error)
                                <div class="alert alert-warning">{{$error}}</div>
                                @endforeach
                                @endif
                
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Add</strong>
                                        <small> User</small>
                                    </div>
                                    <form method="post">
                                        @csrf
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Name: </label>
                                            <input type="text" id="name" value="{{old('name')}}" placeholder="Enter Name" class="form-control" name="name">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class=" form-control-label">Email: </label>
                                            <input type="text" id="name" value="{{old('email')}}" placeholder="Enter Email" class="form-control" name="email">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">School: </label>
                                            <input type="text" name="school" value="{{old('school')}}" id="vat" placeholder="School" class="form-control">

                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class=" form-control-label">Department</label>
                                            <input type="text" id="street" placeholder="Enter Department name" class="form-control" name="department" value="{{old('department')}}">
                                           
                                        </div>
                                        <div class="form-group">
                                            <label for="account_number" class=" form-control-label">Account number: </label>
                                            <input type="text" id="account_number" value="{{old('account_number')}}" placeholder="Enter Account Number" class="form-control" name="account_number">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="bank" class=" form-control-label">Bank: </label>
                                            <input type="text" id="bank" value="{{old('bank')}}" placeholder="Enter Bank name" class="form-control" name="bank">
                                            
                                        </div>

                                        <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection
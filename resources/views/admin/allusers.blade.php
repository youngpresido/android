@extends('layouts.admin.master')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>School</th>
                                                <th>Department</th>
                                                <th>Referer code</th>
                                                <th>Bank</th>
                                                <th>Account Number</th>
                                                <th>Date created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($referers) < 1)
                                            <div class="alert alert-warning">
                                                No users yet
                                            </div>
                                            @else
                                            @foreach($referers as $referer)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$referer->name}}</td>
                                                <td>{{$referer->email}}</td>
                                                <td>{{$referer->school}}</td>
                                                <td>{{$referer->department}}</td>
                                                <td class="process">{{$referer->code}}</td>
                                                <td>{{$referer->bank}}</td>
                                                <td>{{$referer->account_number}}</td>
                                                <td>{{$referer->created_at->diffForHumans()}}</td>
                                               
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>

@endsection
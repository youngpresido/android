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
                                                <th>Referer's id</th>
                                                <th>Name</th>
                                                <th>Licence key</th>
                                                <th>status</th>
                                                <th>price</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($transactions)< 1)
                                            <div class="alert alert-primary">
                                                No pending transactions yet
                                            </div>
                                            @else
                                            @foreach($transactions as $transact)
                                            <tr>
                                                <td>{{$transact->referer->code}}</td>
                                                <td>{{$transact->referer->name}}</td>
                                                <td>{{$transact->reference}}</td>
                                                <td>{{$transact->status==0?"pending":"paid"}}</td>
                                                <td class="process">{{$transact->amount}}</td>
                                                <td>{{$transact->created_at->diffForHumans()}}</td>
                                                <td>
                                                    @if($transact->status==0)
                                                    <a href="{{URL('/pay/'.$transact->id)}}" class="btn btn-success">Pay</a>
                                                    @else
                                                    paid
                                                    @endif
                                                </td>
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
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">Buy licence key
                </div>
                @if(session('status'))
            <div class="alert alert-primary">
                {{session('status')}}
            </div>
            @endif
                <div class="card-body">
                <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                    @csrf
                <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" value="{{old('email')}}" name="email">
                    </div>
                    <div class="form-group">
                        <label>Referer's code</label>
                        <input type="text" class="form-control" placeholder="Referer's code" value="{{old('referer')}}" name="metadata">
                    </div>
        
                    <input type="hidden" name="amount" value="10000">
                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}">
                    <button type="submit" class="btn btn-primary">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

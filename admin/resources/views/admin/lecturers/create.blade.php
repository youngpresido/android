@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.lecturers.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.lecturers.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.lecturers.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name of lecturer', 'required' => '']) !!}
                    <p class="help-block">Name of lecturer</p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('school', trans('quickadmin.lecturers.fields.school').'', ['class' => 'control-label']) !!}
                    {!! Form::text('school', old('school'), ['class' => 'form-control', 'placeholder' => 'name of university  you are working']) !!}
                    <p class="help-block">name of university  you are working</p>
                    @if($errors->has('school'))
                        <p class="help-block">
                            {{ $errors->first('school') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('account_number', trans('quickadmin.lecturers.fields.account-number').'', ['class' => 'control-label']) !!}
                    {!! Form::number('account_number', old('account_number'), ['class' => 'form-control', 'placeholder' => 'your  account number']) !!}
                    <p class="help-block">your  account number</p>
                    @if($errors->has('account_number'))
                        <p class="help-block">
                            {{ $errors->first('account_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('quickadmin.lecturers.fields.email').'', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('bank', trans('quickadmin.lecturers.fields.bank').'', ['class' => 'control-label']) !!}
                    {!! Form::text('bank', old('bank'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('bank'))
                        <p class="help-block">
                            {{ $errors->first('bank') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('department', trans('quickadmin.lecturers.fields.department').'', ['class' => 'control-label']) !!}
                    {!! Form::text('department', old('department'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('department'))
                        <p class="help-block">
                            {{ $errors->first('department') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('referer_code', trans('quickadmin.lecturers.fields.referer-code').'', ['class' => 'control-label']) !!}
                    {!! Form::text('referer_code', old('referer_code'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('referer_code'))
                        <p class="help-block">
                            {{ $errors->first('referer_code') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


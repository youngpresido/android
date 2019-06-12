@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.lecturers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.lecturers.fields.name')</th>
                            <td field-key='name'>{{ $lecturer->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.lecturers.fields.school')</th>
                            <td field-key='school'>{{ $lecturer->school }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.lecturers.fields.account-number')</th>
                            <td field-key='account_number'>{{ $lecturer->account_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.lecturers.fields.email')</th>
                            <td field-key='email'>{{ $lecturer->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.lecturers.fields.bank')</th>
                            <td field-key='bank'>{{ $lecturer->bank }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.lecturers.fields.department')</th>
                            <td field-key='department'>{{ $lecturer->department }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.lecturers.fields.referer-code')</th>
                            <td field-key='referer_code'>{{ $lecturer->referer_code }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">Payment</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="payment">
<table class="table table-bordered table-striped {{ count($payments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.payment.fields.lecturer')</th>
                        <th>@lang('quickadmin.payment.fields.date')</th>
                        <th>@lang('quickadmin.payment.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($payments) > 0)
            @foreach ($payments as $payment)
                <tr data-entry-id="{{ $payment->id }}">
                    <td field-key='lecturer'>{{ $payment->lecturer->name or '' }}</td>
                                <td field-key='date'>{{ $payment->date }}</td>
                                <td field-key='status'>{{ $payment->status }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('payment_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.payments.restore', $payment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('payment_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.payments.perma_del', $payment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('payment_view')
                                    <a href="{{ route('admin.payments.show',[$payment->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('payment_edit')
                                    <a href="{{ route('admin.payments.edit',[$payment->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('payment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.payments.destroy', $payment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.lecturers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop



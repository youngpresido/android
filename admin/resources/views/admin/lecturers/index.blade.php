@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.lecturers.title')</h3>
    @can('lecturer_create')
    <p>
        <a href="{{ route('admin.lecturers.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('lecturer_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.lecturers.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.lecturers.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($lecturers) > 0 ? 'datatable' : '' }} @can('lecturer_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('lecturer_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.lecturers.fields.name')</th>
                        <th>@lang('quickadmin.lecturers.fields.school')</th>
                        <th>@lang('quickadmin.lecturers.fields.account-number')</th>
                        <th>@lang('quickadmin.lecturers.fields.email')</th>
                        <th>@lang('quickadmin.lecturers.fields.bank')</th>
                        <th>@lang('quickadmin.lecturers.fields.department')</th>
                        <th>@lang('quickadmin.lecturers.fields.referer-code')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($lecturers) > 0)
                        @foreach ($lecturers as $lecturer)
                            <tr data-entry-id="{{ $lecturer->id }}">
                                @can('lecturer_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='name'>{{ $lecturer->name }}</td>
                                <td field-key='school'>{{ $lecturer->school }}</td>
                                <td field-key='account_number'>{{ $lecturer->account_number }}</td>
                                <td field-key='email'>{{ $lecturer->email }}</td>
                                <td field-key='bank'>{{ $lecturer->bank }}</td>
                                <td field-key='department'>{{ $lecturer->department }}</td>
                                <td field-key='referer_code'>{{ $lecturer->referer_code }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('lecturer_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.lecturers.restore', $lecturer->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('lecturer_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.lecturers.perma_del', $lecturer->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('lecturer_view')
                                    <a href="{{ route('admin.lecturers.show',[$lecturer->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('lecturer_edit')
                                    <a href="{{ route('admin.lecturers.edit',[$lecturer->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('lecturer_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.lecturers.destroy', $lecturer->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('lecturer_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.lecturers.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection
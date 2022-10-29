<?php
$admin_name = app()->request->get('admin_name');
$klinik_name = app()->request->get('klinik_name');

$params = [];
if ($admin_name) {
    $params['admin_name'] = $admin_name;
}
if ($klinik_name) {
    $params['klinik_name'] = $klinik_name;
}
?>
@extends(env('ADMIN_TEMPLATE').'._base.layout')

@section('title', __('general.title_home', ['field' => $thisLabel]))

@section('css')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('general.title_home', ['field' => $thisLabel]) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo route('admin.profile.index') ?>"><i class="fa fa-user"></i> {{ __('general.profile') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('general.title_home', ['field' => $thisLabel]) }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                @if ($permission['create'])
                    <div class="card-header">
                        <a href="<?php echo route('admin.' . $thisRoute . '.create') ?>" class="mb-2 mr-2 btn btn-success"
                           title="@lang('general.create')">
                            <i class="fa fa-plus-square"></i> @lang('general.create')
                        </a>
                    </div>
                @endif
                    <form method="get">
{{--                        <div class="card-header">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <label for="filter_admin">{{ __('general.admin_name') }}</label>--}}
{{--                                    {{ Form::select('admin_name', $listSet['admin_name'], old('admin_name', $admin_name), ['class' => 'form-control select2', 'autocomplete' => 'off']) }}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <br/>--}}
{{--                                    <button class="mb-1 btn btn-primary btn-sm" type="submit"--}}
{{--                                            title="@lang('general.filter')">--}}
{{--                                        <i></i>--}}
{{--                                        @lang('general.filter')--}}
{{--                                    </button>--}}

{{--                                    <a href="<?php echo route('admin.' . $thisRoute . '.index') ?>" class="mb-1 btn btn-warning btn-sm" type="submit"--}}
{{--                                       title="@lang('general.reset')">--}}
{{--                                        <i></i>--}}
{{--                                        @lang('general.reset')--}}
{{--                                    </a>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </form>

            <!-- /.card-header -->
                <div class="card-body overflow-auto">
                    <table class="table table-bordered table-striped" id="data1">

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>

@stop

@section('script-bottom')
    @parent
    <script type="text/javascript">
        'use strict';
        let table;
        table = jQuery('#data1').DataTable({
            serverSide: true,
            processing: true,
            // pageLength: 25,
            // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: '{{ route('admin.' . $thisRoute . '.dataTable') }}{!! '?' . http_build_query($params) !!}',
            aaSorting: [ {!! isset($listAttribute['aaSorting']) ? $listAttribute['aaSorting'] : "[0,'desc']" !!}],
            columns: [
                    @foreach($passing as $fieldName => $fieldData)
                {data: '{{ $fieldName }}', title: "{{ __($fieldData['lang']) }}" <?php echo strlen($fieldData['custom']) > 0 ? $fieldData['custom'] : ''; ?> },
                @endforeach
            ],
            fnDrawCallback: function( oSettings ) {
                // $('a[data-rel^=lightcase]').lightcase();
            }
        });

        function actionData(link, method) {

            if(confirm('{{ __('general.ask_delete') }}')) {
                let test_split = link.split('/');
                let url = '';
                for(let i=3; i<test_split.length; i++) {
                    url += '/'+test_split[i];
                }

                jQuery.ajax({
                    url: url,
                    type: method,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {

                    },
                    complete: function(){
                        table.ajax.reload();
                    }
                });
            }
        }

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@stop

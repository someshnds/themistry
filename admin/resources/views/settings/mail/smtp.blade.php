@extends('layouts.settings.default')
@push('css_lib')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public/vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('public/vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('public/vendor/summernote/summernote-bs4.min.css')}}">
    {{--dropzone--}}
    <link rel="stylesheet" href="{{asset('public/vendor/dropzone/min/dropzone.min.css')}}">
@endpush
@section('settings_title',trans('lang.user_table'))
@section('settings_content')
    @include('flash::message')
    @include('adminlte-templates::common.errors')
    <div class="clearfix"></div>
    <div class="card shadow-sm">
        <div class="card-header">
            <ul class="nav nav-tabs d-flex flex-row align-items-start card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{!! url('settings/mail/smtp') !!}"><i class="fas fa-envelope mr-2"></i>{{trans('lang.app_setting_smtp')}}@if(setting('mail_driver') === 'smtp')
                            <span class="badge ml-2 badge-success">{{trans('lang.active')}}</span>@endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{!! url('settings/mail/mailgun') !!}"><i class="fas fa-envelope-o mr-2"></i>{{trans('lang.app_setting_mailgun')}}@if(setting('mail_driver') === 'mailgun')
                            <span class="badge ml-2 badge-success">{{trans('lang.active')}}</span>@endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{!! url('settings/mail/sparkpost') !!}"><i class="fas fa-envelope-o mr-2"></i>{{trans('lang.app_setting_sparkpost')}}@if(setting('mail_driver') === 'sparkpost')
                            <span class="badge ml-2 badge-success">{{trans('lang.active')}}</span>@endif
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            {!! Form::open(['url' => ['settings/update'], 'method' => 'patch']) !!}
            <div class="row">
                <!-- 'Boolean enable_facebook Field' -->
                <div class="col-12">
                    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
                        {!! Form::label('enable_email_notifications', trans("lang.app_setting_enable_email_notifications"),['class' => 'col-2 control-label text-right']) !!}
                        {!! Form::hidden('enable_email_notifications', 0, ['id'=>"hidden_enable_email_notifications"]) !!}
                        <div class="col-10 icheck-{{setting('theme_color')}}">
                            {!! Form::checkbox('enable_email_notifications', 1, setting('enable_email_notifications', false)) !!}
                            <label for="enable_email_notifications">{!! trans("lang.app_setting_enable_email_notifications_help") !!}</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column col-sm-12 col-md-6">
                {!! Form::hidden('mail_driver','smtp') !!}



                <!-- mail_host Field -->
                    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
                        {!! Form::label('mail_host', trans("lang.app_setting_mail_host"), ['class' => 'col-4 control-label text-right']) !!}
                        <div class="col-8">
                            {!! Form::text('mail_host', setting('mail_host'),  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_mail_host_placeholder")]) !!}
                            <div class="form-text text-muted">
                                {{ trans("lang.app_setting_mail_host_help") }}
                            </div>
                        </div>
                    </div>

                    <!-- mail_port Field -->
                    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
                        {!! Form::label('mail_port', trans("lang.app_setting_mail_port"), ['class' => 'col-4 control-label text-right']) !!}
                        <div class="col-8">
                            {!! Form::text('mail_port', setting('mail_port'),  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_mail_port_placeholder")]) !!}
                            <div class="form-text text-muted">
                                {{ trans("lang.app_setting_mail_port_help") }}
                            </div>
                        </div>
                    </div>

                    <!-- Lang Field -->
                    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
                        {!! Form::label('mail_encryption', trans("lang.app_setting_mail_encryption"),['class' => 'col-4 control-label text-right']) !!}
                        <div class="col-8">
                            {!! Form::select('mail_encryption', ['tls'=>'TLS', 'ssl'=>'SSL'], setting('mail_encryption'), ['class' => 'select2 form-control']) !!}
                            <div class="form-text text-muted">{{ trans("lang.app_setting_mail_encryption_help") }}</div>
                        </div>
                    </div>

                </div>
                <div class="d-flex flex-column col-sm-12 col-md-6">
                    <!-- mail_username Field -->
                    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
                        {!! Form::label('mail_username', trans("lang.app_setting_mail_username"), ['class' => 'col-4 control-label text-right']) !!}
                        <div class="col-8">
                            {!! Form::text('mail_username', setting('mail_username'),  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_mail_username_placeholder")]) !!}
                            <div class="form-text text-muted">
                                {{ trans("lang.app_setting_mail_username_help") }}
                            </div>
                        </div>
                    </div>

                    <!-- mail_password Field -->
                    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
                        {!! Form::label('mail_password', trans("lang.app_setting_mail_password"), ['class' => 'col-4 control-label text-right']) !!}
                        <div class="col-8">
                            {!! Form::password('mail_password',  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_mail_password_placeholder")]) !!}
                            <div class="form-text text-muted">
                                {{ trans("lang.app_setting_mail_password_help") }}
                            </div>
                        </div>
                    </div>
                    <!-- mail_from_address Field -->
                    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
                        {!! Form::label('mail_from_address', trans("lang.app_setting_mail_from_address"), ['class' => 'col-4 control-label text-right']) !!}
                        <div class="col-8">
                            {!! Form::text('mail_from_address', setting('mail_from_address'),  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_mail_from_address_placeholder")]) !!}
                            <div class="form-text text-muted">
                                {{ trans("lang.app_setting_mail_from_address_help") }}
                            </div>
                        </div>
                    </div>

                    <!-- mail_from_name Field -->
                    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
                        {!! Form::label('mail_from_name', trans("lang.app_setting_mail_from_name"), ['class' => 'col-4 control-label text-right']) !!}
                        <div class="col-8">
                            {!! Form::text('mail_from_name', setting('mail_from_name'),  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_mail_from_name_placeholder")]) !!}
                            <div class="form-text text-muted">
                                {{ trans("lang.app_setting_mail_from_name_help") }}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Submit Field -->
                <div class="form-group mt-4 col-12 text-right">
                    <button type="submit" class="btn bg-{{setting('theme_color')}} mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
                        <i class="fas fa-save"></i> {{trans('lang.save')}} {{trans('lang.app_setting_smtp')}}</button>
                    <a href="{!! route('users.index') !!}" class="btn btn-default"><i class="fas fa-undo"></i> {{trans('lang.cancel')}}</a>
                </div>

            </div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div>
    </div>
    </div>
    @include('layouts.media_modal',['collection'=>null])
@endsection
@push('scripts_lib')
    <!-- iCheck -->

    <!-- select2 -->
    <script src="{{asset('public/vendor/select2/js/select2.full.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('public/vendor/summernote/summernote.min.js')}}"></script>
    {{--dropzone--}}
    <script src="{{asset('public/vendor/dropzone/min/dropzone.min.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzoneFields = [];
    </script>
@endpush

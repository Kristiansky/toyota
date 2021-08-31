@extends('adminlte::page')

@section('title', __('main.create_user'))

@section('content_header')
    <h1>{{ __('main.create_user') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-xl-6">
            <form action="{{route('users.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name">Име <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Име" required>
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required>
                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="additional_emails">Допълнителни Email адреси</label>
                    <textarea class="form-control" id="additional_emails" name="additional_emails" placeholder="example@site.com, example2@site.org"></textarea>
                    <small id="additional_emailsHelp" class="form-text text-muted">Отделяйте ги със запетайка!</small>
                </div>
                <div class="form-group">
                    <label for="password">Парола <span class="text-danger">*</span></label>
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Потвърди паролата <span class="text-danger">*</span></label>
                    <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="parent_id">{{__('main.dealer')}}</label>
                    <select class="form-control selectpicker" data-live-search="true" data-size="0" id="parent_id" name="parent_id" title="{{ __('main.choose') }}">
                        <option value="">{{ __('main.choose') }}</option>
                        @foreach($dealers as $dealer)
                            <option value="{{$dealer->id}}">{{ $dealer->name }} [{{ $dealer->email }}]</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Запази</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop

{{--@section('plugins.Moment', true)--}}
{{--@section('plugins.Datetimepicker', true)--}}
{{--@section('plugins.Sweetalert2', true)--}}

@section('js')
    <script>
		$(document).ready(function () {
		});
    </script>
@stop

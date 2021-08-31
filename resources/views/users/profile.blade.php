@extends('adminlte::page')

@section('title', __('Profile'))

@section('content_header')
    <h1>{{__('Profile')}}: {{$user->name}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="{{route('users.update', $user)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Име <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$user->name}}" placeholder="Enter name" required>
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{$user->email}}" placeholder="Enter email" required>
                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="additional_emails">Допълнителни Email адреси</label>
                    <textarea class="form-control" id="additional_emails" name="additional_emails" placeholder="example@site.com, example2@site.org">{{$user->additional_emails}}</textarea>
                    <small id="additional_emailsHelp" class="form-text text-muted">Отделяйте ги със запетайка!</small>
                </div>
                <div class="form-group">
                    <label for="password">Парола</label>
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Потвърди паролата</label>
                    <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                @if(auth()->user()->hasRole('administrator'))
                    <div class="form-group">
                        <label for="parent_id">{{__('main.dealer')}}</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="0" id="parent_id" name="parent_id" title="{{ __('main.choose') }}">
                            <option value="">{{ __('main.choose') }}</option>
                            @foreach($dealers as $dealer)
                                <option value="{{$dealer->id}}" {{$dealer->id == $user->parent_id ? 'selected' : ''}}>{{ $dealer->name }} [{{ $dealer->email }}]</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Запази</button>
            </form>
        </div>
    </div>
    @if(auth()->user()->hasRole('administrator'))
        <div class="row my-4">
            <div class="col-md-6">
                <div class="table-responsive">
                    <h5>Роли</h5>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Роля</th>
                            <th>Slug</th>
                            <th colspan="2">Действия</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Роля</th>
                            <th colspan="2">Действия</th>
                        </tr>
                        </tfoot>
                        @foreach($roles as $role)
                            <tr>
                                <td>
                                    {{$role->id}}
                                </td>
                                <td>
                                    {{$role->name}}
                                </td>
                                <td>
                                    @if(!$user->roles->contains($role))
                                        <form action="{{route('users.role.attach', $role)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                            <button type="submit" class="btn btn-success">Активирай</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if($user->roles->contains($role))
                                        <form action="{{route('users.role.detach', $role)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                            <button type="submit" class="btn btn-danger">Деактивирай</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('css')
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script> console.log('Hi!'); </script>
@stop

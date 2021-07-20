@extends('adminlte::page')

@section('title', __('main.records'))

@section('content_header')
    <h1>{{ __('main.records') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            {{--{{__('main.showing_records', ['first_index' => $paginator->items()['from'], 'last_index' =>  $paginator->items()['to'], 'total_count' =>  $paginator->items()['total'] ])}}--}}
                            {{__('main.total_records')}}: {{ $records->total() }}
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{ $records->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if(session('message'))
                                <div class="alert alert-warning">{{session('message')}}</div>
                            @endif
                            <hr/>
                            <!-- DataTales Example -->
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Име на клиент</th>
                                        <th>web_form</th>
                                        <th>dealer_info</th>
                                        <th>status</th>
                                        <th>dealer_progress_status</th>
                                        <th>created_at</th>
                                        <th>updated_at</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    </tfoot>
                                    <tbody>
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td><a href="{{route('records.show', $record->id)}}">{{$record->client_name}}</a></td>
                                            <td>{{$record->web_form}}</td>
                                            <td>{{$record->dealer_info}}</td>
                                            <td>{!!$record->colorStatus()!!}</td>
                                            <td>{{$record->dealer_progress_status}}</td>
                                            <td>{{$record->created_at}}</td>
                                            <td>{{$record->updated_at}}</td>
                                            <td>
                                                @if(auth()->user()->hasRole('administrator'))
                                                    <a href="{{route('records.show', $record->id)}}" class="btn btn-success btn-sm float-left mr-2"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('records.edit', $record->id)}}" class="btn btn-primary btn-sm float-left mr-2"><i class="fa fa-pencil-alt"></i></a>
                                                    <form method="post" action="{{route('records.destroy', $record->id)}}" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-alt"></i></button>
                                                    </form>
                                                @elseif(auth()->user()->hasRole('manager'))
                                                    <a href="{{route('records.show', $record->id)}}" class="btn btn-success btn-sm float-left mr-2"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('records.fill', $record->id)}}" class="btn btn-primary btn-sm float-left mr-2"><i class="fa fa-edit"></i></a>
                                                @elseif(auth()->user()->hasRole('dealer'))
                                                    <a href="{{route('records.show', $record->id)}}" class="btn btn-success btn-sm float-left mr-2"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('records.fill', $record->id)}}" class="btn btn-primary btn-sm float-left mr-2"><i class="fa fa-edit"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{$records->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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


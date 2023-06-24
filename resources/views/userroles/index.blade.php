@extends('layouts.master')
@section('content')
    <section class="section">
        <a href="/"><img src="/img/svg/back-arrow.svg" display="block" width="35" height="35"></a>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left flex content-center">
                        <h2 class="pt-4">User Roles</h2>
                        <a class="ml-4 text-center" href="{{route('userroles.create')}}">+</a>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>{{__("Name")}}</th>
                    <th>Is super admin</th>
                    <th>Is admin</th>
                    <th>Is truck driver</th>
                    <th>Is sales</th>
                    <th width="280px">{{__("Action")}}</th>
                </tr>
                @foreach ($userRoles as $userRole)
                    <tr>
                        <td>{{$userRole->id}}</td>
                        <td>{{$userRole->user->name}}</td>
                        <td>{{$userRole->super_admin}}</td>
                        <td>{{$userRole->admin}}</td>
                        <td>{{$userRole->truck_driver}}</td>
                        <td>{{$userRole->sales}}</td>

                        <td>
                            <a class="btn btn-info" href="{{ route('userroles.show',$user->id) }}">{{__("Show")}}</a>
                            <a class="btn btn-primary" href="{{ route('userroles.edit',$user->id) }}">{{__("Edit")}}</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['userroles.destroy', $user->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection

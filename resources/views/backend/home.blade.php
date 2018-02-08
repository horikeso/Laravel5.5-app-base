@extends('layouts.backend_app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">BackendDashboard</div>

                <div class="panel-body">
                    @can('admin')
                        <div>admin Gate</div>
                        <div>{{ $admin }}</div>
                    @endcan
                    @can('general')
                        <div>general Gate</div>
                        <div>{{ $general }}</div>
                    @endcan
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            @can('admin')
                                <th>&nbsp;</th>
                            @endcan
                        </tr>
                        @foreach ($user_object_list as $user_object)
                            <tr>
                                <td>{{ $user_object->id }}</td>
                                <td>{{ $user_object->name }}</td>
                                <td>{{ $user_object->email }}</td>
                                @can('admin')
                                    <td>
                                        <form method="POST" action="{{ route('backend.user.delete', $user_object->id) }}">
                                            {{ csrf_field() }}
                                            <a href="javascript:void(0)" onclick="this.parentNode.submit()">削除</a>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

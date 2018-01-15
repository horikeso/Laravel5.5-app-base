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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
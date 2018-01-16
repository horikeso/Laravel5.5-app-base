@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br>

                    <div class="text-center">
                        <ul class="pagination">
                            @for ($i = $page_data['start_page']; $i < $page_data['start_page'] + $page_data['page_link']; $i++)
                                @if ($i > $page_data['max_page'])
                                    @break
                                @endif
                                @if ($i === $page_data['current_page'])
                                    <li class="active"><a href="?page={{ $i }}">{{ $i }}</a></li>
                                @else
                                    <li><a href="?page={{ $i }}">{{ $i }}</a></li>
                                @endif
                            @endfor
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('home') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="search" value="{{ $search }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        @foreach ($user_object_list as $user_object)
                            <tr>
                                <td>{{ $user_object->id }}</td>
                                <td>{{ $user_object->name }}</td>
                                <td>{{ $user_object->email }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

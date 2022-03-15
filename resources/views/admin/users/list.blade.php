@extends('layouts.main_backend')
@section('title','User List')
@section('contents')
    <div class="content mt-3">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Basic Table
                    </div>
                    <div class="card-body">
                        <form class="form-inline my-2 my-lg-0 float-right" role="search" accept-charset="UTF-8"
                              action="#" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                       value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">email</th>
                                <th scope="col">Tel</th>
                                <th scope="col">Register at</th>
                                <th scope="col">Result</th>
                                <th scope="col">Round</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                @if($user->role_id != 2)
                                    <tr>
                                        <th scope="row">{{ ($key+1+(($page-1)*$perPage)) }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->tel }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->result }}</td>
                                        <td>{{ $user->round }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')],['page' => $page])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
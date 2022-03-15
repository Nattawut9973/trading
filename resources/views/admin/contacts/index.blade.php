@extends('layouts.main_backend')
@section('title','User List')
@section('contents')
    <div class="content mt-3">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Contact
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
                                <th scope="col">Email</th>
                                <th scope="col">Message</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $key => $contact)
                                    <tr>
                                        <th scope="row">{{ ($key+1+(($page-1)*$perPage)) }}</th>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ str_limit($contact->message,'100','...') }}</td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $contacts->appends(['search' => Request::get('search')],['page' => $page])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
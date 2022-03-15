@extends('layouts.main_backend')
@section('title','Event List')
@section('contents')
    <div class="content mt-3">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Event
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
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th scope="col">Price</th>
                                <th scope="col">Create at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $key => $event)
                                    <tr>
                                        <th scope="row">{{ ($key+1+(($page-1)*$perPage)) }}</th>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->start_date }}</td>
                                        <td>{{ $event->end_date }}</td>
                                        <td>{{ $event->price }}</td>
                                        <td>{{ $event->created_at }}</td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $events->appends(['search' => Request::get('search')],['page' => $page])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
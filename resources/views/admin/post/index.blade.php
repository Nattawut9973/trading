@extends('layouts.main_backend')
@section('title','Post')
@section('contents')
    <div class="content mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Post</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/post/create') }}" class="btn btn-success btn-sm" title="Add New Post">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($post as $key => $item)
                                    <tr>
                                        <td>{{ ($key+1+(($page-1)*$perPage)) }}</td>
                                        <td>{{ Str::limit($item->title,20) }}</td>
                                        <td>{{ Str::limit($item->content,20) }}</td>
                                        <td>
                                            <a href="{{ url('/admin/post/' . $item->id) }}" title="View Post">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/admin/post/' . $item->id . '/edit') }}" title="Edit Post">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/admin/post' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline"
                                                  enctype="multipart/form-data">
                                                {{ method_field('DELETE') }}
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Post"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $post->appends(['search' => Request::get('search')],['page' => $page])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

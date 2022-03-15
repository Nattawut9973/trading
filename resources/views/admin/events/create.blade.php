@extends('layouts.main_backend')
@section('title','Create Event')
@section('contents')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Create New Event</div>
            <div class="card-body">
                <br/>
                <br/>
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" accept-charset="UTF-8" class="form-horizontal" action="{{ route('event_store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input id="title" name="title" type="text" class="form-control" placeholder="Event Title"
                               value="{{ old('title') }}" required autofocus autocomplete="none">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="start_date">{{ __('Start') }}</label>
                        <input id="start_date" name="start_date" type="date" class="form-control" placeholder="start your event"
                               value="{{ old('start_date') }}" required autofocus autocomplete="none">
                        @if ($errors->has('start_date'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ __('End') }}</label>
                        <input id="end_date" name="end_date" type="date"
                               class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                               placeholder="end_date" value="{{ old('end_date') }}" required>
                        @if ($errors->has('end_date'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ __('Price') }}</label>
                        <input id="price" name="price" type="text"
                               class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                               placeholder="price" value="{{ old('price') }}" required>
                        @if ($errors->has('price'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
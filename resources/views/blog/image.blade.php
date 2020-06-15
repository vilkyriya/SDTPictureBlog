@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <div align="right">
            <a href="{{ url('/') }}" class="btn btn-default">Назад</a>
        </div>
        <br />
        <img src="{{ URL::to('/') }}/blog_images/{{ $data->image }}" class="img-thumbnail" />
        <h3>Нравится: {{ $data->votes }} </h3>

        @auth
            @if(Auth::user()->isUser())
                    <form method="post" action="{{ url('/vote', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-success">Нравится!</button>
                    </form>
            @endif
        @endauth



    </div>
@endsection

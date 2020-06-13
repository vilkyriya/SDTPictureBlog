@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <div align="right">
            <a href="{{ route('/') }}" class="btn btn-default">Назад</a>
        </div>
        <br />
        <img src="{{ URL::to('/') }}/blog_images/{{ $data->image }}" class="img-thumbnail" />
        <h3>Нравится: {{ $data->votes }} </h3>

        <form method="post" action="{{ route('images.update', $data->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success">Like it!</button>
        </form>

    </div>
@endsection

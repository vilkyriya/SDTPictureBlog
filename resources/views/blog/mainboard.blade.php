@extends('layouts.app')

@section('content')
    <center>
        <div class="row">
            @foreach($data as $row)
                <div class="col-md-4">
                    <h4><a href="{{ url('/show', $row->id) }}">{{ $row->name }}</a></h4>
                    <a href="{{ url('/show', $row->id) }}">
                        <img src="{{ URL::to('/') }}/blog_images/{{ $row->image }}" class="img-thumbnail" width="300"/>
                    </a>
                    <p></p>
                </div>
            @endforeach
        </div>

        {!! $data->links() !!}
    </center>


@endsection

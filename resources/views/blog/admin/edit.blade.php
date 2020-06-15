@extends('layouts.app')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger text-center">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div align="right">
        <a href="{{ url('/admin/index') }}" class="btn btn-default">Назад</a>
    </div>

    <center>
        <form method="post" action="{{ url('/admin/update', $data->id) }}" enctype="multipart/form-data">

            @csrf
            <div class="form-group">
                <label class="col-md-4 text-center">Введите новое название</label>
                <div class="col-md-8">
                    <input type="text" name="name"  value="{{ $data->name }}" class="form-control input-lg" />
                </div>
            </div>
            <br />
            <label class="col-md-4 text-center">или</label>
            <br /> <br />
            <div class="form-group">
                <label class="col-md-4 text-center">Выберите новое изображение</label>
                <div class="col-md-8">
                    <input type="file" name="image"/>
                    <img src="{{ URL::to('/') }}/blog_images/{{ $data->image }}" class="img-thumbnail" width="100"/>
                    <input type="hidden" name="hidden_image" value="{{$data->image}}"/>
                </div>
            </div>
            <br />
            <div class="form-group text-center">
                <input type="submit" name="edit" class="btn btn-primary input-lg" value="Изменить" />
            </div>

        </form>
    </center>
@endsection

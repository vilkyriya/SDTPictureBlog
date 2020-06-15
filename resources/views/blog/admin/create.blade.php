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
    <form method="post" action="{{ url('/admin/store') }}" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <label class="col-md-4 text-center">Введите название</label>
            <div class="col-md-8">
                <input type="text" name="name" class="form-control input-lg" />
            </div>
        </div>
        <br />
        <div class="form-group">
            <label class="col-md-4 text-center">Выберите изображение</label>
            <div class="col-md-8">
                <input type="file" name="image" />
            </div>
        </div>
        <br />
        <div class="form-group text-center">
            <input type="submit" name="add" class="btn btn-primary input-lg" value="Add" />
        </div>

    </form>
    </center>
@endsection

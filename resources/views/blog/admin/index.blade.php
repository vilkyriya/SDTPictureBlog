@extends('layouts.app')

@section('content')
    <div align="center">
        <a class="btn btn-success" href="{{ url('/admin/create') }}" >Добавить новое изображение</a>
    </div>
    <br>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Изображение</th>
            <th>Название</th>
            <th>Лайки</th>
            <th>Действия</th>
        </tr>
        @foreach($data as $row)
            <tr>
                <td><img src="{{ URL::to('/') }}/blog_images/{{ $row->image }}" class="img-thumbnail" width="150"/></td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->votes }}</td>
                <td>
                    <form action="{{ url('/admin/destroy', $row->id) }}" method="post">
                        <a href="{{ url('/admin/edit', $row->id) }}" class="btn btn-primary">Изменить</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->links() !!}


@endsection

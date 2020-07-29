@extends('layouts.app')

@section('title', "Шкаф {$cell->title}")

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('cupboards.show', $cell->cupboard->slug) }}">{{ $cell->cupboard->title }}</a></li>
    <li class="breadcrumb-item">{{ $cell->title }}</li>
@endsection

@section('content')
    <h2 class="content-heading">Ячейка "{{ $cell->title }}" <small>Папки</small></h2>
    <div class="row">
        @foreach($cell->folders as $folder)
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card text-center">
                    <div class="d-flex justify-content-end align-items-center mt-1 mr-1">
                        <a class="text-warning" data-toggle="tooltip" title="Редактировать" href="{{ route('folders.edit', $folder->slug) }}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('folders.destroy', $folder->slug) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('Вы уверены?')" class="btn text-danger" data-toggle="tooltip" title="Удалить"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('folders.show', $folder->slug) }}" class="card-title">{{ $folder->title }} ({{ $folder->files()->count() }} файлов)</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

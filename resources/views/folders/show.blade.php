@extends('layouts.app')

@section('title', "Шкаф {$folder->title}")

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('cupboards.show', $folder->cell->cupboard->slug) }}">{{ $folder->cell->cupboard->title }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cells.show', $folder->cell->slug) }}">{{ $folder->cell->title }}</a></li>
    <li class="breadcrumb-item">{{ $folder->title }}</li>
@endsection

@section('content')
    <h2 class="content-heading">Файлы <small>{{ $folder->title }}</small></h2>
    <div class="row">
        @foreach($folder->files as $file)
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card text-center">
                    @if (strpos($file->mime, 'image') !== false)
                        <img src="{{ route('files.show', $file->id) }}" class="card-img-top" alt="{{ $file->filename }}">
                    @endif
                    <div class="d-flex justify-content-end align-items-center mt-1 mr-1">
                        <form action="{{ route('files.destroy', $file->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('Вы уверены?')" class="btn text-danger" data-toggle="tooltip" title="Удалить"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('files.show', $file->id) }}" target="_blank" class="card-title">{{ $file->filename }} ({{ $file->getSize() }})</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

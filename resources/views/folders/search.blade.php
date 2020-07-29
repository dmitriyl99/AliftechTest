@extends('layouts.app')

@section('title', 'Поиск')

@section('breadcrumbs')
    <li class="breadcrumb-item">Поиск</li>
@endsection

@section('content')
    <h2 class="content-heading">Поиск: "{{ $query }}"</h2>
    <div class="row">
        @forelse($result as $folder)
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
                        <a href="{{ route('folders.show', $folder->slug) }}" class="card-title">{{ $folder->title }}</a>
                        <p class="m-0 p-0">Шкаф: <a href="{{ route('cupboards.show', $folder->cell->cupboard->slug) }}">{{ $folder->cell->cupboard->title }}</a></p>
                        <p class="m-0 p-0">Ячейка: <a href="{{ route('cells.show', $folder->cell->slug) }}">{{ $folder->cell->title }}</a></p>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12"><h2 class="text-center">Поиск не дал результатов</h2></div>
        @endforelse
    </div>
@endsection

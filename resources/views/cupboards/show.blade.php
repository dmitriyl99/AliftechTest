@extends('layouts.app')

@section('title', "Шкаф {$cupboard->title}")

@section('breadcrumbs')
    <li class="breadcrumb-item">{{ $cupboard->title }}</li>
@endsection

@section('content')
    <h2 class="content-heading">Шкаф "{{ $cupboard->title }}" <small>Ячейки</small></h2>
    <div class="row">
        @foreach($cupboard->cells as $cell)
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card text-center">
                    <div class="d-flex justify-content-end align-items-center mt-1 mr-1">
                        <a class="text-warning" data-toggle="tooltip" title="Редактировать" href="{{ route('cells.edit', $cell->slug) }}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('cells.destroy', $cell->slug) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('Вы уверены?')" class="btn text-danger" data-toggle="tooltip" title="Удалить"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('cells.show', $cell->slug) }}" class="card-title">{{ $cell->title }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

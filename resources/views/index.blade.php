@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h2 class="content-heading">Шкафы</h2>

    <div class="row">
        @foreach($cupboards as $cupboard)
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card text-center">
                    <div class="d-flex justify-content-end align-items-center mt-1 mr-1">
                        <a class="text-warning" data-toggle="tooltip" title="Редактировать" href="{{ route('cupboards.edit', $cupboard->slug) }}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('cupboards.destroy', $cupboard->slug) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('Вы уверены?')" class="btn text-danger" data-toggle="tooltip" title="Удалить"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('cupboards.show', $cupboard->slug) }}" class="card-title">{{ $cupboard->title }} ({{ $cupboard->cells()->count() }} ячеек)</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@extends('layouts.app')

@section('title', $cupboard->title)

@section('breadcrumbs')
    <li class="breadcrumb-item active">{{ $cupboard->title }}</li>
@endsection

@section('content')
    <h2 class="content-heading">Шкафы</h2>
    <div class="card">
        <div class="card-header">{{ $cupboard->title }} <small>Редактировать</small></div>
        <div class="card-body">
            <form action="{{ route('cupboards.update', $cupboard->slug) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text" name="title" placeholder="Введите название шкафа" value="{{ $cupboard->title }}" id="title" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
@endsection

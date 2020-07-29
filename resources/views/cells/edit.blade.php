@extends('layouts.app')

@section('title', $cell->title)

@section('breadcrumbs')
    <li class="breadcrumb-item">{{ $cell->cupboard->title }}</li>
    <li class="breadcrumb-item active">{{ $cell->title }}</li>
@endsection

@section('content')
    <h2 class="content-heading">Ячейки</h2>
    <div class="card">
        <div class="card-header">{{ $cell->title }}</div>
        <div class="card-body">
            <form action="{{ route('cells.update', $cell->slug) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text" name="title" placeholder="Введите название ячейки" value="{{ $cell->title }}" id="title" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cupboard_id"></label>
                    <select name="cupboard_id" id="cupboard_id" class="form-control @error('cupboard_id') is-invalid @enderror">
                        <option disabled>-- Выберите шкаф --</option>
                        @foreach($cupboards as $cupboard)
                            <option value="{{ $cupboard->id }}" @if ($cupboard->id == $cell->cupboard_id) selected @endif>{{ $cupboard->title }}</option>
                        @endforeach
                    </select>
                    @error('cupboard_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
@endsection

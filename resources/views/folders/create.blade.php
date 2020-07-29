@extends('layouts.app')

@section('title', 'Добавить папку')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Добавить папку</li>
@endsection

@section('content')
    <h2 class="content-heading">Папки</h2>
    <div class="card">
        <div class="card-header">Добавить папку</div>
        <div class="card-body">
            <form action="{{ route('folders.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text" name="title" placeholder="Введите название папки" value="{{ old('title') }}" id="title" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cupboard_id">Шкаф</label>
                    <select name="cupboard_id" id="cupboard_id" class="form-control @error('cupboard_id') is-invalid @enderror">
                        <option disabled selected>-- Выберите шкаф --</option>
                        @foreach($cupboards as $cupboard)
                            <option value="{{ $cupboard->id }}">{{ $cupboard->title }}</option>
                        @endforeach
                    </select>
                    @error('cupboard_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cupboard_id">Ячейка</label>
                    <select name="cell_id" id="cell_id" disabled class="form-control @error('cell_id') is-invalid @enderror">
                        <option disabled selected>-- Выберите ячейку --</option>
                    </select>
                    @error('cell_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/script.js') }}"></script>
@endsection

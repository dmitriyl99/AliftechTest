@extends('layouts.app')

@section('title', 'Добавить шкаф')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Добавить шкаф</li>
@endsection

@section('content')
    <h2 class="content-heading">Шкафы</h2>
    <div class="card">
        <div class="card-header">Добавить шкаф</div>
        <div class="card-body">
            <form action="{{ route('cupboards.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text" name="title" placeholder="Введите название шкафа" value="{{ old('title') }}" id="title" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </div>
@endsection

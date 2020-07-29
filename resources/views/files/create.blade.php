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
            <form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="file">
                            <label class="custom-file-label" for="file" data-browse="Обзор">Выберите файл</label>
                            @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
                <div class="form-group">
                    <label for="folder_id">Папка</label>
                    <select name="folder_id" id="folder_id" disabled class="form-control @error('folder_id') is-invalid @enderror">
                        <option disabled selected>-- Выберите папку --</option>
                    </select>
                    @error('folder_id')
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
    <script>
        $('input:file').change(function () {
            let filename = $(this).val();
            let pathDelimiter = navigator.appVersion.indexOf('Win') !== -1 ? '\\' : '/';
            filename = filename.substring(filename.lastIndexOf(pathDelimiter) + 1);
            $(this).next().html(filename);
        })
    </script>
@endsection

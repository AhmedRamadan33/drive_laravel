@extends('layouts.app')

@section('content')
    <div class="drive">
        <div class="container col-6">
            <h1>Update File : {{ $editFile->id }}</h1>
            {{-- Start message validation --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- End message validation --}}
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('drives.update', $editFile->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-groub">
                            <input type="text" name="title" value="{{ $editFile->title }}" class="form-control"
                                placeholder="File title">
                        </div>
                        <div class="form-groub">
                            <input type="text" name="description" value="{{ $editFile->description }}"
                                class="form-control" placeholder="File description">
                        </div>
                        <div class="form-groub">
                            <label for="">File Name : {{ $editFile->file }}</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <button class="btn btn-info">Update Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

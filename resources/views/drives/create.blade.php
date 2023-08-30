@extends('layouts.app')

@section('content')
    <div class="drive">
        <div class="container col-6">
            <h1>Upload File</h1>

            {{-- Start message Configration --}}
            @if (Session::has('done'))
                <div class="alert alert-success">
                    {{ Session::get('done') }}
                </div>
            @endif
            {{-- End message Configration --}}

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
                    <form action="{{ route('drives.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-groub">
                            <input type="text" name="title" class="form-control" placeholder="File title">
                        </div>
                        <div class="form-groub">
                            <input type="text" name="description" class="form-control" placeholder="File description">
                        </div>
                        <div class="form-groub">
                            <input type="file" name="file" class="form-control" placeholder="File Name">
                        </div>
                        <button class="btn btn-info">Send Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

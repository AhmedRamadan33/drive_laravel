
@extends('layouts.app')

@section('content')
    <div class="drive">
        <div class="container col-3">
            <h3>Show File : {{$showFile->id}}</h3>

            <div class="card">
                <img src="{{asset('img/file.png')}}" alt="" class="img-fluid img-top">    
                            
                <div class="card-body border border-success rounded">
                    <h5>Title : {{$showFile->title}}</h5>
                    <h6>File Name : {{$showFile->file}}</h6>
                    <h6>description : {{$showFile->description}}</h6>

                    <a href="{{route('drives.download' ,$showFile->id)}}" class="btn btn-success"><i class="fa-solid fa-download"></i> Download</a>
                </div>
            </div>
        </div>
    </div>
@endsection 
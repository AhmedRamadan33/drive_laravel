@extends('layouts.app')

@section('content')
    <div class="drive">
        <div class="container col-6">
            <h1>Your Files</h1>
    
            @if (Session::has('done'))
            <div class="alert alert-danger">
                {{Session::get('done')}}
            </div>
            @endif
    
            <div class="card">
                <div class="card-body">
                    <table class="table table-light">
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>Status</th>
                            <th>Show</th>
                            <th>Edit</th>
                            <th>Delete</th>
    
                        </tr>
                        @forelse ($driveData as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td><a href="{{route('drives.changStatus',$item->id)}}">
                                @if ($item->status == 'private')
                                <i class="fa-solid fa-lock" style="color: #fae500;"></i>
                                @else
                                <i class="fa-solid fa-lock-open" style="color: #ed0707;"></i>
                                @endif
                            </a></td>
                            <td><a href="{{route('drives.show',$item->id)}}"><i class="fa-solid fa-eye"></i></a></td>
                            <td><a href="{{route('drives.edit',$item->id)}}"><i class="fa-solid fa-pen-to-square" style="color: #eeff05;"></i></a></td>
                            <td><a href="{{route('drives.destroy',$item->id)}}"><i class="fa-solid fa-trash-can" style="color: #f40b0b;"></i></a></td>
    
                        </tr>
                        @empty
                            <h1 class="text-center text-warning"> No Have Data Yet</h1>
                        @endforelse
    
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


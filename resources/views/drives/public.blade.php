@extends('layouts.app')

@section('content')
    <div class="drive">
        <div class="container col-6">
            <h1>Public Files</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table table-light">
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>Show</th>
                        </tr>
                        @forelse ($publicFiles as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                           
                            <td><a class=" btn-info" href="{{route('drives.showPublicFiles',$item->id)}}"><i class="fa-solid fa-eye"></i></a></td>
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


@extends('layouts.app')


@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
    </div>
    <div class="card-body">
        @if($posts->count() >0)
            <table class="table">
                <thead>
                <th>
                    Image
                </th>
                <th>
                    Title
                </th>

                <th>
                    Category
                </th>

                <th></th>
                <th></th>

                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>
                            <img src="{{url('/storage/'.$post->image)}}" width="100px" height="50px" alt="">

                        </td>
                        <td>
                            {{$post->title}}
                        </td>
                        @if(!$posts->count() == 0)
                        <td>
                            <a href="{{route('categories.edit',$post->category->id)}}">{{$post->category->name}}</a>
                        </td>
                        @endif
                        <td>
                            @if(!$post->trashed())
                                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info ">Edit</a>
                            @else
                                <form action="{{route('restored-posts',$post->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-info">Restore</button>

                                </form>
                                @endif
                        </td>
                        <td>
                            <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger ">{{$post->trashed()? 'Delete' : 'Trash'}}</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center">No Posts Yet</h3>
       @endif
    </div>
@endsection

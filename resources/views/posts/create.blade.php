@extends('layouts.app')


@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{isset($post) ?'Edit Post' :'Add Post'}}
        </div>
        <div class="card-body">
            @include('partials.error')


            <form action="{{isset($post)?route('posts.update',$post->id): route('posts.store')}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title"
                           value="{{isset($post)? $post->title:''}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description"
                           value="{{isset($post)? $post->description:''}}">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="x" type="hidden" name="contents" value="{{isset($post)? $post->contents:''}}">
                    <trix-editor input="x"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published_At</label>
                    <input type="text" class="form-control" name="published_at" id="published_at"
                           value="{{isset($post)? $post->published_at:''}}">
                </div>
                @if(isset($post))

                    <img src="{{url('/storage/'.$post->image)}}" style="width: 100px" alt="">

                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"

                                    @if(isset($post))

                                    @if($category->id === $post->category_id)

                                    selected

                                    @endif
                                    @endif
                            >
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if($tags->count() > 0)
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}"

                                        @if(isset($post))

                                        @if($post->postTags($tag->id))

                                        selected
                                        @endif
                                        @endif
                                >
                                    {{$tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group">

                    <button type="submit" class="btn btn-success">
                        {{isset($post) ?'Edit Post' :'Add Post'}}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        flatpickr('#published_at', {

            enableTime: true
        })

        $(document).ready(function() {
            $('.tags-selector').select2()
        })
    </script>

@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


@endsection
@extends('layouts.app')


@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if($categories->count() >0)
                <table class="table">
                    <thead>
                    <th>
                        Name
                    </th>
                    <th>
                        Posts Count
                    </th>
                    <th></th>
                    <th></th>

                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$category->name}}
                            </td>
                            <td>
                                {{$category->posts->count()}}
                            </td>
                            <td>

                                <button class="btn btn-danger  float-right" onclick="handleForm({{$category->id}})">Delete</button>


                                <a href="{{route('categories.edit',$category->id)}}"
                                   class="btn btn-info  float-right">Edit</a>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Categories Yet</h3>
            @endif

            <!-- Modal -->
            <form id="deleteHandler" action="" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-bold">Are you sure to delete this category?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-danger">Yes,Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('script')
    <script>
        function handleForm(id){

            var form  = document.getElementById('deleteHandler')
            form.action = '/categories/' + id
            $('#deleteModal').modal('show');
            console.log(form)
        }

    </script>
@endsection
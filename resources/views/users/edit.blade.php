@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit Profile</div>

        <div class="card-body">
            @include('partials.error')
            <form action="{{route('users.update-profile')}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="about">About Me</label>
                    <textarea name="about" id="about" cols="30" rows="10"
                              class="form-control">{{$user->about}}</textarea>
                </div>

                <div class="form-group">

                    <button class="btn btn-success" type="submit">
                        Edit Profile
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection

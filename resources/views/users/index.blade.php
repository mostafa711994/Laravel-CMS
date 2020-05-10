@extends('layouts.app')


@section('content')

    <div class="card card-default">
        <div class="card-header">
          Users
        </div>
    </div>
    <div class="card-body">
        @if($users->count() >0)
            <table class="table">
                <thead>
                <th>
                    Image
                </th>
                <th>
                    name
                </th>

                    <th>
                       email
                    </th>

                <th></th>


                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <img src="{{Gravatar::src($user->email)}}" width="40px" height="40px" class="border-radius:50%" alt="">

                        </td>
                        <td>
                            {{$user->name}}
                        </td>

                            <td>
                                {{$user->email}}
                            </td>
                     @if(!$user->isAdmin())
                       <td>
                           <form action="{{route('users.make-admin', $user->id)}}" method="POST">
                               @csrf
                               <button class="btn btn-success btn-sm">Make Admin</button>

                           </form>
                       </td>
                         @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">No users Yet</h3>
        @endif
    </div>
@endsection

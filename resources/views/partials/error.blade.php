@if($errors->any())
    @foreach($errors->all() as $error)
        <li class="list-group-item text-danger">
            {{$error}}
        </li>
    @endforeach
@endif
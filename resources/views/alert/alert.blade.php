@if ($errors->any())
    <div class="text-danger">
        @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
    </div>
@endif
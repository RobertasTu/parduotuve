@extends('layouts.app')

@section('content')

<div class='container'>
<table class='table table-striped'>
    <a href='{{route('shop.create')}}' class='btn btn-primary'>Add new shop</a>
    <tr>
        <th>Shop ID</th>
        <th> Shop title</th>
        <th>Shop description</th>
        <th>Shop e-mail</th>
        <th>Shop phone number</th>
        <th>Location</th>
        <th>Actions</th>

    </tr>


    <tr>
        <td>{{$shop->id}}</td>
        <td>{{$shop->title}}</td>
        <td>{!! $shop->description !!}</td>
        <td>{{$shop->email}}</td>
        <td>{{$shop->phone}}</td>
        <td>{{$shop->country}}</td>
        <td>
            <a href="{{route('shop.edit',[$shop])}}" class="btn btn-primary">Edit </a>
            <form method="post" action={{route('shop.destroy',[$shop])}}>
                @csrf
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
        </td>
    </tr>



</table>
<a class='btn btn-secondary' href='{{route('shop.index')}}'>Back</a>

</div>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection

@extends('layouts.app')

@section('content')

<div class='container'>
<table class='table table-striped'>
    <a href='{{route('shop.create')}}' class='btn btn-primary'>Add new shop</a>
    <tr>
        <th>@sortablelink('id','Shop ID')</th>
        <th>@sortablelink('title', 'Shop title')</th>
        <th>Shop description</th>
        <th>Shop e-mail</th>
        <th>Shop phone number</th>
        <th>@sortablelink('country', 'Location')</th>
        <th>Actions</th>

    </tr>

    @foreach ($shops as $shop)
    <tr>
        <td>{{$shop->id}}</td>
        <td><a class='btn btn-info' href="{{route('shop.show', [$shop])}}">{{$shop->title}}</a></td>
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
    @endforeach
</table>
{!! $shops->appends(Request::except('page'))->render()  !!}

</div>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection

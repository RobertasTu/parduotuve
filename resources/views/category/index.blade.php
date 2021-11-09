@extends('layouts.app')

@section('content')

<div class='container'>
<table class='table table-striped'>
    <a href='{{route('category.create')}}' class='btn btn-primary'>Add new category</a>
    <tr>
        <th>@sortablelink('id', 'Category ID')</th>
        <th>@sortablelink ('title', 'Category title')</th>
        <th>Category description</th>
        <th>@sortablelink('shop_id', 'Shop')</th>
         <th>Actions</th>

    </tr>

    @foreach ($categories as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td><a class='btn btn-info' href="{{route('category.show', [$category])}}">{{$category->title}}</a></td>
        <td>{!! $category->description !!}</td>
        <td>{{$category->categoryShop->title}}</td>

        <td>
            <a href="{{route('category.edit',[$category])}}" class="btn btn-primary">Edit </a>
            <form method="post" action={{route('category.destroy',[$category])}}>
                @csrf
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{!! $categories->appends(Request::except('page'))->render()  !!}

</div>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection

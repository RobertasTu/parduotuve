@extends('layouts.app')

@section('content')

<div class='container'>
<table class='table table-striped'>
    <a href='{{route('product.create')}}' class='btn btn-primary'>Add new product</a>
    <tr>
        <th>Product ID</th>
        <th>Product title</th>
        <th>Product exerpt</th>
        <th>Product description</th>
        <th>Product price</th>
        <th>Product image</th>
        <th>Product category</th>
        <th>Actions</th>

    </tr>


    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->title}}</td>
        <td>{!! $product->excerpt !!}</td>
        <td>{!! $product->description !!}</td>
        <td>{{$product->price}}</td>
        <td><img src='{{ $product->image }}' alt='{{$product->image}}' style='width:300px'></td>
        <td>{{$product->productCategory->title}}</td>
        <td>
            <a href="{{route('product.edit',[$product])}}" class="btn btn-primary">Edit </a>
            <form method="post" action='{{route('product.destroy',[$product])}}'>
                @csrf
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
        </td>
    </tr>



</table>
<a class='btn btn-secondary' href='{{route('product.index')}}'>Back</a>

</div>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection

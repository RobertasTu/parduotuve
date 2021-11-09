@extends('layouts.app')

@section('content')

<div class='container'>

    <form action='{{route('product.index')}}' method='GET'>
        @csrf
        <div class="form-group row">
            <label for="filterPrice" class="col-md-4 col-form-label text-md-right">{{ __('Filter by price:') }}</label>
            <div class='col-md-6'>
                Min price <input class='form-control @error('min_price') is-invalid @enderror' type='text' name='min_price' value='{{ old('min_price') }}' >
                @error('min_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                Max price  <input class='form-control @error('max_price') is-invalid @enderror' type="text" name="max_price" value='{{ old('max_price') }}'>
                @error('max_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            </div>
                <label for="filterByCategory" class="col-md-4 col-form-label text-md-right">{{ __('Filter by category:') }}</label>
                <div class='col-md-6'>
                <select class="form-control" name="filterByCategory">
                    <option value="all" @if ($filterByCategory == 'all') selected @endif>Visi</option>
                    @foreach ($filterCategories as $product)
                        <option value="{{$product->category_id}}" @if($filterByCategory == $product->category_id) selected @endif>{{$product->productCategory->title}}</option>
                    @endforeach
                </select>
                </div>

            <button class='btn btn-secondary' type='submit'>Filter</button>
            <a href='{{route('product.index')}}' class='btn btn-info'>Clear filter</a>
        </div>

    </form>

<table class='table table-striped'>
    <a href='{{route('product.create')}}' class='btn btn-primary'>Add new product</a>
    <tr>
        <th>@sortablelink('id', 'ID')</th>
        <th>@sortablelink('title', 'Product title')</th>
        <th>Excerpt</th>
        <th>Description</th>
        <th>@sortablelink('price', 'Price')</th>
        <th>@sortablelink('category_id','Product category')</th>
         <th>Actions</th>

    </tr>

    @foreach ($products as $product)
    <tr>
        <td>{{$product->id}}</td>
        <td><a class='btn btn-info' href="{{route('product.show', [$product])}}">{{$product->title}}</a></td>
        <td>{!! $product->excerpt !!}</td>
        <td>{!! $product->description !!}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->productCategory->title}}</td>

        <td>
            <a href="{{route('product.edit',[$product])}}" class="btn btn-primary">Edit </a>
            <form method="post" action={{route('product.destroy',[$product])}}>
                @csrf
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{!! $products->appends(Request::except('page'))->render()  !!}

</div>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection

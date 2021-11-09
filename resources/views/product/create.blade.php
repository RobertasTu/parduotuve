@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New product ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="product_title" class="col-md-4 col-form-label text-md-right">{{ __('Product title') }}</label>

                            <div class="col-md-6">
                                <input id="product_title" type="text" class="form-control @error('product_title') is-invalid @enderror" value="{{ old('product_title') }}"name="product_title" required autocomplete>

                                @error('product_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="product_excerpt" class="col-md-4 col-form-label text-md-right" >{{ __('Product excerpt:') }}</label>

                            <div class="col-md-6">

                               <textarea class='summernote' name='product_excerpt' required>
                                   {{-- {!! $category->description !!} --}}
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_description" class="col-md-4 col-form-label text-md-right" >{{ __('Product description:') }}</label>

                            <div class="col-md-6">

                               <textarea class='summernote' name='product_description' required>
                                   {{-- {!! $category->description !!} --}}
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_price" class="col-md-4 col-form-label text-md-right">{{ __('Product price') }}</label>

                            <div class="col-md-6">
                                <input id="product_price" type="text" class="form-control @error('product_price') is-invalid @enderror" value="{{ old('product_price') }}"name="product_price" required autocomplete>

                                @error('product_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_image" class="col-md-4 col-form-label text-md-right">{{ __('Product image:') }}</label>
                            <div class="col-md-6">
                        <input type="file" name="product_image" class="form-control">
                            </div>
                        </div>



                        <div class="form-group row">

                            <label for="product_category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="product_category_id">

                                    @foreach ($categories as $category)

                                        <option value="{{$category->id}}" >{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save product info') }}
                                </button>

                                <a class='btn btn-secondary' href='{{route('product.index')}}'>Back</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection

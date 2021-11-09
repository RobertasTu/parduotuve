@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New category ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="category_title" class="col-md-4 col-form-label text-md-right">{{ __('Category title') }}</label>

                            <div class="col-md-6">
                                <input id="category_title" type="text" class="form-control @error('category_title') is-invalid @enderror" value="{{ old('category_title') }}"name="category_title" required autocomplete>

                                @error('category_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_description" class="col-md-4 col-form-label text-md-right" >{{ __('Category description:') }}</label>

                            <div class="col-md-6">

                               <textarea class='summernote' name='category_description' required>
                                   {{-- {!! $category->description !!} --}}
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="category_shop_id" class="col-md-4 col-form-label text-md-right">{{ __('Shop') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="category_shop_id">

                                    @foreach ($shops as $shop)

                                        <option value="{{$shop->id}}" >{{$shop->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save category info') }}
                                </button>

                                <a class='btn btn-secondary' href='{{route('category.index')}}'>Back</a>
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

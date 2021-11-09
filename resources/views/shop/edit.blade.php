@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit shop') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('shop.update', [$shop]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="shop_title" class="col-md-4 col-form-label text-md-right">{{ __('Shop title') }}</label>

                            <div class="col-md-6">
                                <input id="shop_title" type="text" class="form-control @error('shop_title') is-invalid @enderror" value="{{ $shop->title }}"name="shop_title" required autocomplete>

                                @error('shop_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_description" class="col-md-4 col-form-label text-md-right" >{{ __('Shop description:') }}</label>

                            <div class="col-md-6">

                               <textarea class='summernote' name='shop_description' required>
                                   {!! $shop->description !!}
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="shop_email" type="email" class="form-control @error('shop_email') is-invalid @enderror" name="shop_email" value="{{ $shop->email }}" required autocomplete="shop_email" autofocus>

                                @error('shop_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_phone" class="col-md-4 col-form-label text-md-right">{{ __('Shop phone number') }}</label>

                            <div class="col-md-6">
                                <input id="shop_phone" type="text" class="form-control @error('shop_phone') is-invalid @enderror" value="{{ $shop->phone }}" name="shop_phone" required autocomplete>

                                @error('shop_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_country" class="col-md-4 col-form-label text-md-right">{{ __('Shop country') }}</label>

                            <div class="col-md-6">
                                <input id="shop_country" type="text" class="form-control @error('shop_country') is-invalid @enderror" value="{{ $shop->country }}" name="shop_country" required autocomplete>

                                @error('shop_country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit shop info') }}
                                </button>

                                <a class='btn btn-secondary' href='{{route('shop.index')}}'>Back</a>
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

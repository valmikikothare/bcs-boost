@extends('layouts.web_layout')

@section('content')

<section class="py-lg-5 py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('elements.left_navigation')
            </div> 
            <div class="col-md-9">
                <div class="bg-white p-3 rounded shadow-sm">
                    <h4 class="mb-3 text-success">{{ __('frontend.eating_preference') }}</h4>
                    <hr>
                    <div>
                        <p class="help_text margin-bott-20">{{ __('frontend.eating_preference_helptext') }}</p>
                        <form method="POST" action="{{ route('storepreference') }}">
                        @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('frontend.diet') }}</label>
                                    <select class="form-select" name="diet_id"> 
                                        <option value="">{{ __('frontend.select_diet') }}</option>
                                        @foreach($diet as $dietItem)
                                        <option value="{{ $dietItem->id }}" @if(isset($userPreference) && $userPreference->diet_id == $dietItem->id) selected @endif>{{ $dietItem->diet }}</option>
                                        @endforeach
                                    </select>
                                    @error('TypeDiet')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>  


                                <div class="col-md-6">
                                    <label class="form-label">{{ __('frontend.taste') }}</label>
                                    <select class="form-select" name="taste_id"> 
                                        <option value="">{{ __('frontend.select_taste') }}</option>
                                        @foreach($tastes as $taste)
                                        <option value="{{ $taste->id }}" @if(isset($userPreference) && $userPreference->taste_id == $taste->id) selected @endif>{{ $taste->taste }}</option>
                                        @endforeach
                                    </select>
                                    @error('taste')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('frontend.kitchen') }} </label>
                                    <select class="form-select" name="kitchen_id"> 
                                        <option value="">{{ __('frontend.select_kitchen') }}</option>
                                        @foreach($kitchens as $kitchen)
                                        <option value="{{ $kitchen->id }}" @if(isset($userPreference) && $userPreference->kitchen_id == $kitchen->id) selected @endif>{{ $kitchen->kitchen }}</option>
                                        @endforeach
                                    </select>
                                    @error('kitchen_region')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('frontend.preparation') }}</label>
                                    <select class="form-select" name="preparation_id"> 
                                        <option value="">{{ __('frontend.select_prepare') }}</option>
                                        @foreach($preparations as $preparation)
                                        <option value="{{ $preparation->id }}" @if(isset($userPreference) && $userPreference->preparation_id == $preparation->id) selected @endif>{{ $preparation->preparation }}</option>
                                        @endforeach
                                    </select>
                                    @error('preparation')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input type="submit" value="{{ __('frontend.submit') }}" class="btn btn-success" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
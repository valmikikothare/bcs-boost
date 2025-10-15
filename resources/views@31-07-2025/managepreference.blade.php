@extends('layouts.user')

@section('content')


<div class="col-md-9">
    <div class="bg-white p-3 rounded shadow-sm">
        <h4 class="mb-3 text-success">{{ __('frontend.preference') }}</h4>
        <div>
            <form method="POST" action="{{ route('storepreference')}}">

        @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('frontend.diet') }}</label>
                        <select class="form-select" name="diet_id">
                            <option value="">{{ __('frontend.Select TypeDiet') }}</option>
                            @foreach($diet as $dietItem)
                            <option value="{{ $dietItem->id }}">{{ $dietItem->diet }}</option>
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
                            <option value="{{ $taste->id }}">{{ $taste->taste }}</option>
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
                            <option value="{{ $kitchen->id }}">{{ $kitchen->kitchen }}</option>
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
                            <option value="{{ $preparation->id }}">{{ $preparation->preparation }}</option>
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






@endsection
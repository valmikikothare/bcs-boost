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
                        <h4 class="mb-3 text-success">{{ __('frontend.dish_feedback') }}</h4>
                        <hr>
                        <div>
                            <p class="help_text margin-bott-20">{{ __('frontend.dish_feedback_helptext') }}</p>
                            <form action="{{ route('store_dish_feedback') }}" method="POST">
                           @csrf
                           <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label
                                            class="form-label">{{ __('frontend.did_you_actually_make_the_suggested_dish?') }}</label>
                                        <select class="form-select s" name="make_suggested_dish" id="handleChangeMakeDish">
                                            {{-- <option value="">{{ __('frontend.Select') }}</option> --}}
                                            <option value="yes">{{ __('frontend.Yes') }}</option>
                                            <option value="no">{{ __('frontend.No') }}</option>
                                        </select>
                                        @error('TypeDiet')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                    </div>

                                  
                                    <input type="hidden" name="id" value="{{$fooditems->id}}">
                                    <div class="makedishbox border-top mt-4 pt-4">
                                       <div class="">
                                       <div class="mb-3">
                                        <label
                                            class="form-label">{{ __('frontend.Please_rate_your_level_of_satisfaction_with_the_following_aspects_of_the_meal:') }}</label>
                                        <p class="help_text mt-1">On a scale of 1 to 5, with 1 being "Not at all satisfied"
                                            and
                                            5 being "Extremely satisfied," please rate each aspect accordingly.</p>
                                       </div>
                                            <div class="row g-3">
                                            <div class="col-md-6">
                                            <label class="form-label">The ingredients used in the dish</label>
                                            <select class="form-select" name="rate_ingredients_used">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">The preparation time required</label>
                                            <select class="form-select" name="rate_preparation_time">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">The description provided on how to prepare the
                                                meal</label>
                                            <select class="form-select" name="rate_how_prepare_meal">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        </div>
                                        </div>
                                        <div class="border-top mt-4 pt-4">
                                           
                                                <div class="mb-3">

                                                
                                           
                                        <label
                                            class="form-label">{{ __('frontend.Please_indicate_your_preferences_for_the_ingredients_used_in_the_dish_by_selecting_the_appropriate_options_below:') }}</label>
                                        <p class="help_text mt-1">
                                            {{ __('frontend.Please_choose_as_many_options_as_applicable_for_both_questions.') }}
                                        </p>
                                        </div>
                                        <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('frontend.Which_ingredients_did_you_like?') }}
                                            </label>
                                            <select class="form-select select2" multiple name="ingredients_like[]">
                                                @foreach (explode(';', $fooditems->ingredients) as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach

                                            </select>

                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label">{{ __('frontend.Which_ingredients_did_you_dislike?') }}</label>
                                            

                                            <select class="form-select select2" multiple name="ingredients_dislike[]">
                                                @foreach (explode(';', $fooditems->ingredients) as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror

                                            <p class="help_text mt-1"></p>
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div class="border-top mt-4 pt-4">
                                        <label
                                            class="form-label">{{ __('frontend.Please_rate_your_level_of_satisfaction_with_the_preparation_time_of_the_meal_based_on_the_following_aspects:') }}</label>
                                            <div class="row g-3">
                                            <div class="col-md-6">
                                            <label
                                                class="form-label">{{ __('frontend.Was_the_preparation_time_suitable_for_your_needs?') }}</label>
                                            <select class="form-select" name="preparation_time_suitable">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="Yes, it was perfectly timed.">Yes, it was perfectly timed.
                                                </option>
                                                <option value="Yes, it was adequate.">Yes, it was adequate.</option>
                                                <option
                                                    value="Neutral, it neither exceeded nor fell short of expectations.">
                                                    Neutral, it neither exceeded nor fell short of expectations.</option>
                                                <option value="No, it took longer than expected."> No, it took longer than
                                                    expected.</option>
                                                <option value="No, it was too short and rushed.">No, it was too short and
                                                    rushed.</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label">{{ __('frontend.Did_the_preparation_time_align_with_the_estimated_time_provided?') }}</label>
                                            <select class="form-select" name="preparation_time_align">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="Yes, it matched the estimated time accurately."> Yes, it
                                                    matched
                                                    the estimated time accurately.</option>
                                                <option value="Yes, but it was slightly longer than the estimated time.">
                                                    Yes,
                                                    but it was slightly longer than the estimated time.</option>
                                                <option value="Neutral, I did not pay attention to the estimated time">
                                                    Neutral,
                                                    I did not pay attention to the estimated time</option>
                                                <option value="No, it took less time than the estimated time">No, it took
                                                    less
                                                    time than the estimated time</option>
                                                <option
                                                    value="No, it took significantly more time than the estimated time.">No,
                                                    it took significantly more time than the estimated time.</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        </div>
                                        </div>
                                        <div class="border-top mt-4 pt-4">
                                        <label class="form-label">{{ __('frontend.Clarity_of_instructions:') }}</label>
                                        <div class="row g-3">
                                        <div class="col-md-6">
                                            <label
                                                class="form-label">{{ __('frontend.How_clear_and_easy_to_follow_were_the_instructions_provided_to_prepare_the_meal?') }}</label>
                                            <select class="form-select" name="instructions_provided">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="Not at all clear"> Not at all clear</option>
                                                <option value="Somewhat unclear"> Somewhat unclear</option>
                                                <option value="Neutral"> Neutral</option>
                                                <option value="Somewhat clear"> Somewhat clear</option>
                                                <option value="Very clear"> Very clear</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        </div>
                                        </div>
                                        <div class="border-top mt-4 pt-4">
<div class="mb-3">
                                        <label
                                            class="form-label">{{ __('frontend.Please_rate_the_taste_of_the_dish_based_on_the_following_flavor_profiles:') }}</label>
                                        <p class="help_text mt-1">
                                            {{ __('frontend.rate_the_taste') }}
                                        </p>
</div>
                                        <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('frontend.Sweet_taste:') }}</label>
                                            <select class="form-select" name="rate_of_sweet_taste">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="Not at all present"> Not at all present</option>
                                                <option value="Slightly present"> Slightly present</option>
                                                <option value="Moderately present"> Moderately present</option>
                                                <option value="Quite present"> Quite present</option>
                                                <option value="Very prominent"> Very prominent</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('frontend.Sour_taste:') }}</label>
                                            <select class="form-select" name="rate_of_sour_taste">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="Not at all present"> Not at all present</option>
                                                <option value="Slightly present"> Slightly present</option>
                                                <option value="Moderately present"> Moderately present</option>
                                                <option value="Quite present"> Quite present</option>
                                                <option value="Very prominent"> Very prominent</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('frontend.Bitter_taste:') }}</label>
                                            <select class="form-select" name="rate_of_bitter_taste">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="Not at all present"> Not at all present</option>
                                                <option value="Slightly present"> Slightly present</option>
                                                <option value="Moderately present"> Moderately present</option>
                                                <option value="Quite present"> Quite present</option>
                                                <option value="Very prominent"> Very prominent</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('frontend.Spicy_taste:') }}</label>
                                            <select class="form-select" name="rate_of_spicy_taste">
                                                <option value="">{{ __('frontend.Select') }}</option>
                                                <option value="Not at all present"> Not at all present</option>
                                                <option value="Slightly present"> Slightly present</option>
                                                <option value="Moderately present"> Moderately present</option>
                                                <option value="Quite present"> Quite present</option>
                                                <option value="Very prominent"> Very prominent</option>
                                            </select>
                                            @error('TypeDiet')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                </div>

                            
                                <div class="border-top pt-4 mt-4">
                                    <label class="form-label"><span id="sno">7</span>
                                        {{ __('frontend.Do_you_have_any_other_comments_or_recommendations?') }}</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="other_recommendations" rows="4"
                                                placeholder="Enter your comments or recommendations here"></textarea>
                                                @error('other_recommendations')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    </div>
                                   

                                    <div class="mt-4">
                                        <input type="submit" value="Submit" class="btn btn-success" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        $('#handleChangeMakeDish').on('change', function() {
            console.log($(this).val());
            if ($(this).val() == 'no') {
                $('.makedishbox').hide();
                $('#sno').text(2)
            } else {
                $('#sno').text(7)
                $('.makedishbox').show();
            }
        });
    </script>
@endsection

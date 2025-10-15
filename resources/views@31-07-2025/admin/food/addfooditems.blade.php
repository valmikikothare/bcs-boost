@extends('layouts.admin_main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="alert alert-info">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="m-0"> {{ __('admin.food-items') }}</span>
                        </div>
                        <div>
                            <a class="btn btn-primary btn-sm" style="background-color: white; color: blue;" href="{{ route('views.fooditems') }}">{{ __('admin.back') }}</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-3">
                        @if(session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{ route('views.storefooditems') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.names') }}</strong>
                                        <input type="text" name="name" class="form-control" placeholder="{{ __('admin.name') }}">
                                        @error('name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.portions') }}</strong>
                                        <input type="text" name="portions" class="form-control" placeholder="{{ __('admin.portion') }}">
                                        @error('Portions')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.times') }}</strong>
                                        <input type="text" name="time" class="form-control" placeholder="{{ __('admin.time') }}">
                                        @error('Time')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.typemeal') }}</strong>
                                        <input type="text" name="type_meal" class="form-control" placeholder="{{ __('admin.typemeal') }}">
                                        @error('TypeMeal')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.typediet') }}</strong>
                                        <select name="type_diet" class="form-control select2">
                                            <option value="">{{ __('admin.select_typediet') }}</option>
                                            @foreach($diet as $dietItem)
                                            <option value="{{ $dietItem->id }}">{{ $dietItem->diet }}</option>
                                            @endforeach
                                        </select>
                                        @error('TypeDiet')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.tastes') }}</strong>
                                        <select name="taste" class="form-control select2">
                                            <option value="">{{ __('admin.select_taste') }}</option>
                                            @foreach($tastes as $taste)
                                            <option value="{{ $taste->id }}">{{ $taste->taste }}</option>
                                            @endforeach
                                        </select>
                                        @error('taste')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.kitchenregion') }}</strong>
                                        <select name="kitchen_region" class="form-control select2">
                                            <option value="">{{ __('admin.select_taste') }}</option>
                                            @foreach($kitchens as $kitchen)
                                            <option value="{{ $kitchen->id }}">{{ $kitchen->kitchen }}</option>
                                            @endforeach
                                        </select>
                                        @error('kitchen_region')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.preparations') }}</strong>
                                        <select name="preparation" class="form-control select2">
                                            <option value="">{{ __('admin.preparations') }}</option>
                                            @foreach($preparations as $preparation)
                                            <option value="{{ $preparation->id }}">{{ $preparation->preparation }}</option>
                                            @endforeach
                                        </select>
                                        @error('preparation')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.sidedish') }}</strong>
                                        <select name="sidedish" class="form-control select2">
                                            <option value="">{{ __('admin.sidedish') }}</option>
                                            @foreach($sidedish as $sidedish)
                                            <option value="{{ $sidedish->id }}">{{ $sidedish->sidedish }}</option>
                                            @endforeach
                                        </select>
                                        @error('sidedish')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.vegetable') }}</strong>
                                        <select name="vegetable" class="form-control select2">
                                            <option value="">{{ __('admin.vegetable') }}</option>
                                            @foreach($vegetable as $vegetable)
                                            <option value="{{ $vegetable->id }}">{{ $vegetable->vegetable }}</option>
                                            @endforeach
                                        </select>
                                        @error('vegetable')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.meat') }}</strong>
                                        <select name="meat" class="form-control select2">
                                            <option value="">{{ __('admin.meat') }}</option>
                                            @foreach($meat as $meat)
                                            <option value="{{ $meat->id }}">{{ $meat->meat }}</option>
                                            @endforeach
                                        </select>
                                        @error('meat')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <strong>{{ __('admin.images:') }}</strong>
                                            <input type="file" name="image" class="form-control-file">
                                            @error('image')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <strong>{{ __('admin.ingredients') }}</strong>
                                            <textarea name="ingredients" rows="6" class="form-control" placeholder="{{ __('admin.ingredient') }}"></textarea>
                                            @error('ingredients')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <strong>{{ __('admin.short_desc') }}</strong>
                                            <textarea name="short_desc" rows="6" class="form-control" placeholder="{{ __('admin.short_desc') }}"></textarea>
                                            @error('short_desc')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                   
                                </div>




                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('admin.recipe') }}</strong>
                                        <textarea name="prepare" class="ckeditor form-control" placeholder="{{ __('frontend.recipes') }}"></textarea>
                                        @error('prepare')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>





                            </div>
                            <button type="submit" class="btn btn-primary ml-3">{{ __('admin.submit') }}</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>


            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@endsection
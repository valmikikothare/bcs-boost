@extends('layouts.admin_main')

@section('content')



<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="alert alert-info">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="m-0">{{ __('admin.food_details') }}</span>
                        </div>
                        <div>
                            <div>
                                <a class="btn btn-primary btn-sm" style="background-color: white; color: blue;" href="{{ route('views.fooditems') }}">{{ __('admin.back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <!-- <div class="card-header adminColor">
                                <h3 class="card-title">Food Details</h3>
                            </div> -->
                            <div class="bg-white p-3 rounded p-3 shadow">
                                <div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form>
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <div class="flex-shrink-0"><span class="badge bg-warning"></span></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <div>
                                            <div style="width: 100%; padding: 0px 40px; border-radius: 10px; background-color: rgb(255, 255, 255); margin: 0px auto; border: 1px solid rgb(221, 221, 221); font-size: 14px; color: rgb(0, 0, 0);">
                                                <div>

                                                    <div class="mt-3">
                                                        <table class="table table-bordered table-striped table-sm m-0" style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td><b>{{ __('admin.name') }}</b></td>
                                                                    <th>{{ $foodItem->name }}</th>
                                                                    <td rowspan="24" style="text-align: center; vertical-align: top;">
                                                                        <div style="border: 1px solid rgb(221, 221, 221); padding: 10px; width: 300px; text-align: center; margin: 0px auto;">
                                                                            @if ($foodItem->image)
                                                                            <img src="{{ env('AWS_URL').env('AWS_S3_FOLDER_NAME').$foodItem->image }}" alt="Food Item Image" class="img-fluid" width="280">
                                                                            @else
                                                                            No image available
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="width: 270px;"><b>{{ __('admin.ingredient') }}</b></td>
                                                                    <td>{{ $foodItem->ingredients }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{ __('admin.recipes') }}</b></td>
                                                                    <td>{!! $foodItem->prepare !!}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{ __('admin.portion') }}</b></td>
                                                                    <td>{{ $foodItem->portions }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{ __('admin.times') }}</b></td>
                                                                    <td>{{ $foodItem->time }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>{{ __('admin.type_meal') }}</b></td>
                                                                    <td>{{ $foodItem->type_meal }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{ __('admin.type_diet') }}</b></td>
                                                                    <td><td>{{ $foodItem->Managediet->diet ?? "-" }}</td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{ __('admin.taste') }}</b></td>
                                                                    <td>{{ $foodItem->Managetaste->taste ?? "-" }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Cuisine</b></td>
                                                                    <td>{{ $foodItem->Managekitchen != "" ?$foodItem->Managekitchen->kitchen : "-" }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{ __('admin.preparation') }}</b></td>
                                                                    <td>{{ $foodItem->Managepreparation->preparation ?? "-" }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{ __('admin.sidedish') }}</b></td>
                                                                    <td>{{ $foodItem->Managesidedish != "" ?$foodItem->Managesidedish->sidedish : "-"  }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{ __('admin.vegetable') }}</b></td>
                                                                    <td>{{ $foodItem->Managevegetables != "" ?$foodItem->Managevegetables->vegetable : "-"  }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{ __('admin.meat') }}</b></td>
                                                                    <td>{{ $foodItem->Managemeat != "" ?$foodItem->Managemeat->meat : "-"  }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
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
                            <span class="m-0">{{ __('admin.upload_csv') }}</span>
                        </div>
                        <div>
                            <div>
                                <a class="btn btn-primary btn-sm" style="background-color: white; color: blue;" href="{{ route('views.fooditems') }}">{{ __('admin.back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-3">
                        <div class="table-responsive">

                        <form action="{{ route('views.storefooditems_csv') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="csv_file">{{ __('admin.csv_files') }}</label>
                                    <input type="file" name="csv_file" id="csv_file" class="form-control-file" accept=".csv, .txt" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('admin.upload') }}</button>
                            </form>

                            <div class="mt-3">
                                <a class="btn btn-secondary" href="{{ asset('TemplateCSV.csv') }}" download>{{ __('Download Sample CSV') }}</a>

                            </div>


                        </div>
                    </div>
                    <!-- /.card-body -->

                  
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
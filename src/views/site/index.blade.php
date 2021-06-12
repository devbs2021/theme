@extends('theme::layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/dropzone/min/dropzone.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Site Setting</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Site Setting</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Site Setting</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>


            <!-- /.card-header -->
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="font-size: smaller;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="row form" method="post" action="{{ route('sites.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                value="{{ Theme::siteSetup()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone"
                                value="{{ Theme::siteSetup()->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email"
                                value="{{ Theme::siteSetup()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Enter address" value="{{ Theme::siteSetup()->address }}">
                        </div>
                        <div class="form-group">
                            <label for="working_hour">Working Hour</label>
                            <input type="text" class="form-control" id="working_hour" name="working_hours"
                                placeholder="Enter working hour" value="{{ Theme::siteSetup()->working_hours }}">
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Introduction</label>
                            <textarea class="form-control" name="introduction" rows="5"
                                placeholder="Enter Short Introduction">{{ Theme::siteSetup()->introduction }}</textarea>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Map</h3>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="map">{{ Theme::siteSetup()->map }}</textarea>
                            </div>
                            <div class="card-body" style="width: 100%;">
                               {!! Theme::siteSetup()->map !!}
                            </div>
                        </div>

                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="exampleInputFile">Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input file-input"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <img src="@if(Theme::siteSetup()->logo) {{ asset('storage/'.Theme::siteSetup()->logo) }} @endif"
                                    class="preview img-fluid" style="max-height: 200px; max-width:auto;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Favicon</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="favicon" class="custom-file-input file-input-icon"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <img src="@if(Theme::siteSetup()->favicon) {{ asset('storage/'.Theme::siteSetup()->favicon) }} @endif"
                                    class="preview-icon img-fluid" style="max-height: 200px; max-width:auto;">
                            </div>
                        </div>

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Social Links</h3>
                            </div>
                            <div class="card-body">
                                <label for="facebook">Facebook</label>
                                <input type="text" class="form-control" id="met_title" name="facebook"
                                    placeholder="Enter Facebook Link" value="{{ Theme::siteSetup()->facebook }}">
                            </div>
                            <div class="card-body">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control" id="met_title" name="twitter"
                                    placeholder="Enter Twitter Link" value="{{ Theme::siteSetup()->twitter }}">
                            </div>
                            <div class="card-body">
                                <label for="google">Google</label>
                                <input type="text" class="form-control" id="met_title" name="google"
                                    placeholder="Enter Google Link" value="{{ Theme::siteSetup()->google }}">
                            </div>
                            <div class="card-body">
                                <label for="youtube">Youtube</label>
                                <input type="text" class="form-control" id="met_title" name="youtube"
                                    placeholder="Enter YouTUbe Link" value="{{ Theme::siteSetup()->youtube }}">
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-danger float-right" onclick="$('.form')[0].reset()">Reset</a>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </form>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@push('js')
<script src="{{ asset('theme') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="{{ asset('theme') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="{{ asset('theme') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
   
    $(function(){
        $('.select2').select2({
        theme: 'bootstrap4'
        })
        $('#description').summernote({
            height:"300px"
        });
        $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        bsCustomFileInput.init();
        $('.file-input').change(function(){
        var file = $(this).get(0).files[0];
        
        if(file){
        var reader = new FileReader();
        
        reader.onload = function(){
        $(".preview").attr("src", reader.result);
        }
        
        reader.readAsDataURL(file);
        }
        else {
            $(".preview").attr("src",'');
        }
        });
        $('.file-input-icon').change(function(){
        var file = $(this).get(0).files[0];
        
        if(file){
        var reader = new FileReader();
        
        reader.onload = function(){
        $(".preview-icon").attr("src", reader.result);
        }
        
        reader.readAsDataURL(file);
        }
        else {
            $(".preview-icon").attr("src",'');
        }
        });
    });
</script>
@endpush
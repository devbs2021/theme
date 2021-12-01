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
                <h1>Update Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Update Profile</li>
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
                <h3 class="card-title">Update Profile</h3>

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
                <form class="row form" method="post" action="{{ route('update.vendorprofile') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                value="{{ auth()->user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="user_name">User Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name"
                                placeholder="Enter User Name" value="{{ auth()->user()->user_name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter E-mail"
                                value="{{ auth()->user()->email  }}">
                        </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter E-mail"
                                value="{{ auth()->user()->phone  }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Shipping</label>
                            <input type="address" class="form-control" id="address" name="shipping"
                                placeholder="Enter address" value="{{ auth()->user()->shipping }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Profile/Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="profile" class="custom-file-input file-input"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <img src="{{ asset('storage/'.auth()->user()->profile) }}" class="preview img-fluid"
                                    style="max-height: 200px; max-width:auto;">
                            </div>
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
    $('.update-profile').removeClass('menu-is-opening menu-open');
    $('.update-profile').addClass('menu-is-opening menu-open');
    $('.update-profile').find('>:first-child').removeClass('active');
    $('.update-profile').find('>:first-child').addClass('active');
    $(function(){
        $('.select-all').on('click',function(){
            $(".select2 > option").prop("selected","selected");// Select All Options
            $(".select2").trigger("change");
        });
        $('.deselect-all').on('click',function(){
            $(".select2 > option").prop("selected",false);// Select All Options
            $(".select2").trigger("change");
        });
        $('.select2').select2({
        theme: 'bootstrap4'
        })
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
    });
</script>
@endpush
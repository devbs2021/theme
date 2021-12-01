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
                <h1>Create Role</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Create Role</li>
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
                <h3 class="card-title">Create Role</h3>

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
                <form class="form" method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                    value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Permissions</h3>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <!-- ./card-header -->
                                            <div class="card-body">
                                                <a href="javascript:void(0);" class="btn btn-primary select-all"
                                                    style="font-size: x-small;">Select All</a>
                                                <a href="javascript:void(0);" class="btn btn-danger deselect-all"
                                                    style="font-size: x-small;">Deselect All</a>
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>All</th>
                                                            <th>Module</th>
                                                            <th><input type="checkbox" class="view-all">View</th>
                                                            <th><input type="checkbox" class="create-all">Create</th>
                                                            <th><input type="checkbox" class="edit-all">Edit</th>
                                                            <th><input type="checkbox" class="update-all">Update</th>
                                                            <th><input type="checkbox" class="delete-all">Delete</th>
                                                            <th><input type="checkbox" class="menu-all">Menu Bar</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach(config('theme.modules') as $key=>$module)
                                                        <tr class="all-check">
                                                            <td><input type="checkbox" class="all"></td>
                                                            <td>{{ $module }}</td>
                                                            <td><input type="checkbox" class="from-control single view"
                                                                    value="{{ $module }}_view" name="permissions[]"
                                                                    {{ (in_array($module.'_view',old('permissions')??[]))?'checked':'' }}>
                                                            </td>
                                                            <td><input type="checkbox" class="from-control single create"
                                                                    value="{{ $module }}_create" name="permissions[]"
                                                                    {{ (in_array($module.'_create',old('permissions')??[]))?'checked':'' }}>
                                                            </td>
                                                            <td><input type="checkbox" class="from-control single edit"
                                                                    value="{{ $module }}_edit" name="permissions[]"
                                                                    {{ (in_array($module.'_edit',old('permissions')??[]))?'checked':'' }}>
                                                            </td>
                                                            <td><input type="checkbox" class="from-control single update"
                                                                    value="{{ $module }}_update" name="permissions[]"
                                                                    {{ (in_array($module.'_update',old('permissions')??[]))?'checked':'' }}>
                                                            </td>
                                                            <td><input type="checkbox" class="from-control single delete"
                                                                    value="{{ $module }}_delete" name="permissions[]"
                                                                    {{ (in_array($module.'_delete',old('permissions')??[]))?'checked':'' }}>
                                                            </td>
                                                            <td><input type="checkbox" class="from-control single menu"
                                                                    value="{{ $module }}_menu" name="permissions[]"
                                                                    {{ (in_array($module.'_menu',old('permissions')??[]))?'checked':'' }}>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="9">
                                                            </td>
                                                        </tr>
                                                        <tr class="bg-danger" data-widget="expandable-table"
                                                            aria-expanded="false">
                                                            <td colspan="8">

                                                                Sensitive Premissions
                                                            </td>
                                                        </tr>
                                                        <tr class="expandable-body">
                                                            <td colspan="5">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="company_profile">Company
                                                                                Profile</label>
                                                                            <div class="card-body">
                                                                                <input type="checkbox"
                                                                                    id="company_profile"
                                                                                    name="permissions[]"
                                                                                    value="company_profile"
                                                                                    data-bootstrap-switch
                                                                                    data-off-color="danger"
                                                                                    data-on-color="success"
                                                                                    {{ (in_array('company_profile',old('permissions')??[]))?'checked':'' }}>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="setting">Site Setting</label>
                                                                            <div class="card-body">
                                                                                <input type="checkbox" id="setting"
                                                                                    name="permissions[]"
                                                                                    value="site_setting"
                                                                                    data-bootstrap-switch
                                                                                    data-off-color="danger"
                                                                                    data-on-color="success"
                                                                                    {{ (in_array('site_setting',old('permissions')??[]))?'checked':'' }}>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="setting">CSS</label>
                                                                            <div class="card-body">
                                                                                <input type="checkbox" id="setting"
                                                                                    name="permissions[]"
                                                                                    value="css"
                                                                                    data-bootstrap-switch
                                                                                    data-off-color="danger"
                                                                                    data-on-color="success"
                                                                                    {{ (in_array('css',old('permissions')??[]))?'checked':'' }}>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="config">Config</label>
                                                                            <div class="card-body">
                                                                                <input type="checkbox" id="config"
                                                                                    name="permissions[]"
                                                                                    value="config"
                                                                                    data-bootstrap-switch
                                                                                    data-off-color="danger"
                                                                                    data-on-color="success"
                                                                                    {{ (in_array('config',old('permissions')??[]))?'checked':'' }}>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-danger float-right" onclick="$('.form')[0].reset()">Reset</a>
                                <!-- /.form-group -->
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
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
    $('.user-menu').removeClass('menu-is-opening menu-open');
    $('.user-menu').addClass('menu-is-opening menu-open');
    $('.user-menu').find('>:first-child').removeClass('active');
    $('.user-menu').find('>:first-child').addClass('active');
    $(function(){
        $('.select-all').on('click',function(){
           $('input:checkbox').each(function(index,ele){
            ele.checked=true;
           });
        });
        $('.deselect-all').on('click',function(){
           $('input:checkbox').each(function(index,ele){
            ele.checked=false;
            });
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
    $(document).on('change','.all',function(){
          let tr = $(this).closest('.all-check');
       if($(this).is(":checked")){
          tr.find(':checkbox').each(function(index,ele){
            
              ele.checked=true;
          })
       }
       else{
           tr.find(':checkbox').each(function(index,ele){
            
            ele.checked=false;
            })
       }
    });
    $(document).on('change','.single',function(){
        $(this).parent().parent().find('.all').prop('checked',false);
        $(this).parent().parent().find('.all').prop('checked',false);
    });
    $(document).on('change','.create-all',function(){
        if($(this).is(":checked")){
        $('.create').prop('checked',true);
        }
        else{
        $('.create').prop('checked',false);
        $('.all').prop('checked',false);

        }
    });
    $(document).on('change','.view-all',function(){
        if($(this).is(":checked")){
        $('.view').prop('checked',true);
        }
        else{
        $('.view').prop('checked',false);
        $('.all').prop('checked',false);
        }
    });
    $(document).on('change','.edit-all',function(){
        if($(this).is(":checked")){
        $('.edit').prop('checked',true);
        }
        else{
        $('.edit').prop('checked',false);
        $('.all').prop('checked',false);
        }
    });
    $(document).on('change','.update-all',function(){
        if($(this).is(":checked")){
        $('.update').prop('checked',true);
        }
        else{
        $('.update').prop('checked',false);
        $('.all').prop('checked',false);
        }
    });
    $(document).on('change','.delete-all',function(){
        if($(this).is(":checked")){
        $('.delete').prop('checked',true);
        }
        else{
        $('.delete').prop('checked',false);
        $('.all').prop('checked',false);

        }
    });
    $(document).on('change','.menu-all',function(){
        if($(this).is(":checked")){
        $('.menu').prop('checked',true);
        }
        else{
        $('.menu').prop('checked',false);
     $('.all').prop('checked',false);   
    }
    });
</script>
@endpush
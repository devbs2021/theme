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
                <h1>Update Menu</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Update Menu</li>
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
                <h3 class="card-title">Update Menu</h3>

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
                <form class="row form" method="post" action="{{ route('menus.update',$menu->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                                value="{{ $menu->title }}">
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="Enter Link"
                                value="{{ $menu->link }}">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" class="form-control" id="position" name="position"
                                placeholder="Enter position" value="{{ $menu->position }}">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="type">Menu Type</label>
                            <select class="form-control select2" name="type" id="type">
                                <option value="">Choose Menu Type</option>
                                @foreach(\DevbShrestha\Theme\Models\Menu::TYPES as $type)
                                <option value="{{ $type }}" {{ ($type==$menu->type)?'selected':'' }}>
                                    {{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="menu_id">Parent Menu</label>
                            <select class="form-control select2" name="menu_id" id="menu_id">
                                <option value="">Choose Parent Menu</option>
                                @foreach(Theme::getMenus() as $m)
                                @if($m->id!=$menu->id && !in_array($m->id,$menu->menus->pluck('id')->toArray()))
                                <option value="{{ $m->id }}" {{ ($m->id==$menu->menu_id)?'selected':'' }}>
                                    {{ $m->title }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="page_id">Page</label>
                            <select class="form-control select2" name="page_id" id="page_id">
                                <option value="">Choose Page</option>
                                @foreach(Theme::getPage() as $page)
                                <option value="{{ $page->id }}" {{ ($page->id==$menu->page_id)?'selected':'' }}>
                                    {{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="status" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success" {{ ($menu->status)?'checked':'' }}>
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
    $('.menu-menu').removeClass('menu-is-opening menu-open');
        $('.menu-menu').addClass('menu-is-opening menu-open');
        $('.menu-menu').find('>:first-child').removeClass('active');
        $('.menu-menu').find('>:first-child').addClass('active');
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
    });
</script>
@endpush
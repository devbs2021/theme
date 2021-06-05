@extends('theme::layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Setting</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Setting</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Setting</h3>

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
                <form class="row form" method="post" action="{{ route('settings.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        @php($classes = ['card-info', 'card-primary','card-success','card-danger','card-secondary'])
                        @php($packages = Theme::setting())
                        @php($chunk = ceil(count($packages)/2))
                        @foreach($packages->take($chunk) as $package)
                        @php($className = array_rand($classes))
                        <div class="card {{ $classes[$className] }}">
                            <div class="card-header">
                                <h3 class="card-title">{{ $package->module }}</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="{{ $package->module }}" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success"
                                    {{ ($package->status)?'checked':'' }}>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        @foreach($packages->skip($chunk) as $package)
                        @php($className = array_rand($classes))
                        <div class="card {{ $classes[$className] }}">
                            <div class="card-header">
                                <h3 class="card-title">{{ $package->module }}</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="{{ $package->module }}" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success"
                                    {{ ($package->status)?'checked':'' }}>
                            </div>
                        </div>
                        @endforeach
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
<script src="{{ asset('theme') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $(function(){
    $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    });
</script>
@endpush
@extends('theme::layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Config</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Update Config</li>
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
                <h3 class="card-title">Config</h3>

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
                <form class="row form" method="post" action="{{ route('config.store') }}" enctype="multipart/form-data">
                    @csrf
                    @foreach (config('config')??[] as $key=>$val )
                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">{{ \Illuminate\Support\Str::upper($key) }}</h3>
                            </div>
                            @foreach ($val as $k=>$v)
                            @if($k=="logo")
                            <div class="card-body">
                                <label for="{{ Illuminate\Support\Str::slug($k) }}">{{ Illuminate\Support\Str::upper($k)
                                    }}</label>
                                <input type="file" class="form-control" id="{{ Illuminate\Support\Str::slug($k) }}"
                                    name="{{ $key }}_{{ $k }}">
                                @if($v)
                                <img src="{{ asset('storage/'.$v) }}" height="100px">
                                @endif
                            </div>
                            @else
                            <div class="card-body">
                                <label for="{{ Illuminate\Support\Str::slug($k) }}">{{ Illuminate\Support\Str::upper($k)
                                    }}</label>
                                <input type="text" class="form-control" id="{{ Illuminate\Support\Str::slug($k) }}"
                                    name="{{ $key }}_{{ $k }}" placeholder="Enter {{ $k }}" value="{{ $v }}">
                            </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-12">
                        <input type="submit" value="Update" class="btn btn-primary">
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
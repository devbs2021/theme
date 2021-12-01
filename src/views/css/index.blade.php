@extends('theme::layouts.master')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.61.1/codemirror.min.css"
    integrity="sha512-xIf9AdJauwKIVtrVRZ0i4nHP61Ogx9fSRAkCLecmE2dL/U8ioWpDvFCAy4dcfecN72HHB9+7FfQj3aiO68aaaw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .cm-s-abcdef.CodeMirror {
        background: #0f0f0f;
        color: #defdef;
        width: 100%;
        height: 70vh;
    }

    .cm-s-abcdef div.CodeMirror-selected {
        background: #515151;
    }

    .cm-s-abcdef .CodeMirror-line::selection,
    .cm-s-abcdef .CodeMirror-line>span::selection,
    .cm-s-abcdef .CodeMirror-line>span>span::selection {
        background: rgba(56, 56, 56, 0.99);
    }

    .cm-s-abcdef .CodeMirror-line::-moz-selection,
    .cm-s-abcdef .CodeMirror-line>span::-moz-selection,
    .cm-s-abcdef .CodeMirror-line>span>span::-moz-selection {
        background: rgba(56, 56, 56, 0.99);
    }

    .cm-s-abcdef .CodeMirror-gutters {
        background: #555;
        border-right: 2px solid #314151;
    }

    .cm-s-abcdef .CodeMirror-guttermarker {
        color: #222;
    }

    .cm-s-abcdef .CodeMirror-guttermarker-subtle {
        color: azure;
    }

    .cm-s-abcdef .CodeMirror-linenumber {
        color: #FFFFFF;
    }

    .cm-s-abcdef .CodeMirror-cursor {
        border-left: 1px solid #00FF00;
    }

    .cm-s-abcdef span.cm-keyword {
        color: darkgoldenrod;
        font-weight: bold;
    }

    .cm-s-abcdef span.cm-atom {
        color: #77F;
    }

    .cm-s-abcdef span.cm-number {
        color: violet;
    }

    .cm-s-abcdef span.cm-def {
        color: #fffabc;
    }

    .cm-s-abcdef span.cm-variable {
        color: #abcdef;
    }

    .cm-s-abcdef span.cm-variable-2 {
        color: #cacbcc;
    }

    .cm-s-abcdef span.cm-variable-3,
    .cm-s-abcdef span.cm-type {
        color: #def;
    }

    .cm-s-abcdef span.cm-property {
        color: #fedcba;
    }

    .cm-s-abcdef span.cm-operator {
        color: #ff0;
    }

    .cm-s-abcdef span.cm-comment {
        color: #7a7b7c;
        font-style: italic;
    }

    .cm-s-abcdef span.cm-string {
        color: #2b4;
    }

    .cm-s-abcdef span.cm-meta {
        color: #C9F;
    }

    .cm-s-abcdef span.cm-qualifier {
        color: #FFF700;
    }

    .cm-s-abcdef span.cm-builtin {
        color: #30aabc;
    }

    .cm-s-abcdef span.cm-bracket {
        color: #8a8a8a;
    }

    .cm-s-abcdef span.cm-tag {
        color: #FFDD44;
    }

    .cm-s-abcdef span.cm-attribute {
        color: #DDFF00;
    }

    .cm-s-abcdef span.cm-error {
        color: #FF0000;
    }

    .cm-s-abcdef span.cm-header {
        color: aquamarine;
        font-weight: bold;
    }

    .cm-s-abcdef span.cm-link {
        color: blueviolet;
    }

    .cm-s-abcdef .CodeMirror-activeline-background {
        background: #314151;
    }
</style>

@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update CSS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Update CSS</li>
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
                <h3 class="card-title">CSS</h3>

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
                <form class="row form" method="post" action="{{ route('css.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <textarea name="css" id="editor" class="form-control">{{ config('style.css') }}</textarea>

                    <input type="submit" value="Update" class="btn btn-primary">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.61.1/codemirror.min.js"
    integrity="sha512-ZTpbCvmiv7Zt4rK0ltotRJVRaSBKFQHQTrwfs6DoYlBYzO1MA6Oz2WguC+LkV8pGiHraYLEpo7Paa+hoVbCfKw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let textArea = document.getElementById('editor');
var editor = CodeMirror.fromTextArea(textArea, {
lineNumbers: true,
styleActiveLine: true,
mode: "htmlmixed",
matchBrackets: true
});
editor.setOption("theme", 'abcdef');

    
</script>
@endpush
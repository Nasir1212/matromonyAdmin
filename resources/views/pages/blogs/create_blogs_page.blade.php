@extends("master.layout")
@section("content")
{{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}

<div class="container-fluid">
   <div class="row">
    <div class="col">
       <div class="card" style="height: 40rem">
        <div class="card-header">
            <div class="card-text">
                <h4> Create Blog </h4>
            </div>
        </div>
        @if (session('message'))
        <div class="alert @if(session('condition')== true)  alert-success @else   alert-error  @endif">
            {{ session('message') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{URL::to("/create_blogs")}} " method="POST" enctype="multipart/form-data">
            <div class="row">
           <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
            <label for="" class="form-label"><small>Blog Title </small> </label>
            <input  type="text"  name="title" class="form-control"  placeholder="Enter Blog title"   />
           </div>
           @csrf
           <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
            <label for="" class="form-label"><small>Blog Image </small> </label>
            <input  type="file"  name="img_path" class="form-control"   />
           </div>

           <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
            <label for="" class="form-label"><small>Keywords</small> </label>
            <input  type="text"  name="keywords" class="form-control"  placeholder="Enter Keywords"   />
           </div>

           <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
            <label for="" class="form-label"><small>Meta Discription</small> </label>
            <input  type="text"  name="meta_discription" class="form-control"  placeholder="Enter Meta Discription"   />
           </div>

           <div class="mb-3 col-sm-12 col-md-12 col-lg-12">
            <label for="" class="form-label"><small> Content </small> </label>
           <textarea class="form-control"  name="blog" id="summernote" ></textarea>
           </div>

           <div class="mb-3  col-sm-12 col-md-12 col-lg-12">
            <button class="btn btn-success btn-sm font-weight-bold">Submit</button>
           </div>
     
        </div>
    </form>
        </div>
       </div>
    </div>
   </div>
</div>

@endsection


@section('file_js')
<script>
    $('#summernote').summernote({
        placeholder:'Enter your content',
        tabsize: 2,
        height: 220,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', ]],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
   
  </script>
@endsection

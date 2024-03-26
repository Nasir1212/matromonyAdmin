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
            <form action="{{URL::to("/update_blog")}} " method="POST" enctype="multipart/form-data">
            <div class="row">
           <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
            <label for="" class="form-label"><small>Blog Title </small> </label>
            <input  type="text"  name="title" class="form-control" value="{{$blog->title ?? ''}}"  placeholder="Enter Blog title"   />
            <input  type="hidden"  name="id" class="form-control" value="{{$blog->id ?? ''}}"  placeholder="Enter Blog title"   />
            <input  type="hidden"  name="old_img_path" class="form-control" value="{{$blog->img_path ?? ''}}"  placeholder="Enter Blog title"   />
           </div>
           @csrf
           <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
            
            <label for="" class="form-label"><small>Blog Image </small> </label>
            <div class="row">
                <div class="col-3"><img style="width: 100px;height:70px" src="@if($blog->img_path != null)https://img.ordhangini.com/uploads/{{$blog->img_path}}@else https://ordhangini.com/frontend/img/220_F_137578103_ulK9MbD9IfKACx9RZe6Rx7PAyBA9aN2K.jpg @endif" alt=""></div>
                <div class="col-9">  <input style="float: left" type="file"  name="img_path" class="form-control"   /></div>
            </div>
          
           </div>

           <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
            <label for="" class="form-label"><small>Keywords</small> </label>
            <input  type="text"  name="keywords" value="{{$blog->keywords ?? ''}}" class="form-control"  placeholder="Enter Keywords"   />
           </div>

           <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
            <label for="" class="form-label"><small>Meta Discription</small> </label>
            <input  type="text"  name="meta_discription" value="{{$blog->meta_discription ?? ''}}" class="form-control"  placeholder="Enter Meta Discription"   />
           </div>

           <div class="mb-3 col-sm-12 col-md-12 col-lg-12">
            <label for="" class="form-label"><small> Content </small> </label>
           <textarea class="form-control" name="blog" id="summernote" >
            {!! $blog->blog ?? '' !!}
           </textarea>
           </div>

           <div class="mb-3  col-sm-12 col-md-12 col-lg-12">
            <button class="btn btn-success btn-sm font-weight-bold">Update</button>
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

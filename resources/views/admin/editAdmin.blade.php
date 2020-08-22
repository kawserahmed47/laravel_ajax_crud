@extends('back.adminMaster')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row ">
        <div class="col-sm-6">
            <h1>Edit Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9">
          @if (Session::get('message'))
            <p class="bg-info text-center">{{ Session::get('message') }}</p>
          @endif
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Admin</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
          <form action="{{route('updateAdmin',Auth::guard('admin')->user()->id)}}" method="POST" enctype="multipart/form-data" > 
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Admin Name</label>
              <input type="text" name="name" id="inputName" value="{{$result->name}}" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="inputName">Old Password</label>
                <input type="password" name="password" id="inputName"  class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">New Password</label>
                <input type="password" name="new_password" id="inputName"  class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Insert Image</label> 
                <div class="input-group">
                  <div class="custom-file">
                  <input type='file' name="image" id="imgInp_slider" />
                  <img style="width: 100px; height: 100px;" id="blah_slider" src="" alt="Preview" />
                </div>
                </div>
              </div>

              <div class="form-group">
               
                <img style="height: 100px; width:100px" src="{{asset($result->image)}}" alt="Profile Picture">
              </div>
             
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
     
      </div>
      <div class="row mb-5">
        <div class="col-md-9">
        <a href="{{route('dashboard')}}" class="btn btn-secondary">Cancel</a>
          <button class="btn btn-success float-right" type="submit" > Update </button>
        </div>
      </div>
      </form>
      </div>
    </section>
    <!-- /.content -->
    

@endsection
@section('extraJS')
{{-- <script>
$("#selectStatus").val({{ $results->status }});
</script>
     --}}

     <script>
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#blah_slider').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#imgInp_slider").change(function(){
          readURL(this);
      });
     
      </script>
@endsection
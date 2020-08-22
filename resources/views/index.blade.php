<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

    <title>Laravel Ajax</title>
  </head>
  <body>

{{-- Insert Data Modal --}}
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Insert Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="">
          <form action="{{route('insertproduct')}}" method="POST">
              @csrf
              <label for="">Product Name: <input class="form-control" type="text" id="name" name="name" placeholder="name">
              </label>
              <label for="">Price: <input class="form-control" type="text" id="price"  name="price" placeholder="price">
              </label>
              <label for="">Details: <input class="form-control" type="text" id="details" name="details" placeholder="details">
              </label>
              <label for="">Status: <input id="status"  type="checkbox" name="status" value="1" >
              </label><br>

              <button  type="submit" name="submit" id="submit"  class="btn btn-info">Submit</button>
            </form>
          </div>
        </div>
        
      </div>
    </div>
  </div>





  
{{-- Edit Data Modal --}}
  <!-- Modal -->
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Poduct</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('updateproduct')}}" method="POST">
            @csrf
            <input type="hidden" name="id" id="" value="">
            <label for="">Product Name: <input class="form-control" type="text" name="name" value="" placeholder="name">
            </label>
            <label for="">Price: <input class="form-control" type="text" name="price" value="" placeholder="price">
            </label>
            <label for="">Details: <input class="form-control" type="text" name="details" value="" placeholder="details">
            </label>
            <label for="">Status: <input type="checkbox" name="status" value="1" >
            </label><br>
            <button  type="submit"  class="btn btn-info">Submit</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>







{{-- MENU/NAVBAR --}}


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('index')}}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
          <ul class="navbar-nav">
            <li class="nav-item ">
            <a class="nav-link" href="{{route('adminLogout')}}">Logout</a>
            </li>
          </ul>
  
      </nav>


{{-- MAIN CONTENT/ WEB BODY --}}

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="p-3">
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal">
                    Add Product
                  </button>
                
                <form class="form-inline my-2 my-lg-0 float-right">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

            </div>
         
            <table class="table" id="productTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Details</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                {{-- <tbody>
                  @if ($products)
                  @foreach ($products as $key=>$product)
                  <tr>
                  <th scope="row">{{++$key}}</th>
                  <td>{{$product->name}}</td>
                  <td>{{$product->price}}</td>
                  <td>{{$product->details}}</td>

                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal1">
                            EDIT
                        </button>
                          <a class="btn btn-danger" href="#">DELETE</a>
                    </td>
                  </tr>
                  @endforeach
               
                  @else 
                  <tr>
                    <td colspan="4">No Data Found</td>
                  </tr>
                      
                  @endif
                 
                </tbody> --}}
              </table>

        </div>

    </div>

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
         function del(id){
          var token = $('meta[name="csrf-token"]').attr('content');
           console.log(id);
          $.ajax({
            type: "POST",
            url: "{{route('deleteproduct')}}",
            data: {
              _token:token,
              id:id,
            },
            dataType: "json",
            success: function (response) {
              // read();
              console.log('Delete Successful');
            }
          });
        }
      $(document).ready(function(){
        read();

        $('#submit').click(function(e){
          e.preventDefault();
          var name = $('#name').val();
          var price = $('#price').val();
          var details= $('#details').val();
          var status = $('#status').val();
          console.log(name + price + details + status);
          var token = $('meta[name="csrf-token"]').attr('content');

          $.ajax({
            type: "POST",
            url: "{{route('insertproduct')}}",
            data: {
              _token:token,
              name:name,
              price:price,
              details:details,
              status:status
            },
            dataType: "json",
            success: function (response) {
              $("#exampleModal .close").click()
              read();
            }
          });
        });

        function read(){
          $.ajax({
            type: "GET",
            url: "{{route('getproduct')}}",
            dataType: "json",
            success: function (response) {
              $("#productTable").html(response);
            }
          });
        }

        // $(".del").click(function del($id){
        //    console.log($id);
        // });

     

      });

    </script>
  </body>
</html>
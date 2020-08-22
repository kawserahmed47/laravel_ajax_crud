<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use DB;
use Redirect;
use Response;
class MyController extends Controller
{
    public function index(){
        $data = array();
        $data['products']=Product::orderBy('id', 'desc')->paginate(5);
        return view('index',$data);
    }

    public function insertproduct(Request $request){
        $time = time();
        $data = array();
        $data['name']= $request->name;
        $data['price']= $request->price;
        $data['details']= $request->details;
        $data['status']=$request->status;
        $data['created_at']= date("Y-m-d h:i:s",$time);
        $query = DB::table('products')->insert($data);

        if($query){
            // return Redirect::route('index');
            return Response::json($data);
        }

    }

    public function getproduct(){
        $query = DB::table('products')->get();
        $product= "";
        if($query){
            foreach($query as $data){
                $product.="<tr><td>$data->id</td><td>$data->name</td><td>$data->price</td><td>$data->details</td><td><a href=''>EDIT</a> <a onClick='del($data->id)' class='del' href='#'>X</a></td></tr>";
            }
            $product .="";
        }
        return Response::json($product);
    }

    public function deleteproduct(Request $request){
        $id = $request->id;
        $query = DB::table('products')->delete($id);
        if($query){
            return Response::json($id);
        }

    }

    public function updateproduct(Request $request){
        $time = time();
        $data = array();
        $id = $request->id;
        $data['name']= $request->name;
        $data['price']= $request->price;
        $data['details']= $request->details;
        $data['status']=$request->status;
        $data['updated_at']= date("Y-m-d h:i:s",$time);
        $query = DB::table('products')->where('id',$id)->update($data);
        if($query){
            return Redirect::route('index');
        }


    }












    public function store(Request $request)
    {
        //
        $postID = $request->post_id;
        $post   =   Post::updateOrCreate(['id' => $postID],
                    ['title' => $request->title, 'body' => $request->body]);
    
        return Response::json($post);
    }

    public function edit($id)
    {
        //
        $where = array('id' => $id);
        $post  = Post::where($where)->first();
 
        return Response::json($post);
    }

    public function destroy($id)
    {
        //
        $post = Post::where('id',$id)->delete();
   
        return Response::json($post);
    }
}

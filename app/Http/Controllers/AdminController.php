<?php

namespace App\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    public function adminLogin(){

        return view('admin.adminLogin');
    }

    public function loginCheck(Request $request){

        $email = $request->email;
        $query= DB::table('users')->where('email', $email)->first();
        $password = $request->password;

        if($query){

            if (Hash::check($password, $query->password)) {
                
                    if(Auth::attempt(['email' => $email, 'password' => $password]))
                    {
                        Session::flash('message', 'Login Successful');
                            return redirect()->route('index');
                       

                    }
                        else{
                            Session::flash('message', 'Authorization not found');
                            return redirect()->route('adminLogin');
                        }
            }else{
                Session::flash('message', 'Password Does not match!!');
                return redirect()->route('adminLogin');

            }

    }else{
        Session::flash('message', 'Email Not Found!!');
        return redirect()->route('adminLogin');
    }

    }

    public function adminLogout(){
        Auth::logout();
        
        Session::flash('message', 'Log out Successfully');

        return redirect()->route('index');
    }

    public function adminRegister(){
        return view('admin.adminRegister');
    }

    public function registerAdmin(Request $request){
        $email = $request->email;
        $query= DB::table('users')->where('email', $email)->first();
        if($query){
            Session::flash('message','Email already registered');
            return redirect()->route('adminRegister');


        }else{
        $time=time();
        $data=array();
        $data['name']= $request->name;
        $data['email']=$request->email;
        $password = $data['password']= Hash::make($request->password);
        $conform_password = $request->conform_password;
        $data['role']=0;
        $data['created_at']= date("Y-m-d H:i:s",$time);

        if (Hash::check($conform_password, $password)) {
            $result= DB::table('users')->insert($data);
                if($result==TRUE){
                    Session::flash('message','Registration Successfull!!!');
                    return redirect()->route('adminLogin');

                }else{
                    Session::flash('message','Data is not inserted');
                    return redirect()->route('adminRegister');
                }


        }else{
            Session::flash('message','Password Doses not Match');
            return redirect()->route('adminRegister');
        }
    }
    }

    public function changeRole(Request $request){
        $id = $request->id;
        $time=time();
        $data = array();
        $data['role']= $request->role;
        $data['updated_at']= date("Y-m-d H:i:s",$time);
        $query = DB::table('users')->where('id',$id)->update($data);
        if($query){
            Session::flash('message','Role Updated Successful');
            return redirect()->route('viewAdmins');
        }



    }

    public function deleteAdmin($id){
        $query = DB::table('admins')->where('id',$id)->delete();
        if($query){
            Session::flash('message','Admin Delete Successful');
            return redirect()->route('viewAdmins');
        }
    }

    public function editAdmin($id){
        $data = array();
       $query= $data['result'] = DB::table('admins')->where('id',$id)->first();
        if($query){
            return view('back.pages.admin.editAdmin', $data);
        }
    }

    public function updateAdmin(Request $request, $id){
        $data = array();
        $time=time();
        $data['name']= $request->name;
        $data['updated_at']= date("Y-m-d H:i:s",$time);
        $image=$request->file('image');
        $password = $request->password;
        $new_password = $request->new_password;

        if($image && empty($new_password)){
            $results = DB::table('admins')->where('id',$id)->first();
            if(!empty($results->image)){
                unlink($results->image);
            }

            $data['image']=$request->image;
            $image_name=Str::random(12);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.".".$ext;
            $upload_path='adminImg/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success){
                $data['image']=$image_url;
                DB::table('admins')->where('id',$id)->update($data);
                Session::flash('message', 'Profile Picture Added Successfully!');
                return Redirect::route('editAdmin',$id);
            }else{
                Session::flash('message', 'Admin Updated Error!');
                return Redirect::route('editAdmin',$id);

            }
        }

        elseif(!empty($new_password) && empty($image) ){
            $query= DB::table('admins')->where('id', $id)->first();
            $password = $request->password;
            if($query){
                if (Hash::check($password, $query->password)) {
                    $data['password']=  Hash::make($new_password);
                    DB::table('admins')->where('id',$id)->update($data);
                    Session::flash('message', 'Password Changed Successfully!');
                    return Redirect::route('editAdmin',$id);

                }else{
//                    Session::flash('message', 'Old Passsword Does not Match');
                    Toastr::success('.','Success',["positionClass" => "toast-top-right"]);
                    return Redirect::route('editAdmin',$id);
                }
            }
        }elseif($image && $new_password){
            $results = DB::table('admins')->where('id',$id)->first();
            if (Hash::check($password, $results->password)) {
                $data['password']=  Hash::make($new_password);
                if(!empty($results->image)){
                    unlink($results->image);
                }
                // $data['image']=$request->image;
                $image_name=Str::random(12);
                $ext=strtolower($image->getClientOriginalExtension());
                $image_full_name=$image_name.".".$ext;
                $upload_path='adminImg/';
                $image_url=$upload_path.$image_full_name;
                $success=$image->move($upload_path,$image_full_name);
                if($success){
                    $data['image']=$image_url;
                    DB::table('admins')->where('id',$id)->update($data);
//                    Session::flash('message', 'Profile Picture & New Password Added Successfully!');
                    Toastr::success('Progile Picture $ New Password Added successfully.','Success',["positionClass" => "toast-top-right"]);
                    return Redirect::route('editAdmin',$id);
                }else{
                    Session::flash('message', 'Admin Updated Error!');
                    return Redirect::route('editAdmin',$id);
                }

            }
//            Session::flash('message', 'Password Does not match !');
            Toastr::success('Password not match ','Success',["positionClass" => "toast-top-right"]);
            return Redirect::route('editAdmin',$id);
        }else{
            DB::table('admins')->where('id',$id)->update($data);
//                    Session::flash('message', 'Name Updated Successfully!');
            Toastr::success('Name Update successfully.','Success',["positionClass" => "toast-top-right"]);
                    return Redirect::route('editAdmin',$id);

        }
    }

    // public function allContacts(){
    //     return view('back.pages.allContacts');
    // }




}

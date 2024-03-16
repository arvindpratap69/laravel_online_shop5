<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function index()
    {
    //    echo $password = Hash::make('vendor123');
    //      die;
        return view('admin.login');
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password'=>'required'

        ]);
        if($validator->passes()){

            if(Auth::guard('admin')->attempt(['email' =>$request->email, 'password'=>$request->password])){
                $admin = Auth::guard('admin')->user();
                if($admin->status == 1){

                    return redirect()->route('admin.dashboard')->with('success', 'Login Successfully');
                }else{
                    return redirect()->route('admin.login')->with('error','you  Can not Authrized to Access Admin Pannel');
                }

            }else{
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error','Either Email/Password Does Not Match');
            }

        }else{
            return redirect()->route('admin.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
    }

    public function change_password(){
        Session::put('page', 'update_admin_password');
        // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
         $admin = Admin::where('email',Auth::guard('admin')
                   ->user()->email)->first()->toArray();
          $data['admin'] = $admin;
        return view('admin.settings.update_admin_password',$data);
    }

    public function update_password(Request $request)
    {
           $validator = Validator::make($request->all(),[
                 'current_password' =>'required',
                 'new_password' =>'required|min:5',
                 'confirm_password' => 'required|same:new_password',
           ]);
           $admin = Admin::where('id',Auth::guard('admin')->user()->id)->first();
           if($validator->passes()){
            if(!Hash::check($request->current_password, $admin->password)){
            session()->flash('error','Your Old Password is incorrect,Please try Again');
                 return response()->json([
                    'status' =>true,
                 ]);
                }
                 Admin::where('id',Auth::guard('admin')->user()->id)->update([
                    'password' => Hash::make($request->new_password)
                 ]);
                 session()->flash('success','Password Changed Successfully');
                 return response()->json([
                    'status' =>true,

                 ]);


           }
           else{
            return response()->json([
                   'status' => false,
                   'errors' => $validator->errors()
            ]);
           }
    }

    public function edit_details(){
        Session::put('page', 'update_admin_details');
        return view('admin.settings.update_admin_details');
    }

    public function update_details(Request $request)
    {

        $validator = Validator::make($request->all(),[
             'admin_name' =>'required|regex:/^[\pL\s\-]+$/u',
             'admin_mobile' =>'required|numeric',
        ]);
        if($validator->passes()){
            // Update Image
            // $imageName = null; // Initialize the variable

            if($request->hasFile('admin_image')){
               $image_temp = $request->file('admin_image');
                if($image_temp->isValid()){
                   // get image extension
                   $extension = $image_temp->getClientOriginalExtension();
                   //  genenrate new image name
                      $imageName = rand(111,99999).'.'.$extension;
                      $imagePath =  'admin/uploads/admins/'.$imageName;
                   //    uploads image
                     Image::make($image_temp)->save($imagePath);
                }
              }

            else if(!empty($request['current_admin_image'])){
                $imageName  =$request['current_admin_image'];
                // dd($imageName);

            }else{
                $imageName ="";
            }

            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'name' => $request->admin_name,
                'mobile' => $request->admin_mobile,
                'image' =>$imageName
             ]);

              session()->flash('success','Admin Details Updated Sucessfully');
              return redirect()->route('admin.edit_details')->with('success','Admin deatails updated Successfully');

        }else{
            return response()->json([
                'status' =>false,
                'errors' =>$validator->errors()
            ]);
        }
    }

}

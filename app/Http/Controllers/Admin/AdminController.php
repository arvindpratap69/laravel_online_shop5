<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        Auth::guard('admin')->user();
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }
    public function logout(){
      Auth::guard('admin')->logout();
      return redirect()->route('admin.login');

    }
    public function admins($type=null){
        $admins = Admin::query();
        if(!empty($type)){
            $admins = $admins->where('type',$type);
            $title = ucfirst($type)."s";
            Session::put('page', 'view_'.strtolower($title));


        }else{
            $title = "All Admins/Subadmins/Vendors";
            Session::put('page', 'view_all');
        }
        $admins = $admins->get()->toArray();
        // dd($admins);

        return view('admin.admins.admins',compact('admins','title'));


    }

    public function vendorDetails($id)
    {
        $vendorDetails = Admin::with('vendorPersonal','vendorBussiness','vendorBank')->where('id',$id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails),true);
        return view('admin.admins.view_vendor_details')->with(compact('vendorDetails'));
        // dd($vendorDetails);

    }
    public function updateAdminStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status =1;
            }
            Admin::where('id',$data['admin_id'])->update(['status'=>$status]);
            return response()->json([
                'status'=> $status,
                'admin_id'=>$data['admin_id']
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\VendorsBankDetail;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\VendorsBussinessDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
     public function index($slug)
     {
        $vendorDetail = Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->first()
        ->toArray();
        $vendorDetails = VendorsBussinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        $vendorBankDetails = VendorsBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        $countries = Country::where('status',1)->get()->toArray();




  return view('admin.settings.update_vendor_details',compact('vendorDetail','vendorDetails','vendorBankDetails','countries','slug'));
     }
    public function vendorUpdateDetails($slug,Request $request)
    {
        if($slug == "personal"){
            Session::put('page','update_personal_details');


        $validator = Validator::make($request->all(),[
            'vendor_name'=>'required|regex:/^[\pL\s\-]+$/u',
            'vendor_city'=>'required|regex:/^[\pL\s\-]+$/u',
            'vendor_mobile' =>'required|numeric',

        ]);
        if($validator->passes()){
            // Update Image
            // $imageName = null; // Initialize the variable

            if($request->hasFile('vendor_image')){
               $image_temp = $request->file('vendor_image');
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

            else if(!empty($request['current_vendor_image'])){
                $imageName  =$request['current_vendor_image'];


            }else{
                $imageName ="";
            }




            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'name' => $request->vendor_name,
                'mobile' => $request->vendor_mobile,
                'image' =>$imageName
             ]);
             Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update([
                'name'=>$request->vendor_name,
                'mobile'=>$request->vendor_mobile,
                'address'=>$request->vendor_address,
                'city'=>$request->vendor_city,
                'state'=>$request->vendor_state,
                'country'=>$request->vendor_country,
                'pincode'=>$request->vendor_pincode
             ]);

              session()->flash('success','Admin Details Updated Sucessfully');
              return redirect()->route('vendor.update-details',$slug)->with('success','Admin deatails updated Successfully');

        }
        else{
            return response()->json([
                'status' =>false,
                'errors' =>$validator->errors()
            ]);
        }
    }
    elseif($slug == "bussiness"){
        Session::put('page','update_bussiness_details');


        $validator = Validator::make($request->all(),[
            'vendor_shop_name'=>'required|regex:/^[\pL\s\-]+$/u',
            'vendor_shop_address'=>'required',
            'vendor_shop_city' =>'required|numeric',
            'vendor_shop_city' =>'required|',
            'vendor_shop_state' =>'required',
            'vendor_shop_country' =>'required',
            'vendor_shop_pincode' =>'required',
            'vendor_shop_mobile' =>'required',
            'vendor_shop_website' =>'required',
            'vendor_shop_address_proof' =>'required',
            'vendor_shop_bussiness_license_number' =>'required',
            'gst_number' =>'required',
            'pan_number' =>'required',
            'address_proof_image' =>'required|image',

        ]);

        // $validated = $validator->validated();
        // dd($validated);

        if($validator->passes()){
            // Update Image
            // $imageName = null; // Initialize the variable

            if($request->hasFile('address_proof_image')){
               $image_temp = $request->file('address_proof_image');
                if($image_temp->isValid()){
                   // get image extension
                   $extension = $image_temp->getClientOriginalExtension();
                   //  genenrate new image name
                      $imageName = rand(111,99999).'.'.$extension;
                      $imagePath =  'admin/uploads/admins/proofs/'.$imageName;
                   //    uploads image
                     Image::make($image_temp)->save($imagePath);
                }
              }

            else if(!empty($request['current_address_proof'])){
                $imageName  =$request['current_address_proof'];


            }else{
                $imageName ="";
            }

            //   Vendor Bussiness Details
             VendorsBussinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update([
                'shop_name'=>$request->vendor_shop_name,
                'shop_address'=>$request->vendor_shop_address,
                'shop_city'=>$request->vendor_shop_city,
                'shop_state'=>$request->vendor_shop_state,
                'shop_country'=>$request->vendor_shop_country,
                'shop_pincode'=>$request->vendor_shop_pincode,
                'shop_mobile'=>$request->vendor_shop_mobile,
                'shop_website'=>$request->vendor_shop_website,
                'address_proof'=>$request->vendor_shop_address_proof,
                'bussiness_license_number'=>$request->vendor_shop_bussiness_license_number,
                'gst_number'=>$request->gst_number,
                'pan_number'=>$request->pan_number,
                'address_proof_image'=>$imageName

             ]);

              session()->flash('success','Vendor Bussiness  Details Updated Sucessfully');
              return redirect()->route('vendor.update-details',$slug)->with('success','Vendor Bussiness  Details updated Successfully');

        }
        return response()->json([
            'status' =>false,
            'errors' =>$validator->errors()
        ]);


    }
    else if($slug == "bank"){
        Session::put('page','update_bank_details');
        $validator = Validator::make($request->all(),[
            'account_holder_name'=>'required|regex:/^[\pL\s\-]+$/u',
            'bank_name'=>'required|regex:/^[\pL\s\-]+$/u',
            'account_number' =>'required|numeric',
            'bank_ifsc_code' =>'required',

        ]);
        if($validator->passes()){
             VendorsBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update([
                'account_holder_name'=>$request->account_holder_name,
                'bank_name'=>$request->bank_name,
                'account_number'=>$request->account_number,
                'bank_ifsc_code'=>$request->bank_ifsc_code,
             ]);

              session()->flash('success','Vendor Bank Details Updated Sucessfully');
              return redirect()->route('vendor.update-details',$slug)->with('success','Vendor Bank Details updated Successfully');

        }
    }
    return response()->json([
        'status' =>false,
        'errors' =>$validator->errors()
    ]);
}
}






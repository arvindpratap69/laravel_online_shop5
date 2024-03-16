<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['section','parentcategory'])->get();
        Session::put('page', 'categories');
        // dd($categories);

        return view('admin.categories.list',compact('categories'));
    }
    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status =1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json([
                'status'=> $status,
                'category_id'=>$data['category_id']
            ]);
        }
    }
    public function create()
    {
         $getSections =Section::get();
         $getCategories =array();
        return view('admin.categories.create',compact('getSections','getCategories'));
    }
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(),[
            'category_name'=>'required|regex:/^[\pL\s\-]+$/u',
            'section_id'=>'required',
            'categories_image'=>'required|image:avif,gif,png,jpeg,jpg,webp',
            'category_discount'=>'required',
            'category_description'=>'required',
            'meta_keywords'=>'required',
          ]);
          if($validator->passes()){
            $category  =new Category();
            $category->category_name = $request->category_name;
            $category->section_id = $request->section_id;
            $category->parent_id = $request->parent_id;
            $category->category_discount = $request->category_discount;
            $category->description = $request->category_description;
            $category->url = $request->category_url;
            $category->meta_title = $request->meta_title;
            $category->meta_description = $request->meta_description;
            $category->meta_keywords = $request->meta_keywords;
            $category->status =1;
            $category->save();
            //    Upload Image here
            if ($request->hasFile('categories_image')) {
                $ext = $request->categories_image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->categories_image->move(public_path().'/admin//uploads/categories',$newFileName); #this will save a file in folder
                $category->category_image = $newFileName;
                $category->save();
            }





           session()->flash('success',"Category has been added successfully");
           return redirect()->route('categories.index');

          }else{
            return redirect()->route('categories.create')->withErrors($validator)->withInput();
          }
    }
    public function edit($id)
    {
        $getSections =Section::get();
        $category = Category::find($id);
        $getCategories =Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$category->section_id])->get();
        // dd($getCategories);
        return view('admin.categories.edit',compact('getSections','category','getCategories'));
    }

    public function update($id,Request $request){
        $category = Category::find($id);
        $validator  =Validator::make($request->all(),[
        'category_name'=>'required|regex:/^[\pL\s\-]+$/u',
        'section_id'=>'required',
        'category_discount'=>'required',
        'category_description'=>'required',
          'meta_keywords'=>'required',
          'meta_title'=>'required',
          'meta_description'=>'required'

]);
if($validator->passes()){
    $category->category_name = $request->category_name;
    $category->section_id = $request->section_id;
    $category->parent_id = $request->parent_id;
    $category->category_discount = $request->category_discount;
    $category->description = $request->category_description;
    $category->url = $request->category_url;
    $category->meta_title = $request->meta_title;
    $category->meta_description = $request->meta_description;
    $category->meta_keywords = $request->meta_keywords;
    $category->status =1;
    $category->save();
    //    Upload Image here
    if ($request->hasFile('categories_image')) {
        $oldImage = $category->category_image;
        $ext = $request->categories_image->getClientOriginalExtension();
        $newFileName = time().'.'.$ext;
        $request->categories_image->move(public_path().'/admin/uploads/categories',$newFileName); #this will save a file in folder
        $category->category_image = $newFileName;
        $category->save();

        if (File::exists(public_path().'/admin/uploads/categories/'.$oldImage)) {
            File::delete(public_path().'/admin/uploads/categories/'.$oldImage);
        } else {
            // Handle the case where the file does not exist
            echo "File does not exist.";
        }


    }
    session()->flash('success','Category Updated Successfully');
    return redirect()->route('categories.index');

  }
   else{
    return redirect()->route('categories.edit',$category->id)->withErrors($validator)->withInput();
      }
    }


    public function appendCategory(Request $request)
    {
        if($request->ajax()){
            $getCategories =Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$request->section_id])->get();
            return view('admin.categories.append_categories_level',compact('getCategories'));
        }


    }



    // public function deleteCategory($id)
    // {
    //         // Delete Section
    //     $category = Category::where('id',$id)->delete();
    //     if(empty($category)){
    //    session()->flash('error','Section Not Found');
    //     return redirect()->route('categories.index')->with('error','Category Not Found');
    //     }else{
    //         return redirect()->route('categories.index')->with('success','Category Deleted SuccessFully');
    //     }
    // }



}

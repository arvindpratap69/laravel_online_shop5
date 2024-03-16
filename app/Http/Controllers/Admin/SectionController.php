<?php

namespace App\Http\Controllers\admin;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    public function sections()
    {
        $sections = Section::get();
        Session::put('page', 'sections');
        // dd($section);
        return view('admin.sections.sections',compact('sections'));

    }
    public function updateSectionStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status =1;
            }
            Section::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json([
                'status'=> $status,
                'section_id'=>$data['section_id']
            ]);
        }
    }
    public function deleteSection($id)
    {
        // Delete Section
        $section = Section::where('id',$id)->delete();
        if(empty($section)){
       session()->flash('error','Section Not Found');
        return redirect()->route('catalogue.sections')->with('error','Section Not Found');
        }else{
            return redirect()->route('catalogue.sections')->with('success','Section Deleted SuccessFully');
        }
    }

    public function EditSection($sectionId,Request $request){
        $section = Section::find($sectionId);
        if(empty($section)){
            session()->flash("error","Section Not Found");
            return redirect()->route('catalogue.sections');

        }
        return view('admin.sections.edit_section',compact('section'));
    }
    public function UpdateSection($id,Request $request){
        $section = Section::find($id);
        if(empty($section)){
            session()->flash('error','Section Not Found');
            return redirect()->route('edit.section');

        }
        $validator = Validator::make($request->all(),[
            'section_name'=>'required|regex:/^[\pL\s\-]+$/u',

        ]);
        if($validator->passes()){
            $section->name = $request->section_name;
            $section->save();
            session()->flash('success',"Section Updated Successfully");
            return redirect()->route('catalogue.sections');

        }else{
            return redirect()->route('edit.section',$section->id)->withErrors($validator)->withInput();
        }



    }
    public function AddSection()
    {
return view('admin.sections.add_section');
    }
    public function SectionAdd(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'section_name'=>'required|regex:/^[\pL\s\-]+$/u',

        ]);
       if( $validator->passes()){
        $section = new Section();
          $section->name = $request->section_name;
          $section->status =1;
          $section->save();
          session()->flash('success', 'Section Added Successfully');
          return redirect()->route('catalogue.sections');

       }else{
return redirect()->route('section.add')->withErrors($validator)->withInput();
       }
    }
}


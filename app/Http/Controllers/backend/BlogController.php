<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Blog;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    
public function blog_list(){
 $all_blog = Blog::latest()->orderBy('blogs.id', 'desc')->get();
	return view('backend.blog.blog_list',compact('all_blog'));
}

public function add_blog_view(){

	return view('backend.blog.add_blog');

}

public function add_blog_action(Request $request){
   $inputs = $request->except('_token');
   $rules=[
               'heading'=>'required|unique:blogs,heading',               
               'subheading'=>'required',
               'short_desc'=>'required',
               'description'=>'required',
        ]; 

    $validation = Validator::make($inputs, $rules);
        if ($validation->fails())
        {
         return redirect()->back()->withErrors($validation)->withInput();

        }else{
            
            $image = $request->file('blog_image');
            $slug =  Str::slug($request->input('name'));
            if (isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('admin_media/images/blog'))
                {
                    Storage::disk('public')->makeDirectory('admin_media/images/blog');
                }
                $postImage = Image::make($image)->resize(823, 435)->stream();
                    Storage::disk('public')->put('admin_media/images/blog/'.$imageName, $postImage);
            } else
            {
                $imageName = 'user.png';

            }
            $Blog = new Blog();
            $Blog->heading=$request->input('heading');   
            $Blog->subheading=$request->input('subheading');   
            $Blog->short_desc=$request->input('short_desc');   
            $Blog->description=$request->input('description');      
            $Blog->image=$imageName;
             if ($Blog->save()) {
             $request->session()->flash('success', 'Blog Successfully Created !!');
             }else{
              $request->session()->flash('error', 'Something Went Wrong !!');
             }          
            return redirect('/add_blog_view');
          
        }//end else

   }//end function

public function view_blog($blogId){
$blog = Blog::latest()->where('id', $blogId)->first();
return view('backend.blog.view_blog',compact('blog'));
}

public function edit_view_blog($blogId){
$blog = Blog::latest()->where('id', $blogId)->first();
return view('backend.blog.edit_view_blog',compact('blog'));
}

public function edit_action(Request $request){
$inputs = $request->except('_token');
$id=$request->input('blog_id');   
$rules=[
               'heading'=>'required|unique:blogs,heading,'.$id,               
               'subheading'=>'required',
               'short_desc'=>'required',
               'description'=>'required',
        ]; 

   $validation = Validator::make($inputs, $rules);
    if ($validation->fails())
    {
        return redirect()->back()->withErrors($validation)->withInput();

    }else{
            $image = $request->file('blog_image');
            $slug =  Str::slug($request->input('name'));
            $blog =  Blog::find($id);

            if (isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('admin_media/images/blog'))
                {
                    Storage::disk('public')->makeDirectory('admin_media/images/blog');
                }
             
                if (Storage::disk('public')->exists('admin_media/images/blog/'.$blog->image))
                {
                    Storage::disk('public')->delete('admin_media/images/blog/'.$blog->image);
                } 

                $postImage = Image::make($image)->resize(823, 435)->stream();
                    Storage::disk('public')->put('admin_media/images/blog/'.$imageName, $postImage);
                } else
                {
                    $imageName = $blog->image;
                }  

            $blog->heading=$request->input('heading');   
            $blog->subheading=$request->input('subheading');   
            $blog->short_desc=$request->input('short_desc');   
            $blog->description=$request->input('description');      
            $blog->image=$imageName;
                if ($blog->save()) {
                 $request->session()->flash('success', 'Blog Successfully Updated !!');
                  return redirect('/blog_list');
                 }else{
                  $request->session()->flash('error', 'Something Went Wrong !!');
                  redirect($_SERVER['HTTP_REFERER']);
                 
             }          
     
        } 

}

public function delete_blog(Request $request,$blogId){
 $blog = Blog::where('id', $blogId)->delete();
 $request->session()->flash('success', 'Blog Successfully Deleted !!');  
  return redirect('/blog_list');
}




}//end controller 

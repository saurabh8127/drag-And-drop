<?php
    
namespace App\Http\Controllers;
    
use App\Models\image;
use App\Models\Photo;
use Illuminate\Http\Request;
    
class DropzoneController extends Controller
{
   
    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function dropzone()
    {
        return view('dropzone');
    }
     
    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
      // dd($request);
        $image = $request->file('file');
        $imageName =$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);

        $imageUpload = new image();
        $imageUpload->name =strtolower(str_replace(' ', '-', $imageName)).'-'.time();
        $imageUpload->path = $imageName;
        $imageUpload->save();

    
        return response()->json(['success'=>$imageName]);
    }
    
}
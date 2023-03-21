<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Traits\Api;



class SliderController extends Controller


{
    //use ApiHandler;
    public function index()
    {
       // All Product
       $sliders = Slider::all();
     
       
       return response()->json([
        'msg'=>'success',
          'status'=>true,
          'sliders' => $sliders,
          
       ],200,);
       
    }

    public function store(SliderRequest $request)
    {
       // $slider =$request->slider();

        try {
            $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
            $imageUrl =$request->image;

     
            // Create Product
            Slider::create([
                'image' => $imageName,
                'image_url'=>$imageUrl,
            ]);
     
            // Save Image in Storage folder
            Storage::disk('public')->put($imageName, file_get_contents($request->image));
     
            // Return Json Response
            return response()->json([
                'message' => "Product successfully created."
            ],200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }
    public function show($id)
    {
       // Product Detail 
       $product = Slider::find($id);
       if(!$product){
         return response()->json([
            'message'=>'Product Not Found.'
         ],404);
       }
     
       // Return Json Response
       return response()->json([
          'product' => $product
       ],200);
    }
 
    public function update(SliderRequest $request, $id)
    {
        try {
            // Find product
            $product = Slider::find($id);
            if(!$product){
              return response()->json([
                'message'=>'Product Not Found.'
              ],404);
            }
     
            $product->name = $request->name;
            $product->description = $request->description;
     
            if($request->image) {
                // Public storage
                $storage = Storage::disk('public');
     
                // Old iamge delete
                if($storage->exists($product->image))
                    $storage->delete($product->image);
     
                // Image name
                $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
                $product->image = $imageName;
     
                // Image save in public folder
                $storage->put($imageName, file_get_contents($request->image));
            }
     
            // Update Product
            $product->save();
     
            // Return Json Response
            return response()->json([
                'message' => "Product successfully updated."
            ],200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e
            ],500);
        }
    }
 
    public function destroy($id)
    {
        // Detail 
        $product = Slider::find($id);
        if(!$product){
          return response()->json([
             'message'=>'Product Not Found.'
          ],404);
        }
     
        // Public storage
        $storage = Storage::disk('public');
     
        // Iamge delete
        if($storage->exists($product->image))
            $storage->delete($product->image);
     
        // Delete Product
        $product->delete();
     
        // Return Json Response
        return response()->json([
            'message' => "Product successfully deleted."
        ],200);
    }

}

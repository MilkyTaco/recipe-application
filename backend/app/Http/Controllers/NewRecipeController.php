<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class NewRecipeController extends Controller
{
    public function index()
    {
        return response()->json(Recipe::with(['categories'])->get());
    }

    public function store(Request $request)
    {
        Recipe::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'content' => $request->content,
        ]);

        return response()->json(['msg' => 'Success'], 200);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $recipe = Recipe::where('id', $id)->first();
        if($recipe){
            $recipe->delete();
        }
        return response()->json(['msg' => 'Recipe deleted successfully!'], 200);
    }

    public function deleteFileFromServer($filename){
        $filePath = public_path().'/uploads/'.$filename;
        if(file_exists($filePath)){
            @unlink($filePath);
        }
        return;
    }

    public function uploadFeaturedImage(Request $request){
        $picName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads'), $picName);
        return $picName;
    }

}

<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageFileUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->store('image', 'public');
            return response()->json(['message' => 'Image uploaded successfully', 'image' => $imageName], 200);
        }

        $reponse = ['message' => 'No image file uploaded.'];
        return response()->json(  $reponse, 400);
    }

}

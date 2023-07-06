<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JsonException;

class FileUploadController extends ApiController
{
    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->store('images', 'public');

                return $this->respond(['message' => 'Image uploaded successfully', 'image' => $imageName]);
            }

            return $this->respondError('No image file uploaded.', Response::HTTP_BAD_REQUEST);
        } catch (JsonException $e) {
            logger($e, $e->getTrace());

            return $this->respondError('Failed to upload image file', Response::HTTP_BAD_REQUEST);
        }
    }
}

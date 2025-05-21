<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;


use Illuminate\Support\Facades\Log;
use Exception;

class PostController extends Controller
{
    public function index()
    {
      
       try {

            $posts = Post::all();
            return response()->json($posts);

        } catch (Exception $e) {

            Log::error('Fetching Posts failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Could not retrieve Posts.',
            ], 500);

        }
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
           
            $data = $request->validate([
                'title' => 'required|string',
                'content' => 'required|string',
            ]); 
           

            $task = Post::create($data);

            return response()->json($task, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);


        } catch (Exception $e) {
            
             Log::error('Task creation failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $post = Post::findOrFail($id);
            return response()->json($post);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'message' => 'Post not found.',
            ], 404);

        } catch (Exception $e) {

            Log::error('Fetching blog post failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'An unexpected error occurred.',
            ], 500);

        }
    }

   
    public function update(Request $request, string $id)
    {
        try {

            $data = $request->validate([
                'title' => 'sometimes|required|string',
                'content' => 'sometimes|required|string',
            ]);

            $post = Post::findOrFail($id);
            $post->update($data);

            return response()->json($post);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);

        }  catch (Exception $e) {

            Log::error('Updating blog post failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Something went wrong while updating the post.',
            ], 500);

        }
    }

   
}



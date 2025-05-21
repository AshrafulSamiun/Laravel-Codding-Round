<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $tasks = Task::all();
            return response()->json($tasks);

        } catch (Exception $e) {
            Log::error('Fetching tasks failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Could not retrieve tasks.',
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
           
            $data = $request->validate(['title' => 'required|string']);
            $task = Task::create($data);

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

    public function update(Request $request, $id)
    {
         try {

            $task = Task::findOrFail($id);

            $data = $request->validate(['is_completed' => 'required|boolean']);
            $task->update($data);

            return response()->json($task);


        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json([
                'message' => 'Task not found.',
            ], 404);

        } catch (Exception $e) {

            Log::error('Task update failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }

    public function pending()
    {

       try {

            $tasks = Task::where('is_completed', false)->get();
            return response()->json($tasks);

        } catch (Exception $e) {

            Log::error('Fetching pending tasks failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Could not retrieve pending tasks.',
            ], 500);

        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        // Retrieve all resources
        $resources = PostModel::all();
        
        return response()->json($resources);
    }

    public function store(Request $request)
    {
        // Create a new resource
        $resource = PostModel::create($request->all());

        return response()->json($resource, 201);
    }

    public function show($id)
    {
        // Retrieve a specific resource
        $resource = PostModel::find($id);

        if (!$resource) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        return response()->json($resource);
    }

    public function update(Request $request, $id)
    {
        // Update a specific resource
        $resource = PostModel::find($id);

        if (!$resource) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        $resource->update($request->all());

        return response()->json($resource);
    }

    public function destroy($id)
    {
        // Delete a specific resource
        $resource = PostModel::find($id);

        if (!$resource) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        $resource->delete();

        return response()->json(['message' => 'Resource deleted']);
    }
}


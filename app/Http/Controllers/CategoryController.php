<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
{
    return response()->json($category);
}

public function update(Request $request, Category $category)
{
    // $request->validate([
    //     'name' => 'required',
    // ]);
    return 'success';
    $category->update($request->all());

    return response()->json($category);
}

public function destroy(Category $category)
{
    $category->delete();

    return response()->json(['message' => 'Category deleted successfully']);
}
}

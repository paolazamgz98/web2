<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.categories.list', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $category = Category::create($request->all());
        return redirect()->route('admin.categories.index');
    }

    public function show($categoryId){
        $category = Category::findOrFail($categoryId);
        return view('admin.categories.show', compact('category'));
    }

    public function updateAvailability(Request $request, $categoryId){
        $category = Category::findOrFail($categoryId);
        $category->update($request->all());
        return redirect()->route('admin.categories.show', $categoryId);
    }

    public function eliminar($categoryId){
        $category = Category::findOrFail($categoryId);
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{


    // function __construct()
    // {
    //      $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:category-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json(['message' => 'Liste des catégories', 'Catégorie' => $categories], 201);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $categories = Category::create($request->validated());

        return response()->json(['message' => 'Catégorie créé avec succès', 'Catégorie' => $categories], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        // dd($request->all()); 
        $category->update($request->validated());

        return response()->json(['message' => 'Catégorie modifiée avec succès', 'Catégorie' => $category], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Catégorie supprimée avec succès',$category], 201);

    }

    public function massDestroy()
    {
        Category::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}

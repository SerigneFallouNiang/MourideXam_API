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


    public function getBooks($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $books = $category->books;

        return response()->json([
            'message' => 'Livres de la catégorie ' . $category->name,
            'category' => $category->name,
            'books' => $books
        ], 200);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        $categories = new Category();
        $categories->fill($request->validated());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $categories->image = $image->store('livres', 'public');
        }

        // $categories = Category::create($request->validated());
        $categories->save();
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

        // return response()->json(['message' => 'Catégorie modifiée avec succès', 'Catégorie' => $category], 201);
        $category->fill($request->validated());
        if ($request->hasFile('image')) {

            if (File::exists(public_path("storage/" . $category->image))) {
                File::delete(public_path($category->image));
            }
            $image = $request->file('image');
            $category->image = $image->store('livres', 'public');
        }
        // dd($livre->image);
        if ($category->quantite > 0) {
            $category->update(['disponible' => true]);
        }
        $category->update();
        return response()->json(['message' => 'Livre modifié avec succès', 'Livre' => $category], 201);
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

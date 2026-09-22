<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index() {
        return CategoryResource::collection(Category::orderBy('title', 'ASC')->get());
    }

    public function store(StoreCategoryRequest $request): ResourceCollection {
        $category = $request->validated();
        Category::create($category);
        
        return CategoryResource::collection(Category::orderBy('title', 'ASC')->get());        
    }

    public function update(StoreCategoryRequest $request, Category $category): Category {
        $category->update($request->validated());
        return $category;

    }

    public function destroy(Category $category): ResourceCollection {
        if($category->tickets()->exists()){
            throw new HttpResponseException(response()->json([
                'message' => 'Deze categorie kan niet worden verwijderd omdat er tickets aan gekoppeld zijn.'
            ], 422));
        };

        $category->delete();

        return CategoryResource::collection(Category::orderBy('title', 'ASC')->get());       
    }
}

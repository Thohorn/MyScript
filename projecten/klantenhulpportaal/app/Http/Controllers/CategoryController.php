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
        $user = Auth::user();

        if($user->role === 'admin'){
            $category = $request->validated();
            Category::create($category);
            
            return CategoryResource::collection(Category::orderBy('title', 'ASC')->get());
        }
        else {
            throw new HttpResponseException(response()->json([
                'message' => 'Je mag geen categorie aanmaken.'
            ], 422));
        }
        
    }

    public function update(StoreCategoryRequest $request, Category $category): Category {
        $user = Auth::user();

        if($user->role === 'admin'){
            $category->update($request->validated());
            return $category;
        }
        else {
            throw new HttpResponseException(response()->json([
                'message' => 'Je mag de categorie niet aanpassen.'
            ], 422));
        }
    }

}

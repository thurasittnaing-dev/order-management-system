<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecipeStoreRequest;
use App\Http\Requests\RecipeUpdateRequest;
use App\Http\Requests\PromotionStoreRequest;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use App\Services\RecipeService;


class RecipeController extends Controller
{
    private $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function index()
    {
        // $recipes = Recipe::get();
        $data = $this->recipeService->index();
        return view('backend/recipe.index', $data);
    }

    public function create()
    {
        $categories = Category::get();
        $ingredients = Ingredient::get();
        return view('backend/recipe.create',compact('categories','ingredients'));
    }

    public function store(RecipeStoreRequest $request)
    {
        // dd($request);
        $data = $this->recipeService->store($request);
        return redirect()->route('recipe.index')->with($data['status'], $data['message']);
    }

    public function destroy(Recipe $recipe)
    {
        $data = $this->recipeService->destroy($recipe);
        return redirect()->route('recipe.index')->with($data['status'], $data['message']);
    }

    public function edit(Recipe $recipe)
    {
        $categories = Category::get();
        $ingredients = Ingredient::get();
        return view('backend/recipe.edit',compact('recipe','categories','ingredients'));
    }

    public function update(RecipeUpdateRequest $request,Recipe $recipe)
    {
        $data = $this->recipeService->update($request,$recipe);
        return redirect()->route('recipe.index')->with($data['status'], $data['message']);
    }

    public function addPromotion(Recipe $recipe)
    {
        return view('backend.recipe.addpromotion',compact('recipe'));
    }

    public function storePromotion(PromotionStoreRequest $request,$id)
    {
        $data = $this->recipeService->storePromotion($request,$id);
        return redirect()->route('recipe.index')->with($data['status'], $data['message']);
    }
}

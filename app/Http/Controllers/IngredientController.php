<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientStoreRequest;

use App\Models\Ingredient;
use App\Services\IngredientService;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    private $ingredientService;

    public function __construct(IngredientService $ingredientService)
    {
        $this->ingredientService = $ingredientService;
    }
    public function index()
    {
        $data = $this->ingredientService->index();
       return view('backend/ingredient.index',$data);
    }
    public function create()
    {
        return view('backend/ingredient.create');
    }

    public function store( IngredientStoreRequest $request)
    {
        $data = $this->ingredientService->store($request);
        return redirect()->route('ingredient.index')->with($data['status'],$data['message']);
    }
    public function destroy(Ingredient $ingredient)
    {
        $data =$this->ingredientService->destroy($ingredient);
        return redirect()->route('ingredient.index')->with($data['status'],$data['message']);
    }

    public function edit(Ingredient $ingredient)
    {
        return view('backend/ingredient.edit', compact('ingredient'));
    }

    public function update(Request $request,Ingredient $ingredient)
    {
       $data =$this->ingredientService->update($request,$ingredient);
        return redirect()->route('ingredient.index')->with($data['status'],$data['message']);
    }


}

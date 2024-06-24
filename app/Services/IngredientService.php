<?php

namespace App\Services;

use App\Http\Requests\IngredientStoreRequest;
use App\Models\Ingredient;
use PhpParser\Node\Stmt\TryCatch;

class IngredientService
{
  public function index()
  {
    $query = Ingredient::query();

    if (request('name') != '') {
        $query = $query->where('name', request('name') );
      }
      if (request('type') != '') {
        $query = $query->where('type', request('type') );
      }


    return [
      'i' => getTableIndexer(5),
      'count' => $query->count(),
      'name' => $query->orderBy('created_at', 'desc')->get(),
      'type' => $query->orderBy('created_at', 'desc')->get(),
      'ingredients' => $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString(),
    ];
  }

  public function store($request)
  {
    try {
      Ingredient::create([
        'name' => $request->name,
        'type' =>$request->type
      ]);

      return [
        'status' => 'success',
        'message' => 'Ingredient Created.',
      ];
    } catch (\Exception $e) {
      return [
        'status' => 'error',
        'message' => 'Something went wrong',
      ];
    }
  }
  public function destroy(Ingredient $ingredient)
  {
    try {

      $ingredient->delete();
      return [
        'status' => 'success',
        'message' => 'Ingredient Deleted.',
      ];
    } catch (\Exception $e) {
      return [
        'status' => 'error',
        'message' => 'Something went wrong',

      ];
    }
  }
  public function update($request, $ingredient)
  {
    try {
      $data = [
        'name' => $request->name,
      ];

      $ingredient->update($data);
      return [
        'status' => 'success',
        'message' => 'Sucessfully Updated.',

      ];
    } catch (\Exception $e) {
      return [
        'status' => 'error',
        'message' => 'Something went wrong!',

      ];
    }
  }
}

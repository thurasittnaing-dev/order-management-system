<?php

namespace App\Services;

use App\Models\Recipe;
use App\Models\Category;
use PhpParser\Node\Stmt\TryCatch;

class RecipeService
{
    public function index() {
        $query = Recipe::query()
                    ->when(request('name'),fn($query) =>  $query->where('name', 'LIKE', '%' . request('name') . '%'))
                    ->when(request('category'),fn($query)=>$query->whereHas('category', function ($q) {
                        $q->where('id', request('category'));
                      }))
                    ->when(request('status'),fn($query)=>$query->where('status', request('status')));

        return [
            'i' => getTableIndexer(5),
            'count' => $query->count(),
            'categories' => Category::get(['id', 'name']),
            'recipes' => $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString(),
        ];
    }

    public function store($request)
    {
        try {
            $image = null;
            if ($request->hasFile('file')) {

                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $image = $filename;
                $file->storeAs('public/recipes', $filename);
            }

            $data = $request->validated();
            $data['image'] = $image;
            // $data['category_id'] = $data['category'];
            // unset($data['category']);
            $recipe = Recipe::create($data);

            $recipe->ingredients()->attach($data['ingredients']);

            return [
                'status' => 'success',
                'message' => 'Sucessfully Created.',
            ];
        } catch (\Exception $e) {
            dd($e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Something went wrong',
              ];
        }
    }

    public function destroy(Recipe $recipe)
    {
        try {
            //code...
            $filename = $recipe->image ?? 'test.png';
            $file_location = storage_path('app/public/recipes/') . $filename;
            $checkFileExist = file_exists($file_location);
            if ($checkFileExist) {
                unlink($file_location);
            }
            $recipe->delete();
            return [
                'status' => 'success',
                'message' => 'Sucessfully Deleted.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong',
              ];
        }
    }

    public function update($request, $recipe)
    {
        try {
            //code...
            $data = $request->validated();

            if ($request->hasFile('file')) {
                $file_location = storage_path('app/public/recipes/') . $recipe->image;
                $checkFileExist = file_exists($file_location);
                if ($checkFileExist) {
                    unlink($file_location);
                }
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $data['image'] = $filename;
                $file->storeAs('public/recipes', $filename);
            }
            $recipe->update($data);
            if (isset($data['ingredients'])) {
                $recipe->ingredients()->sync($data['ingredients']);
            }

            return [
                'status' => 'success',
                'message' => 'Sucessfully Updated.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong',
              ];
        }
    }


    public function storePromotion($request,$id)
    {
        try {
            $recipe = Recipe :: find($id);
            $data = $request->validated();
            $recipe->update([
                'discount' => $data['discount'],
            ]);

            return [
                'status' => 'success',
                'message' => 'Sucessfully Updated.',
            ];

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong',
            ];
        }
    }
}

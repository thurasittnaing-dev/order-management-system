<?php

namespace App\Services;

use App\Models\Category;


class CategoryService {
    public function index()  {
        $query = Category::query()
                    ->when(request('name'),fn($query) =>  $query->where('name', 'LIKE', '%' . request('name') . '%'))
                    ->when(request('type'),fn($query)=>$query->where('type', request('type')));

        return [
            'i' => getTableIndexer(5),
            'count' => $query->count(),
            'categories' => $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString(),
        ];
    }

    public function store($request) {
        try {
            //code...
            $image = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $image = $filename;
                $file->storeAs('public/categories', $filename);
            }

            $data = $request->validated();
            $data['image'] = $image;

            Category::create($data);

            return [
                'status' => 'success',
                'message' => 'Sucessfully Created.',
            ];
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Something went wrong!',
            ];
        }
    }

    public function update($request, $category) {
        try {
            //code...
            $data = [
                'name' => $request->name,
                'type' => $request->type,
                'description' => $request->description,
            ];

            if ($request->hasFile('file')) {
                $file_location = storage_path('app/public/categories/') . $category->image;
                $checkFileExist = file_exists($file_location);
                if ($checkFileExist) {
                    unlink($file_location);
                }
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $data['image'] = $filename;
                $file->storeAs('public/categories', $filename);
            }
            $category->update($data);
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

    public function destroy(Category $category) {
        try {
            //code...
            $filename = $category->image ?? 'test.png';
            $file_location = storage_path('app/public/categories/') . $filename;
            $checkFileExist = file_exists($file_location);
            if ($checkFileExist) {
                unlink($file_location);
            }
            $category->delete();
            return [
                'status' => 'success',
                'message' => 'Sucessfully Deleted.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong!',
            ];
        }
    }
}

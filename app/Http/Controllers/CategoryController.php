<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $data = $this->categoryService->index();
        return view('backend/category.index',$data);
    }

    public function create()
    {
        return view('backend/category.create');
    }
    public function store(CategoryStoreRequest $request)
    {
        $data = $this->categoryService->store($request);
        return redirect()->route('category.index')->with($data['status'], $data['message']);
    }

    public function destroy(Category $category)
    {
        $data = $this->categoryService->destroy($category);
        return redirect()->route('category.index')->with($data['status'], $data['message']);
    }

    public function edit(Category $category)
    {
        return view('backend/category.edit', compact('category'));
    }
    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $data = $this->categoryService->update($request, $category);
        return redirect()->route('category.index')->with($data['status'], $data['message']);
    }
}

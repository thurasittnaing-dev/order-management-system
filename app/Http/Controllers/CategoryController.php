<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::query();
        if ($request->keyword) {
            // dd($request->keyword);
            $categories = $categories->where('name', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhere('type', 'LIKE', '%' . $request->keyword . '%');
        }
        $categories = $categories->orderBy('created_at', 'desc')->paginate(5);
        $i = (request('page',1)-1)*5;

        $count = Category::count();
        return view ('backend/category.index',[
            'categories' => $categories,
            'count' => $count
        ],
        compact('categories','i'));
    }

    public function create(){
        $categories = Category::get();
        return view('backend/category.create',compact('categories'));
    }
    public function store(CategoryStoreRequest $request){

        dd('here');
        $image = null;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $image = $filename;
            $file->storeAs('public/categories',$filename);
        }

        Category::create([
            'name'=>$request->name,
            'image'=>$image,
            'type'=>$request->type,
            'description'=>$request->description,
        ]);
        return redirect()->route('category.index')->with('success', 'Sucessfully Created.');
    }

    public function destroy(Category $category){
        $filename = $category->image ?? 'test.png';
        $file_location = storage_path('app/public/categories/').$filename;
        $checkFileExist = file_exists($file_location);
        if ($checkFileExist){
            unlink($file_location);
        }
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Sucessfully Delete.');
    }

    public function edit(Category $category){
        return view('backend/category.edit', compact('category'));
    }
    public function update(Category $category, CategoryStoreRequest $request){
        $data = [
            'name'=>$request->name,
            'type'=>$request->type,
            'description'=>$request->description,
        ];

        if ($request->hasFile('file')){
            $file_location = storage_path('app/public/categories/').$category->image;
            $checkFileExist = file_exists($file_location);
            if ($checkFileExist){
                unlink($file_location);
            }
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $data['image'] = $filename;
            $file->storeAs('public/categories', $filename);
        }
        $category->update($data);
        return redirect()->route('category.index')->with('success', 'Sucessfully Updated.');
    }
}

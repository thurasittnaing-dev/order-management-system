@extends('layouts.modernize')

@section('title', 'Recipes')

@section('page', 'Recipes')

@section('content')
<div class="container-fluid">
    @php
        $name = $_GET['name'] ?? '';
        $category = $_GET['category'] ?? '';
        $status = $_GET['status'] ?? '';
    @endphp
    <div class="card">
        <div class="card-header">Filter</div>
        <form action="" method="GET" autocomplete="off">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Name"
                            value="{{ $name }}">
                    </div>
                    <div class="mb-3 col-md-3">
                        <select id="category" class="form-control lib-s2" name="category">
                            <option value=" ">Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (request('category') == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <select id="status" class="form-control lib-s2" name="status">
                            <option value="" selected>Status</option>
                            <option value="active" @if ($status == 'active') selected @endif>Active</option>
                            <option value="inactive" @if ($status == 'inactive') selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <div>
                    <a href="{{ route('recipe.index') }}" class="btn btn-danger">Clear</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-search me-1"></i>Search
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="card-title">Recipe</h3>
                    <p class="text-primary">Total Recipes: {{ $count }}</p>
                </div>

                <div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('recipe.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i>Add New Recipe
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th style="width: 20rem">Recipe Name</th>
                            <th>Description</th>
                            <th>Category Name</th>
                            {{-- <th>Ingredient</th> --}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recipes as $key => $recipe)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/recipes/' . $recipe->image) }}" alt=""
                                            class="image-img img-thumbnail img me-4">
                                            <div class="fw-bold">
                                                <div class="">{{ $recipe->name }}</div>
                                                    @if ($recipe->discount > 0)
                                                        <div class="recipe-discount">
                                                             {{ $recipe->calculateDiscountedAmount($recipe->discount) }}
                                                        </div>
                                                        <div class="recipe-amount"><del>{{ $recipe->amount }}</del></div>
                                                    @else
                                                        <div class="recipe-discount">{{ $recipe->amount }}</div>
                                                    @endif
                                            </div>
                                    </div>
                                </td>
                                <td>{{ $recipe->description }}</td>
                                <td>{{ $recipe->category->name }}</td>
                                {{-- <td>
                                    @foreach($recipe->ingredients as $ingredient)
                                                {{ $ingredient->name }}
                                    @endforeach
                                </td> --}}
                                {{-- <td>{{ $recipe->amount }}</td> --}}
                                <td>
                                    @if ($recipe->status == 'active')
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td align="centers">
                                    <div class="d-flex justify-content-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $recipe->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                              Actions
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton{{ $recipe->id }}">
                                                <li class="mt-2"><a href="{{ route('recipe.addpromotion', $recipe) }}"
                                                    class="dropdown-item text-warning">Add Promotion</a>
                                                </li>
                                                <li class="mt-2"><a href="{{ route('recipe.edit', $recipe) }}"
                                                    class="dropdown-item text-warning">Edit</a>
                                                </li>
                                              <li class="mt-2">
                                                <form action="{{ route('recipe.destroy', $recipe) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onClick="return confirm('Are you sure?')"
                                                        class="dropdown-item text-warning">Delete</button>
                                                </form>
                                              </li>
                                            </ul>
                                          </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td align="center" colspan="6">There is no recipe yet!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer justify-content-center d-flex align-items-center py-3 px-1">
            {{ $recipes->links() }}
        </div>
    </div>
</div>
@endsection

@section('css')

@endsection

@section('js')

@endsection

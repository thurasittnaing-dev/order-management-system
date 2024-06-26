
@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Ingredient')

@section('content')
    <div class="container-fluid">
        @php
            $name = $_GET['name'] ?? '';
            $type = $_GET['type'] ?? '';
        @endphp
        <div class="card">
            <div class="card-header">Filter</div>
            <form action="" method="GET" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $name }}">
                        </div>
                        <div class="col-md-3">
                            <select id="type" class="form-control lib-s2" name="type">
                                <option value="" selected>Type</option>
                                <option value="drink" @if ($type == 'drink') selected @endif>Drink</option>
                                <option value="food" @if ($type == 'food') selected @endif>Food</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <div>
                        <a href="{{ route('ingredient.index') }}" class="btn btn-danger">Clear</a>
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
                        <h3 class="card-title">Ingredients</h3>
                        <p class="text-primary">Total Ingredients:{{ $count }}</p>
                    </div>
                    <div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('ingredient.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i>
                                Add
                                New Ingredient</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0"></div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created at</th>
                                <th scope="col">
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ingredients as $key=> $ingredient)
                            <tr>
                                <td>{{ ++$i }}.</td>
                                <td>{{ $ingredient->name }}</td>
                                <td>{{ $ingredient->type }}</td>
                                <td>{{ $ingredient->description }}</td>
                                <td>{{ $ingredient->created_at->format('d/m/Y') }}</td>
                                <td align="center">
                                    <div class="d-flex justify-content-center">

                                        <a href="{{ route('ingredient.edit', ['ingredient'=> $ingredient]) }}"
                                            class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('ingredient.destroy', ['ingredient'=> $ingredient]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')

                                            <button type="submit"
                                                onClick="return confirm('Are you sure?')"class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td align="center" colspan="6">There is no ingredient yet!</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>

            </div>
        </div>
        <div class="card-footer justify-content-center d-flex align-items-center py-3 px-1">
            {{ $ingredients->links() }}
        </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('js')

@endsection

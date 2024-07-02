@extends('layouts.orderlayout')

@section('title', 'Recipes')

@section('page', 'Recipes')


@section('content')
    <div class="container-fluid">
        <div class="page-card">
            <div class="text-center room-title">Menu Card</div>
            <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
                @foreach ($categories as $category)
                    <div class="col-md-2">
                        <li class="nav-item d-grid" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $category->id}}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $category->id}}" type="button" role="tab"
                                aria-controls="{{ $category->id}}" @if ($loop->first) aria-selected="true" @else aria-selected="false" @endif>
                                {{ $category->name }}</button>
                        </li>
                    </div>
                @endforeach
            </ul>

            <div class="tab-content" id="myTabContent">
                @foreach ($categories as $category)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $category->id}}" role="tabpanel"
                        aria-labelledby="{{ $category->id}}-tab">
                        <div class="mt-3">
                            <div class="row g-2">
                                @foreach ($category->recipes as $recipe)
                                    <a href="{{ route('makeOrder', ['table' => $orderTable_id, 'recipe' => $recipe->id]) }}"
                                        class="col-md-2 recipe-data" data-id="{{ $recipe->id }}"
                                        data-name="{{ $recipe->name }}" data-amount="{{ $recipe->amount }}"
                                        data-discount="{{ $recipe->discount }}" data-image="{{ asset('storage/recipes/' . $recipe->image) }}"
                                        data-url="{{ route('makeOrder', ['table' => $orderTable_id, 'recipe' => $recipe->id]) }}" >
                                        <div class="table-card">
                                            @if($recipe->discount)
                                                <div class="box">
                                                    <div class="ribbon-danger"><span>Discount</span></div>
                                                </div>
                                            @endif

                                            <img src="{{ asset('storage/recipes/' . $recipe->image) }}" class="table-img" alt="">
                                            <span class="table-badge">{{ $recipe->name }} <br> Price ({{ $recipe->amount }}MMK) </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('order.store_recipe_data')
@endsection

@section('css')
@endsection

@section('js')

@endsection

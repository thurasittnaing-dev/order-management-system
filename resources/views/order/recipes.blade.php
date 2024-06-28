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
                            <button class="nav-link" id="{{ $category->id}}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $category->id}}" type="button" role="tab"
                                aria-controls="{{ $category->id}}" aria-selected="false">
                                {{ $category->name }}</button>
                        </li>
                    </div>
                @endforeach
            </ul>

            <div class="tab-content" id="myTabContent">
                @foreach ($categories as $category)
                    <div class="tab-pane fade" id="{{ $category->id}}" role="tabpanel"
                        aria-labelledby="{{ $category->id}}-tab">
                        <div class="mt-3">
                            <div class="row g-2">
                                @foreach ($category->recipes as $recipe)
                                    <a href="" class="col-md-2">
                                        <div class="table-card">
                                            <img src="{{ asset('storage/recipes/' . $recipe->image) }}" class="table-img" alt="">
                                            <span class="table-badge">{{ $recipe->name }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="tab-pane fade" id="koreanfood" role="tabpanel"
                    aria-labelledby="koreanfood-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @for ($i=0 ; $i<10 ; $i++)
                                <a href="" class="col-md-2">
                                    <div class="table-card">
                                        <img src="{{ asset('images/teokbokki.png') }}" class="table-img" alt="">
                                        <span class="table-badge">Teokbokki</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="japanesefood" role="tabpanel"
                    aria-labelledby="japanesefood-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @for ($i=0 ; $i<10 ; $i++)
                                <a href="" class="col-md-2">
                                    <div class="table-card">
                                        <img src="{{ asset('images/sushi.png') }}" class="table-img" alt="">
                                        <span class="table-badge">Sushi</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection

@section('js')

@endsection

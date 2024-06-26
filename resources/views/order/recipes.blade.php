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
                            <button class="nav-link" id="{{ $category->name }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $category->name }}food" type="button" role="tab"
                                aria-controls="{{ $category->name }}food" aria-selected="false">
                                {{ $category->name }}</button>
                        </li>
                    </div>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="chinesefood" role="tabpanel"
                    aria-labelledby="chinesefood-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @for ($i=0 ; $i<10 ; $i++)
                                <a href="" class="col-md-2">
                                    <div class="table-card">
                                        <img src="{{ asset('images/mala.png') }}" class="table-img" alt="">
                                        <span class="table-badge">Mala Xiang Gou</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="koreanfood" role="tabpanel"
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection

@section('js')

@endsection

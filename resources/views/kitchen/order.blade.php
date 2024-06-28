@extends('layouts.kitchenlayout')

@section('title', 'Incoming Orders')

@section('page', 'Incoming Orders')

@section('content')
<div class="container-fluid">
    <div class="page-card">
        <div class="text-center room-title"> Kitchen </div>
        <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
            <div class="col-md-3">
                <li class="nav-item d-grid" role="presentation">
                    <button class="nav-link " id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                        type="button" role="tab" aria-controls="all" aria-selected="true">Pending</button>
                </li>
            </div>
            <div class="col-md-3">
                <li class="nav-item d-grid" role="presentation">
                    <button class="nav-link " id="a-tab" data-bs-toggle="tab" data-bs-target="#a"
                        type="button" role="tab" aria-controls="a" aria-selected="true">Confirm</button>
                </li>
            </div>
            <div class="col-md-3">
                <li class="nav-item d-grid" role="presentation">
                    <button class="nav-link " id="b-tab" data-bs-toggle="tab" data-bs-target="#b"
                        type="button" role="tab" aria-controls="b" aria-selected="true">Cancle</button>
                </li>
            </div>
            <div class="col-md-3">
                <li class="nav-item d-grid" role="presentation">
                    <button class="nav-link " id="c-tab" data-bs-toggle="tab" data-bs-target="#c"
                        type="button" role="tab" aria-controls="c" aria-selected="true">Ready</button>
                </li>
            </div>

                <div class="col-md-2">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link" id="" data-bs-toggle="tab"
                            data-bs-target="#" type="button" role="tab"
                            aria-controls="" aria-selected="false">
                    </button>
                    </li>
                </div>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show " id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="mt-3">
                    <div class="row g-2">
                        @for ($i = 0; $i < 20; $i++)
                            <a href="" class="col-md-2">
                                <div class="table-card">
                                    <img src="{{ asset('images/soba.png') }}" class="table-img" alt="">
                                    <span class="table-badge"> Noodle</span>
                                </div>
                            </a>
                            @endfor

                    </div>
                </div>
            </div>

        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show " id="a" role="tabpanel" aria-labelledby="a-tab">
                <div class="mt-3">
                    <div class="row g-2">
                        @for ($i = 0; $i < 20; $i++)
                            <a href="" class="col-md-2">
                                <div class="table-card">
                                    <img src="{{ asset('images/tamako.png') }}" class="table-img" alt="">
                                    <span class="table-badge">Egg fried</span>
                                </div>
                            </a>
                            @endfor

                    </div>
                </div>
            </div>

        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show " id="b" role="tabpanel" aria-labelledby="b-tab">
                <div class="mt-3">
                    <div class="row g-2">
                        @for ($i = 0; $i < 20; $i++)
                            <a href="" class="col-md-2">
                                <div class="table-card">
                                    <img src="{{ asset('images/takoyaki.png') }}" class="table-img" alt="">
                                    <span class="table-badge">Octopus Ball Fried</span>
                                </div>
                            </a>
                            @endfor

                    </div>
                </div>
            </div>
            <div class="tab-pane fade show " id="c" role="tabpanel" aria-labelledby="c-tab">
                <div class="mt-3">
                    <div class="row g-2">
                        @for ($i = 0; $i < 10; $i++)
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

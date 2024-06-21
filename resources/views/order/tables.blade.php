@extends('layouts.orderlayout')

@section('title', 'Order Menu')

@section('page', 'Order Menu')


@section('content')
    <div class="container-fluid">
        <div class="page-card">
            <div class="text-center room-title">Room One Tables <span>12</span></div>
            <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                            type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                    </li>
                </div>

                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link" id="normal-tab" data-bs-toggle="tab" data-bs-target="#normal"
                            type="button" role="tab" aria-controls="normal" aria-selected="false">2 Persons
                            Table</button>
                    </li>
                </div>

                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link" id="family-tab" data-bs-toggle="tab" data-bs-target="#family"
                            type="button" role="tab" aria-controls="family" aria-selected="false">5 Persons
                            Table</button>
                    </li>
                </div>

                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link" id="vip-tab" data-bs-toggle="tab" data-bs-target="#vip" type="button"
                            role="tab" aria-controls="vip" aria-selected="false">15 Persons Table</button>
                    </li>
                </div>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @for ($i = 0; $i < 6; $i++)
                                <a href="" class="col-md-2">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table.png') }}" class="table-img" alt="">
                                        <span class="table-badge">5 Persons</span>
                                    </div>
                                </a>
                            @endfor

                            @for ($i = 0; $i < 4; $i++)
                                <a href="" class="col-md-2 not-allowed">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table-busy.png') }}" class="table-img" alt="">
                                        <span class="table-badge">5 Persons</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="normal" role="tabpanel" aria-labelledby="normal-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @for ($i = 0; $i < 6; $i++)
                                <a href="" class="col-md-2">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table.png') }}" class="table-img" alt="">
                                        <span class="table-badge">5 Persons</span>
                                    </div>
                                </a>
                            @endfor

                            @for ($i = 0; $i < 4; $i++)
                                <a href="" class="col-md-2 not-allowed">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table-busy.png') }}" class="table-img" alt="">
                                        <span class="table-badge">5 Persons</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @for ($i = 0; $i < 6; $i++)
                                <a href="" class="col-md-2">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table.png') }}" class="table-img" alt="">
                                        <span class="table-badge">5 Persons</span>
                                    </div>
                                </a>
                            @endfor

                            @for ($i = 0; $i < 4; $i++)
                                <a href="" class="col-md-2 not-allowed">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table-busy.png') }}" class="table-img" alt="">
                                        <span class="table-badge">5 Persons</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="vip" role="tabpanel" aria-labelledby="vip-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @for ($i = 0; $i < 6; $i++)
                                <a href="" class="col-md-2">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table.png') }}" class="table-img" alt="">
                                        <span class="table-badge">5 Persons</span>
                                    </div>
                                </a>
                            @endfor

                            @for ($i = 0; $i < 4; $i++)
                                <a href="" class="col-md-2 not-allowed">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table-busy.png') }}" class="table-img" alt="">
                                        <span class="table-badge">5 Persons</span>
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

@extends('layouts.orderlayout')

@section('title', 'Order Menu')

@section('page', 'Order Menu')

@section('content')
    <div class="container-fluid">
        <div class="page-card">
            <div class="text-center room-title">Total Rooms <span>12</span></div>
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
                            type="button" role="tab" aria-controls="normal" aria-selected="false">Normal Room</button>
                    </li>
                </div>

                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link" id="family-tab" data-bs-toggle="tab" data-bs-target="#family"
                            type="button" role="tab" aria-controls="family" aria-selected="false">Family Room</button>
                    </li>
                </div>

                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link" id="vip-tab" data-bs-toggle="tab" data-bs-target="#vip" type="button"
                            role="tab" aria-controls="vip" aria-selected="false">VIP Room</button>
                    </li>
                </div>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="rooms-container py-3">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="room-card">
                                <div class="box">
                                    <div class="ribbon-success"><span>Available</span></div>
                                </div>
                                <div class="rom-img">
                                    <img src="{{ asset('images/default_rooms/family_room.jpg') }}" alt="">
                                </div>
                                <div class="room-title-badge">
                                    Testing Room- {{ $i + 1 }}
                                </div>
                            </div>
                        @endfor

                        @for ($i = 0; $i < 2; $i++)
                            <div class="room-card">
                                <div class="box">
                                    <div class="ribbon-danger"><span>Busy</span></div>
                                </div>
                                <div class="rom-img">
                                    <img src="{{ asset('images/default_rooms/family_room.jpg') }}" alt="">
                                </div>
                                <div class="room-title-badge">
                                    Testing Room- {{ $i + 1 }}
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="tab-pane fade" id="normal" role="tabpanel" aria-labelledby="normal-tab">
                    <div class="rooms-container py-3">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="room-card">
                                <div class="box">
                                    <div class="ribbon-success"><span>Available</span></div>
                                </div>
                                <div class="rom-img">
                                    <img src="{{ asset('images/default_rooms/normal_room.jpg') }}" alt="">
                                </div>
                                <div class="room-title-badge">
                                    Testing Room- {{ $i + 1 }}
                                </div>
                            </div>
                        @endfor

                        @for ($i = 0; $i < 2; $i++)
                            <div class="room-card">
                                <div class="box">
                                    <div class="ribbon-danger"><span>Busy</span></div>
                                </div>
                                <div class="rom-img">
                                    <img src="{{ asset('images/default_rooms/family_room.jpg') }}" alt="">
                                </div>
                                <div class="room-title-badge">
                                    Testing Room- {{ $i + 1 }}
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">
                    <div class="rooms-container py-3">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="room-card">
                                <div class="box">
                                    <div class="ribbon-success"><span>Available</span></div>
                                </div>
                                <div class="rom-img">
                                    <img src="{{ asset('images/default_rooms/family_room.jpg') }}" alt="">
                                </div>
                                <div class="room-title-badge">
                                    Testing Room- {{ $i + 1 }}
                                </div>
                            </div>
                        @endfor

                        @for ($i = 0; $i < 2; $i++)
                            <div class="room-card">
                                <div class="box">
                                    <div class="ribbon-danger"><span>Busy</span></div>
                                </div>
                                <div class="rom-img">
                                    <img src="{{ asset('images/default_rooms/family_room.jpg') }}" alt="">
                                </div>
                                <div class="room-title-badge">
                                    Testing Room- {{ $i + 1 }}
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="tab-pane fade" id="vip" role="tabpanel" aria-labelledby="vip-tab">
                    <div class="rooms-container py-3">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="room-card">
                                <div class="box">
                                    <div class="ribbon-success"><span>Available</span></div>
                                </div>
                                <div class="rom-img">
                                    <img src="{{ asset('images/default_rooms/vip_room.jpg') }}" alt="">
                                </div>
                                <div class="room-title-badge">
                                    Testing Room- {{ $i + 1 }}
                                </div>
                            </div>
                        @endfor

                        @for ($i = 0; $i < 2; $i++)
                            <div class="room-card">
                                <div class="box">
                                    <div class="ribbon-danger"><span>Busy</span></div>
                                </div>
                                <div class="rom-img">
                                    <img src="{{ asset('images/default_rooms/vip_room.jpg') }}" alt="">
                                </div>
                                <div class="room-title-badge">
                                    Testing Room- {{ $i + 1 }}
                                </div>
                            </div>
                        @endfor
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

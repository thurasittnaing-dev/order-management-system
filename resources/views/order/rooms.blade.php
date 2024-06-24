@extends('layouts.orderlayout')

@section('title', 'Order Menu')

@section('page', 'Order Menu')

@section('content')
    <div class="container-fluid">
        <div class="page-card">
            <div class="text-center room-title">Order Express :  Rooms <span>({{ $totalRooms }})</span></div>
            <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
                <div class="col-md-2">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                            type="button" role="tab" aria-controls="all" aria-selected="true">All ({{ $totalRooms }})</button>
                    </li>
                </div>
                @foreach ($roomTypes as $type)
                <div class="col-md-2">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link" id="{{ $type->type }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $type->type }}"
                            type="button" role="tab" aria-controls="{{ $type->type }}" aria-selected="false">{{ ucfirst($type->type) }} Room ({{ $roomCountsByType[$type->type] ?? 0 }})</button>
                    </li>
                </div>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="rooms-container py-3">
                        @foreach ($rooms as $room)
                            <a href="{{ route('tables', 1) }}">
                                <div class="room-card">
                                    <div class="box">
                                        <div class="ribbon-success"><span>Available</span></div>
                                    </div>
                                    <div class="rom-img">
                                        <img src="{{ asset('storage/rooms/' . $room->image) }}" alt="">
                                    </div>
                                    <div class="room-title-badge">
                                        {{ $room->name }}
                                    </div>
                                </div>
                            </a>
                        @endforeach

                        {{-- @for ($i = 0; $i < 2; $i++)
                            <a href="{{ route('tables', 1) }}">
                                <div class="room-card">
                                    <div class="box">
                                        <div class="ribbon-danger"><span>Full</span></div>
                                    </div>
                                    <div class="rom-img">
                                        <img src="{{ asset('images/default_rooms/family_room.jpg') }}" alt="">
                                    </div>
                                    <div class="room-title-badge">
                                        Testing Room- {{ $i + 1 }}
                                    </div>
                                </div>
                            </a>
                        @endfor --}}
                    </div>
                </div>

                @foreach ($roomsByType as $type => $rooms)
                <div class="tab-pane fade" id="{{ $type }}" role="tabpanel" aria-labelledby="{{ $type }}-tab">
                    <div class="rooms-container py-3">
                        @foreach ($rooms as $room)
                            <a href="{{ route('tables', $room->id) }}">
                                <div class="room-card">
                                    <div class="box">
                                        <div class="ribbon-success"><span>Available</span></div>
                                    </div>
                                    <div class="rom-img">
                                        <img src="{{ asset('storage/rooms/' . $room->image) }}" alt="">
                                    </div>
                                    <div class="room-title-badge">
                                        {{ $room->name }}

                                    </div>
                                </div>
                            </a>
                        @endforeach
                        {{-- @for ($i = 0; $i < 2; $i++)
                            <a href="{{ route('tables', 1) }}">
                                <div class="room-card">
                                    <div class="box">
                                        <div class="ribbon-danger"><span>Full</span></div>
                                    </div>
                                    <div class="rom-img">
                                        <img src="{{ asset('images/default_rooms/family_room.jpg') }}" alt="">
                                    </div>
                                    <div class="room-title-badge">
                                        Testing Room- {{ $i + 1 }}
                                    </div>
                                </div>
                            </a>
                        @endfor --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection

@section('js')

@endsection

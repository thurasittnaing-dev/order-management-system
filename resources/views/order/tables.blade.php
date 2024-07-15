@extends('layouts.orderlayout')

@section('title', 'Order Menu')

@section('page', 'Order Menu')

@section('content')
    <div class="container-fluid">
        <div class="page-card">
            <div class="text-center room-title">{{ $room->name }} Tables <span>({{ $totalTables }})</span></div>
            <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button"
                            role="tab" aria-controls="all" aria-selected="true">All({{ $totalTables }})</button>
                    </li>
                </div>

                @foreach ($maxPersons as $max_person => $groupedTables)
                    <div class="col-md-2">
                        <li class="nav-item d-grid" role="presentation">
                            <button class="nav-link @if ($max_person == 2) active @endif"
                                id="{{ $max_person }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $max_person }}"
                                type="button" role="tab" aria-controls="{{ $max_person }}"
                                aria-selected="false">{{ $max_person }} Persons
                                Table({{ $countByMaxPerson [$max_person] }})</button>
                        </li>
                    </div>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @foreach ($tables as $table)
                                <a href="{{ route('makeOrder', ['table' => $table->id, 'order' => $table->current_order]) }}"
                                    class="col-md-2">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table.png') }}" class="table-img" alt="">
                                        <span class="table-badge">{{ $table->max_person }} Persons</span>
                                        <span class="table-card-no">{{ $table->table_no }}</span>
                                        @if ($table->current_order == true)
                                            <div class="box">
                                                <div class="ribbon-danger"><span>In Use</span></div>
                                            </div>
                                        @endif

                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
                @foreach ($maxPersons as $max_person => $groupedTables)
                    <div class="tab-pane fade @if ($max_person == 2) show active @endif"
                        id="{{ $max_person }}" role="tabpanel" aria-labelledby="{{ $max_person }}-tab">
                        <div class="mt-3 table-card-container">
                            @foreach ($groupedTables as $table)
                                <a href="{{ route('makeOrder', ['table' => $table->id, 'order' => $table->current_order]) }}"
                                    class="">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table.png') }}" class="table-img" alt="">
                                        <span class="table-badge">{{ $table->max_person }} Persons</span>
                                        <span class="table-card-no">{{ $table->table_no }}</span>
                                        @if ($table->current_order == true)
                                            <div class="box">
                                                <div class="ribbon-danger"><span>In Use</span></div>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
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

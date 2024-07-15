@extends('layouts.orderlayout')

@section('title', 'Order History')

@section('page', 'Order History')

@section('content')

    <div class="container-fluid">
        <div class="page-card">
            <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                            type="button" role="tab" aria-controls="all" aria-selected="true">All({{ $total_count }}) </button>
                    </li>
                </div>

                @foreach ($maxPersons as $max_person => $groupedTables)
                    <div class="col-md-2">
                        <li class="nav-item d-grid" role="presentation">
                            <button class="nav-link" id="{{ $max_person }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $max_person }}" type="button" role="tab"
                                aria-controls="{{ $max_person }}" aria-selected="false">{{ $max_person }} Persons
                                Table({{ $countByPerson [$max_person] }})</button>
                        </li>
                    </div>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="mt-3 table-card-container">
                        @foreach ($tables as $table)
                            @if ($table->current_order == true)
                                <a href="{{ route('makeOrder', ['table' => $table->id, 'order' => $table->current_order]) }}"
                                    class="">
                                    <div class="table-card">
                                        <img src="{{ asset('images/table.png') }}" class="table-img" alt="">
                                        <span class="table-badge">{{ $table->max_person }} Persons</span>
                                        <span class="table-card-no">{{ $table->table_no }}</span>
                                        <div class="box">
                                            <div class="ribbon-danger"><span>In Use</span></div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @foreach ($maxPersons as $max_person => $groupedTables)
                    <div class="tab-pane fade" id="{{ $max_person }}" role="tabpanel"
                        aria-labelledby="{{ $max_person }}-tab">
                        <div class="mt-3">
                            <div class="row g-2">
                                @foreach ($groupedTables as $table)
                                    @if ($table->current_order == true)
                                        <a href="{{ route('makeOrder', ['table' => $table->id, 'order' => $table->current_order]) }}"
                                            class="col-md-2">
                                            <div class="table-card">
                                                <img src="{{ asset('images/table.png') }}" class="table-img"
                                                    alt="">
                                                <span class="table-badge">{{ $table->max_person }} Persons</span>
                                                <span class="table-card-no">{{ $table->table_no }}</span>
                                                <div class="box">
                                                    <div class="ribbon-danger"><span>In Use</span></div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach

                            </div>
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

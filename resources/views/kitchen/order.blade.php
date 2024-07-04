@extends('layouts.kitchenlayout')

@section('title', 'Incoming Orders')

@section('page', 'Incoming Orders')

@section('content')
    <div class="container-fluid">
        <div class="page-card">
            <div class="text-center room-title"> Kitchen </div>
            <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
                <div class="col-md-3">
                    <li class="nav-item d-grid " role="presentation">
                        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                            type="button" role="tab" aria-controls="pending" aria-selected="true">Pending</button>
                    </li>
                </div>

                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link " id="confirm-tab" data-bs-toggle="tab" data-bs-target="#confirm"
                            type="button" role="tab" aria-controls="" aria-selected="true">Confirm</button>
                    </li>
                </div>
                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link " id="cancel-tab" data-bs-toggle="tab" data-bs-target="#cancel"
                            type="button" role="tab" aria-controls="" aria-selected="true">Cancel</button>
                    </li>
                </div>
                <div class="col-md-3">
                    <li class="nav-item d-grid" role="presentation">
                        <button class="nav-link " id="ready-tab" data-bs-toggle="tab" data-bs-target="#ready" type="button"
                            role="tab" aria-controls="" aria-selected="true">Ready</button>
                    </li>
                </div>

            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @foreach ($recipes as $item)
                                <div class="col-md-2 mb-2">
                                    <div class="table-card" style="width: 100%">
                                        <a href="#" class="">
                                            <img src="{{ asset('/storage/recipes/' . $item->recipe->image) }}"
                                                class="table-img" alt="">
                                        </a>
                                    </div>
                                    <div class="mt-2 d-flex gap-2">
                                        @if ($item->status === 'pending')
                                            <form action="{{ route('order.status') }}" method="POST" class="flex-grow-1">
                                                @csrf
                                                <input type="hidden" name="recipe_id" value="{{ $item->id }}">
                                                <button type="submit" name="confirm"
                                                    class="btn btn-warning w-100">Confirm</button>
                                            </form>
                                            <form action="{{ route('order.status') }}" method="POST" class="flex-grow-1">
                                                @csrf
                                                <input type="hidden" name="recipe_id" value="{{ $item->id }}">
                                                <button type="submit" name="cancel"
                                                    class="btn btn-danger w-100">Cancel</button>
                                            </form>
                                        @elseif ($item->status === 'confirm')
                                            <div class="alert alert-success" role="alert">
                                                Order Confirmed!
                                            </div>
                                        @elseif ($item->status === 'cancel')
                                            <div class="alert alert-danger" role="alert">
                                                Order Canceled!
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show " id="confirm" role="tabpanel" aria-labelledby="confirm-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @foreach ($confirm as $item)
                                <div class="col-md-2 mb-2">
                                    <div class="table-card" style="width: 100%">
                                        <a href="#" class="">
                                            <img src="{{ asset('/storage/recipes/' . $item->recipe->image) }}"
                                                class="table-img" alt="">
                                        </a>
                                    </div>
                                    <div class="mt-2 d-flex gap-2">
                                        <form action="{{ route('order.status') }}" method="POST" class="flex-grow-1">
                                            @csrf
                                            <input type="hidden" name="recipe_id" value="{{ $item->id }}">
                                            <button type="submit" name="ready"
                                             class="btn btn-warning w-100">Ready</button>
                                        </form>
                                        <form action="{{ route('order.status') }}" method="POST" class="flex-grow-1">
                                            @csrf
                                            <input type="hidden" name="recipe_id" value="{{ $item->id }}">
                                            <button type="submit" name="cancel"
                                                class="btn btn-danger w-100">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show " id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @foreach ($cancel as $item)
                                <div class="col-md-2 mb-2">
                                    <div class="table-card" style="width: 100%">
                                        <a href="#" class="">
                                            <img src="{{ asset('/storage/recipes/' . $item->recipe->image) }}"
                                                class="table-img" alt="">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show " id="ready" role="tabpanel" aria-labelledby="ready-tab">
                    <div class="mt-3">
                        <div class="row g-2">
                            @foreach ($ready as $item)
                                <div class="col-md-2 mb-2">
                                    <div class="table-card" style="width: 100%">
                                        <a href="#" class="">
                                            <img src="{{ asset('/storage/recipes/' . $item->recipe->image) }}"
                                                class="table-img" alt="">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
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

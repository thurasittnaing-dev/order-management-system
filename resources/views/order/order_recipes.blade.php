<table class="table mt-1">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Recipe</th>
            <th scope="col">Quantity</th>
            <td scope="col" align="right">
                <b>Sub Total Discount</b>
            </td>
            <td scope="col" align="right">
                <b>Sub Total Amount</b>
            </td>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < 1; $i++)
            <tr>
                <td>
                    <div class="condition-status bg-success">1</div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/default_recipes/food1.jpg') }}"
                            class="recipe-img img img-thumbnail me-2" alt="">
                        <div>
                            <div class="recipe-title">မာလာရှမ်းကော</div>
                            @if (true)
                                <div>
                                    <div class="recipe-amount">10000 MMK</div>
                                    <div class="recipe-discount"><del>13000 MMK</del></div>
                                </div>
                            @else
                                <div>
                                    <div class="recipe-amount">10000 MMK</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group" style="width: 8rem;">
                        <input type="number" class="form-control num-only" min="0" max="1000"
                            value="1">
                        <button class="btn btn-outline-danger" type="button" id="button-addon2">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                </td>
                <td align="right">6000</td>
                <td align="right">26000</td>
            </tr>

            <tr>
                <td>
                    <div class="condition-status bg-success">2</div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/default_recipes/food2.jpg') }}"
                            class="recipe-img img img-thumbnail me-2" alt="">
                        <div>
                            <div class="recipe-title">မာလာရှမ်းကော</div>
                            @if (true)
                                <div>
                                    <div class="recipe-amount">10000 MMK</div>
                                    <div class="recipe-discount"><del>15000 MMK</del></div>
                                </div>
                            @else
                                <div>
                                    <div class="recipe-amount">10000 MMK</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group" style="width: 8rem;">
                        <input type="number" class="form-control num-only" min="0" max="1000"
                            value="1">
                        <button class="btn btn-outline-danger" type="button" id="button-addon2">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                </td>
                <td align="right">10000</td>
                <td align="right">26000</td>
            </tr>

            <tr>
                <td>
                    <div class="condition-status bg-success">3</div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/default_recipes/food3.jpg') }}"
                            class="recipe-img img img-thumbnail me-2" alt="">
                        <div>
                            <div class="recipe-title">ခေါက်ဆွဲသုပ်</div>
                            @if (false)
                                <div>
                                    <div class="recipe-amount">10000 MMK</div>
                                    <div class="recipe-discount"><del>15000 MMK</del></div>
                                </div>
                            @else
                                <div>
                                    <div class="recipe-amount">5000 MMK</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group" style="width: 8rem;">
                        <input type="number" class="form-control num-only" min="0" max="1000"
                            value="1">
                        <button class="btn btn-outline-danger" type="button" id="button-addon2">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                </td>
                <td align="right">0</td>
                <td align="right">5000</td>
            </tr>
        @endfor
    </tbody>
    <tfoot>
        <tr class="border-0">
            <td align="right" colspan="4" class="border-0">Service Charges</td>
            <td align="right" class="border-0">2000</td>
        </tr>
        <tr class="border-0">
            <td align="right" colspan="4" class="border-0">Total Discount</td>
            <td align="right" class="border-0">16000</td>
        </tr>
        <tr>
            <td align="right" colspan="4">Total Amount</td>
            <td align="right">52000</td>
        </tr>
        <tr class="bg-light">
            <td align="right" colspan="4">Total Net Amount</td>
            <td align="right">34000 MMK</td>
        </tr>
    </tfoot>
</table>

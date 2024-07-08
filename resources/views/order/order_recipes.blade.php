
{{-- working code --}}

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

    <tbody id="recipes-table-body">
        @php
            $totalDiscount = 0;
            $totalAmount = 0;
        @endphp
        @if (!is_null($order))
            @php
                $serviceCharges = $orderTable->room->service_fee;
            @endphp
            @forelse ($order->orderRecipes as $key => $value)
                @php
                    $subDiscount = $value->recipe->discount * $value->quantity ;
                    $subAmount = $value->recipe->amount *  $value->quantity;
                    $totalDiscount += $subDiscount;
                    $totalAmount += $subAmount;

                @endphp
                <tr>
                    @php
                        $color = '';
                        switch ($value->status) {
                            case 'pending':
                                $color = 'info';
                                break;

                            case 'cooking':
                                $color = 'warning';
                                break;

                            case 'ready':
                                $color = 'success';
                                break;

                            default:
                                $color = 'danger';
                                break;
                        }
                    @endphp
                    <td>
                        <div class="condition-status bg-{{ $color }}">{{ $key + 1 }}</div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/recipes/' . $value->recipe->image) }}" class="recipe-img img img-thumbnail me-2" alt="">
                            <div>
                                <div class="recipe-title">{{ $value->recipe->name }}</div>
                                @if($value->recipe->discount > 0)
                                    <div>
                                        <div class="recipe-discount">{{ $value->recipe->amount - $value->recipe->discount }} MMK</div>
                                        <div class="recipe-amount"><del>{{ $value->recipe->amount }} MMK</del></div>
                                    </div>
                                @else
                                    <div>
                                        <div class="recipe-discount">{{ $value->recipe->amount }} MMK</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $value->quantity }}
                    </td>
                    <td align="right">{{ $subDiscount }}</td>
                    <td align="right">{{ $subAmount }}</td>
                </tr>
            @empty
            @endforelse
        @endif
    </tbody>

    <tfoot id="recipes-table-foot">
        @php
            $totalNetAmount = (isset($serviceCharges) ? $serviceCharges : 0) + $totalAmount - $totalDiscount;
        @endphp
        <tr class="border-0">
            <td align="right" colspan="4" class="border-0">Service Charges</td>
            <td align="right" class="border-0">{{ isset($serviceCharges) ? $serviceCharges : 0 }} MMK</td>
        </tr>
        <tr class="border-0">
            <td align="right" colspan="4" class="border-0">Total Discount</td>
            <td align="right" class="border-0">{{ $totalDiscount }} MMK</td>
        </tr>
        <tr>
            <td align="right" colspan="4">Total Amount</td>
            <td align="right">{{ $totalAmount }} MMK</td>
        </tr>
        <tr class="bg-light">
            <td align="right" colspan="4">Total Net Amount</td>
            <td align="right">{{ $totalNetAmount }} MMK</td>
        </tr>
    </tfoot>

</table>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    let selectedRecipes = JSON.parse(localStorage.getItem('selectedRecipes')) || [];
    let invoiceRecipes = [];

    @if (!is_null($order))
    invoiceRecipes = @json($order->orderRecipes)
    @endif

        const updateLocalStorage = (recipes) => {
            let data = JSON.stringify(recipes);
            $('#data').val(data);
            localStorage.setItem('selectedRecipes', data);
        };

        const renderLocalStorageRecipes = () => {
            const localStorageBody = document.getElementById('recipes-table-body');
            localStorageBody.innerHTML = ''; // Clear previous localStorage entries

            if (selectedRecipes.length > 0) {
                let totalAmount = 0;
                let totalDiscount = 0;

                selectedRecipes.forEach((recipe, index) => {
                    recipe.quantity = recipe.quantity || 1;
                    const discount = recipe.discount > 0 ? recipe.amount - recipe.discount : recipe.amount;
                    let subAmount = recipe.quantity * recipe.amount;
                    let subDiscount = recipe.quantity * recipe.discount;

                    totalAmount += subAmount;
                    totalDiscount += subDiscount;

                    const recipeRow = document.createElement('tr');
                    recipeRow.dataset.id = recipe.id;

                    recipeRow.innerHTML = `
                        <td>
                            <div class="condition-status bg-danger">${index + 1}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="${recipe.image}" class="recipe-img img img-thumbnail me-2" alt="">
                                <div>
                                    <div class="recipe-title">${recipe.name}</div>
                                    ${recipe.discount > 0 ?`
                                        <div>
                                            <div class="recipe-discount">${discount} MMK</div>
                                            <div class="recipe-amount"><del>${recipe.amount} MMK</del></div>
                                        </div> `:`
                                        <div>
                                            <div class="recipe-discount">${recipe.amount} MMK</div>
                                        </div>`
                                    }
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group" style="width: 8rem;">
                                <input type="number" class="form-control num-only" min="0" max="1000" value="${recipe.quantity}">
                                <button class="btn btn-outline-danger" type="button" id="button-addon2">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        </td>
                        <td align="right">${subDiscount}</td>
                        <td align="right">${subAmount}</td>
                    `;

                    // Event listener for quantity change
                    const quantityInput = recipeRow.querySelector('.num-only');
                    quantityInput.addEventListener('change', () => {
                        const newQuantity = parseInt(quantityInput.value);
                        if (!isNaN(newQuantity) && newQuantity >= 0 && newQuantity <= 100) {
                            recipe.quantity = newQuantity;
                            subAmount = recipe.quantity * recipe.amount;
                            subDiscount = recipe.quantity * recipe.discount;
                            updateLocalStorage(selectedRecipes);
                            renderLocalStorageRecipes();
                        } else {
                            quantityInput.value = recipe.quantity;
                        }
                    });

                    // Add delete event listener to the button
                    recipeRow.querySelector('.btn-outline-danger').addEventListener('click', () => {
                        selectedRecipes = selectedRecipes.filter(r => r.id !== recipe.id);
                        updateLocalStorage(selectedRecipes);
                        renderLocalStorageRecipes();
                    });

                    // Alert if recipe ID already exists in localStorage
                    recipeRow.querySelector('.recipe-img').addEventListener('click', function() {
                        const clickedRecipeId = this.getAttribute('data-id');
                        const existsInLocalStorage = selectedRecipes.some(r => r.id === clickedRecipeId);
                        if (existsInLocalStorage) {
                            alert('This recipe is already in your order.');
                        }
                    });

                    localStorageBody.appendChild(recipeRow);
                });


                let serviceFee = @json($orderTable->room->service_fee)
                // Update footer with calculated totals
                const tfoot = document.getElementById('recipes-table-foot');
                tfoot.innerHTML = `
                    <tr class="border-0">
                        <td align="right" colspan="4" class="border-0">Service Charges</td>
                        <td align="right" class="border-0">${serviceFee} MMK</td>
                    </tr>
                    <tr class="border-0">
                        <td align="right" colspan="4" class="border-0">Total Discount</td>
                        <td align="right" class="border-0">${totalDiscount} MMK</td>
                    </tr>
                    <tr>
                        <td align="right" colspan="4">Total Amount</td>
                        <td align="right">${totalAmount} MMK</td>
                    </tr>
                    <tr class="bg-light">
                        <td align="right" colspan="4">Total Net Amount</td>
                        <td align="right">${(serviceFee+totalAmount) - totalDiscount} MMK</td>
                    </tr>
                `;
            } else {
                document.getElementById('no-recipes').style.display = 'table-row';
            }

            let toUpdateData = localStorage.getItem('selectedRecipes');
            $('#data').val(toUpdateData);
        };

        // Initial render of recipes
        renderLocalStorageRecipes();
    });

</script>







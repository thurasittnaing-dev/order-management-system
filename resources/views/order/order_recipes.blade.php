

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
        @if (!is_null($order) )
            @forelse ($order->orderRecipes as $key => $value)
                @if ($value->status !== 'cancel')
                    @php
                        $subDiscount = $value->recipe->discount * $value->quantity;
                        $subAmount = $value->recipe->amount * $value->quantity;
                    @endphp
                    <tr data-status="{{ $value->status }}">
                        @php
                            $color = '';
                            switch ($value->status) {
                                case 'pending':
                                    $color = 'info';
                                    break;

                                case 'confirm':
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
                                <img src="{{ asset('storage/recipes/' . $value->recipe->image) }}"
                                    class="recipe-img img img-thumbnail me-2" alt="">
                                <div>
                                    <div class="recipe-title">{{ $value->recipe->name }}</div>
                                    @if ($value->recipe->discount > 0)
                                        <div>
                                            <div class="recipe-discount">
                                                {{ $value->recipe->amount - $value->recipe->discount }} MMK</div>
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
                @endif
            @empty
            @endforelse
        @endif
    </tbody>

    <tfoot id="recipes-table-foot">
        <tr class="border-0">
            <td align="right" colspan="4" class="border-0">Service Charges</td>
            <td align="right" class="border-0"><span id="service-fee">{{ $serviceFee }}</span> MMK</td>
        </tr>
        <tr>
            <td align="right" colspan="4">Total Amount</td>
            <td align="right"><span id="total-amount">{{ $totalAmount }}</span> MMK</td>
        </tr>
        <tr class="border-0">
            <td align="right" colspan="4" class="border-0">Total Discount</td>
            <td align="right" class="border-0"><span id="total-discount">{{ $totalDiscount }}</span> MMK</td>
        </tr>
        <tr class="bg-light">
            <td align="right" colspan="4">Total Net Amount</td>
            <td align="right"><span id="total-net-amount">{{ $totalAmount + $serviceFee - $totalDiscount }}</span> MMK
            </td>
        </tr>
    </tfoot>

</table>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let selectedRecipes = JSON.parse(localStorage.getItem('selectedRecipes')) || [];
        let invoiceRecipes = [];
        let databaseTotalAmount = @json($totalAmount);
        let databaseTotalDiscount = @json($totalDiscount);
        let serviceFee = @json($serviceFee);

        @if (!is_null($order))
            invoiceRecipes = @json($order->orderRecipes);
        @endif

        console.log(invoiceRecipes);

        const updateLocalStorage = (recipes) => {
            let data = JSON.stringify(recipes);
            $('#data').val(data);
            localStorage.setItem('selectedRecipes', data);
        };

        const renderLocalStorageRecipes = () => {
            const localStorageBody = document.getElementById('recipes-table-body');

            if (invoiceRecipes.length == 0) {
                localStorageBody.innerHTML = ''; // Clear previous localStorage entries
            }

            if (selectedRecipes.length > 0) {
                // Reset totals for localStorage data
                let localStorageTotalAmount = 0;
                let localStorageTotalDiscount = 0;

                selectedRecipes.forEach((recipe, index) => {
                    recipe.quantity = recipe.quantity || 1;
                    const discount = recipe.discount > 0 ? recipe.amount - recipe.discount : recipe.amount;
                    let subAmount = recipe.quantity * recipe.amount;
                    let subDiscount = recipe.quantity * recipe.discount;

                    localStorageTotalAmount += subAmount;
                    localStorageTotalDiscount += subDiscount;

                    // Remove existing row if exists
                    const existingRow = localStorageBody.querySelector(`tr[data-id='${recipe.id}']`);
                    if (existingRow) {
                        existingRow.remove();
                    }

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
                                <button class="btn btn-outline-danger" type="button" data-test="testing">
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
                        recipeRow.remove();
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

                // Update footer with calculated totals
                const totalDiscount = databaseTotalDiscount + localStorageTotalDiscount;
                const totalAmount = databaseTotalAmount + localStorageTotalAmount;
                const totalNetAmount = (serviceFee + totalAmount) - totalDiscount;

                const tfoot = document.getElementById('recipes-table-foot');
                tfoot.innerHTML = `
                    <tr class="border-0">
                        <td align="right" colspan="4" class="border-0">Service Charges</td>
                        <td align="right" class="border-0"><span id="service-fee">${serviceFee}</span> MMK</td>
                    </tr>
                    <tr class="border-0">
                        <td align="right" colspan="4" class="border-0">Total Discount</td>
                        <td align="right" class="border-0"><span id="total-discount">${totalDiscount}</span> MMK</td>
                    </tr>
                    <tr>
                        <td align="right" colspan="4">Total Amount</td>
                        <td align="right"><span id="total-amount">${totalAmount}</span> MMK</td>
                    </tr>
                    <tr class="bg-light">
                        <td align="right" colspan="4">Total Net Amount</td>
                        <td align="right"><span id="total-net-amount">${totalNetAmount}</span> MMK</td>
                    </tr>
                `;
            }

            let toUpdateData = localStorage.getItem('selectedRecipes');
            $('#data').val(toUpdateData);
        };

        // Initial render of recipes
        renderLocalStorageRecipes();
    });

    function updateTableFooterInfo(allTotalAmount, allTotalDiscount, serviceFee) {
        let selectedRecipes = JSON.parse(localStorage.getItem('selectedRecipes')) || [];
        var changeTotalAmount = allTotalAmount;
        var changeTotalDiscount = allTotalDiscount;

        selectedRecipes.forEach((recipe, index) => {
            let subAmount = recipe.quantity * recipe.amount;
            let subDiscount = recipe.quantity * recipe.discount;

            changeTotalAmount += subAmount;
            changeTotalDiscount += subDiscount;
        });

        const tfoot = document.getElementById('recipes-table-foot');
        tfoot.innerHTML = `
                    <tr class="border-0">
                        <td align="right" colspan="4" class="border-0">Service Charges</td>
                        <td align="right" class="border-0"><span id="service-fee">${serviceFee}</span> MMK</td>
                    </tr>
                    <tr class="border-0">
                        <td align="right" colspan="4" class="border-0">Total Discount</td>
                        <td align="right" class="border-0"><span id="total-discount">${changeTotalDiscount}</span> MMK</td>
                    </tr>
                    <tr>
                        <td align="right" colspan="4">Total Amount</td>
                        <td align="right"><span id="total-amount">${changeTotalAmount}</span> MMK</td>
                    </tr>
                    <tr class="bg-light">
                        <td align="right" colspan="4">Total Net Amount</td>
                        <td align="right"><span id="total-net-amount">${(serviceFee+changeTotalAmount) - changeTotalDiscount}</span> MMK</td>
                    </tr>
                `;
    }
</script>


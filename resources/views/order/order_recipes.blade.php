

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
        <tr id="no-recipes" style="display: none;">
            <td align="center" colspan="6"><b>No recipes selected!</b></td>
        </tr>
    </tbody>
    <tbody id="recipes-table-body">
    </tbody>
    <tfoot id="recipes-table-foot">

    </tfoot>

</table>


<script>



document.addEventListener('DOMContentLoaded', (event) => {
    let selectedRecipes = JSON.parse(localStorage.getItem('selectedRecipes')) || [];

    const updateLocalStorage = (recipes) => {
        let data = JSON.stringify(recipes);
        $('#data').val(data);
        localStorage.setItem('selectedRecipes', data);
    };

    const renderRecipes = () => {
        const tableBody = document.getElementById('recipes-table-body');
        tableBody.innerHTML = ''; // Clear the table body

        if (selectedRecipes.length > 0) {
            let totalAmount = 0;
            let totalDiscount = 0;

            selectedRecipes.forEach((recipe, index) => {
                recipe.quantity = recipe.quantity || 1;
                const discount = recipe.discount > 0 ? recipe.amount - recipe.discount : recipe.amount;
                let subAmount = recipe.quantity * recipe.amount; // Initialize amount
                let subDiscount = recipe.quantity * recipe.discount; // Calculate subtotal discount

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
                                ${recipe.discount > 0 ? `
                                    <div>
                                        <div class="recipe-discount">${discount} MMK</div>
                                        <div class="recipe-amount"><del>${recipe.amount} MMK</del></div>
                                    </div>` : `
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
                        subAmount = recipe.quantity * recipe.amount; // Recalculate amount
                        subDiscount = recipe.quantity * recipe.discount; // Recalculate subDiscount
                        updateLocalStorage(selectedRecipes); // Update localStorage
                        renderRecipes(); // Re-render recipes
                    } else {
                        // Reset input if invalid value
                        quantityInput.value = recipe.quantity;
                    }
                });

                // Add delete event listener to the button
                recipeRow.querySelector('.btn-outline-danger').addEventListener('click', () => {
                    selectedRecipes = selectedRecipes.filter(r => r.id !== recipe.id);
                    updateLocalStorage(selectedRecipes);
                    renderRecipes();
                });

                // Alert if recipe ID already exists in localStorage
                recipeRow.querySelector('.recipe-img').addEventListener('click', function() {
                    const clickedRecipeId = this.getAttribute('data-id');
                    const existsInLocalStorage = selectedRecipes.some(r => r.id === clickedRecipeId);
                    if (existsInLocalStorage) {
                        alert('This recipe is already in your order.');
                    }
                });

                tableBody.appendChild(recipeRow);
            });

            // Update footer with calculated totals
            const tfoot = document.getElementById('recipes-table-foot');
            tfoot.innerHTML = `
                <tr class="border-0">
                    <td align="right" colspan="4" class="border-0">Service Charges</td>
                    <td align="right" class="border-0">0 MMK</td>
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
                    <td align="right">${totalAmount - totalDiscount} MMK</td>
                </tr>
            `;
        } else {
            document.getElementById('no-recipes').style.display = 'table-row';
        }

        let toUpdateData = localStorage.getItem('selectedRecipes');
        $('#data').val(toUpdateData);
    };

    // Initial render of recipes
    renderRecipes();


});

</script>



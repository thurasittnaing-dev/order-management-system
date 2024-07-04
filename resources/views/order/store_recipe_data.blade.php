<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const recipeCards = document.querySelectorAll('.recipe-data');

        recipeCards.forEach(card => {
            card.addEventListener('click', function (event) {
                event.preventDefault();
                const recipeId = this.dataset.id;
                const recipeName = this.dataset.name;
                const recipeAmount = this.dataset.amount;
                const recipeDiscount = this.dataset.discount;
                const recipeImage = this.dataset.image;


                const recipeData = {
                    id: recipeId,
                    name: recipeName,
                    amount: recipeAmount,
                    discount: recipeDiscount,
                    image: recipeImage,

                };

                recipeData.quantity = 1;

                // Retrieve existing recipes from localStorage
                let selectedRecipes = JSON.parse(localStorage.getItem('selectedRecipes')) || [];

                // Check if the recipe ID already exists in localStorage
                const existsInLocalStorage = selectedRecipes.some(r => r.id === recipeId);

                if (existsInLocalStorage) {
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: "This recipe is already in your order.",
                        showConfirmButton: true,
                        timer: 3000
                    });
                    return;
                } else {
                    // Add the new recipe to the array
                    selectedRecipes.push(recipeData);

                    // Update localStorage with the updated recipes array
                    localStorage.setItem('selectedRecipes', JSON.stringify(selectedRecipes));

                    // Redirect to the URL specified in dataset
                    window.location.href = this.dataset.url;
                }
            });
        });
    });
</script>

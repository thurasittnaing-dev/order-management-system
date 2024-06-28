<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const recipeCards = document.querySelectorAll('.recipe-data');

        recipeCards.forEach(card => {
            card.addEventListener('click', function () {
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
                    image: recipeImage
                };

                // Retrieve existing recipes from localStorage
                let selectedRecipes = JSON.parse(localStorage.getItem('selectedRecipes')) || [];

                // Add the new recipe to the array
                selectedRecipes.push(recipeData);

                localStorage.setItem('selectedRecipes', JSON.stringify(selectedRecipes));
                window.location.href = this.dataset.url;
            });
        });
    });
</script>

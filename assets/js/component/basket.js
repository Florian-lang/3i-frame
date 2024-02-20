(() => {
    const addToBasketButton = document.querySelector('#add-to-basket');
    const productId = document.querySelector('#detail-product').getAttribute('data-product-id');


    addToBasketButton.addEventListener('click', () => {
        const quantity = document.querySelector('#quantity').value;

        $.ajax({
            url: '/products/basket',
            method: 'POST',
            data: {
                productId: productId,
                quantity: quantity
            }
        }).done(() => {
            window.location.reload();
        });
    });
})();

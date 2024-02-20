(() => {
    function less() {
        let quantity = document.getElementById('quantity');

        if(quantity.value > 0)
        {
            quantity.value--;
        }
    }

    function more() {
        let quantity = document.getElementById('quantity');
        quantity.value++

    }
    const addProduct = document.querySelector('#add-to-stock');
    const removeProduct = document.querySelector('#remove-to-stock');

    const productId = document.querySelector('#detail-product').getAttribute('data-product-id');
    let stock = document.querySelector('#stock_product').getAttribute('value');
    

    addProduct.addEventListener('click', () => {
        
        stock++
        $.ajax({
            url: '/stocks/update',
            method: 'POST',
            data: {
                productId: productId,
                stock: stock,
            }
        }).done(() => {
            window.location.reload();
        });
    });

    removeProduct.addEventListener('click', () => {
        
        stock--
        $.ajax({
            url: '/stocks/update',
            method: 'POST',
            data: {
                productId: productId,
                stock: stock,
            }
        }).done(() => {
            window.location.reload();
        });
    });
})();
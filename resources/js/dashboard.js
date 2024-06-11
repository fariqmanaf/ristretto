    function filterProducts(category) {
        const products = document.querySelectorAll('.menu-item');
        products.forEach(product => {
            const productCategory = product.dataset.category;
            const bestSeller = product.dataset.best;
            if (category === 'all' || productCategory === category || (category === 'best-seller' && bestSeller === '1')) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    const buttons = document.querySelectorAll('.category');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            filterProducts(category);
            buttons.forEach(btn => btn.classList.remove('active-category'));
            this.classList.add('active-category');
        });
    });

    const addToCart = document.querySelectorAll('.add-to-cart');
    const alert = document.querySelector('.alert');

    let cart = [];
    let totalQuantity = 0;
    let productNames = '';
    let totalPrice = 0;

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    addToCart.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            console.log(productId);
            const products = Array.from(document.querySelectorAll('.menu-item'));
            const product = products.find(product => product.getAttribute('data-product-id') === productId);
            const cartItem = cart.find(item => item.product_id === productId);
            if (product) {
                if (cartItem) {
                    cartItem.quantity++;
                } else {
                    const productName = product.querySelector('p:nth-child(2)').textContent;
                    const priceText = product.querySelector('p:nth-child(3)').textContent.replace(/[^0-9]/g, '');
                    const price = parseInt(priceText);
                    cart.push({
                        product_id: productId,
                        product_name: productName,
                        price: price,
                        quantity: 1
                    });
                }
                updateCartInfo();
                renderCart();
            } else {
                console.log(`Product with ID ${productId} not found.`);
            }
        });
    });

    function updateCartInfo() {
        totalQuantity = cart.reduce((total, item) => total + item.quantity, 0);
        productNames = cart.map(item => `${item.product_name} (${item.quantity})`).join(', ');
        totalPrice = cart.reduce((total, item) => total + item.price * item.quantity, 0);

        const totalQuantityElement = document.getElementById('total-quantity');
        const productNamesElement = document.getElementById('product-names');
        const totalPriceElement = document.getElementById('total-price');
        const cartDataElement = document.getElementById('cart-data');

        if (totalQuantityElement) {
            totalQuantityElement.value = totalQuantity;
        }

        if (productNamesElement) {
            productNamesElement.value = productNames;
        }

        if (totalPriceElement) {
            totalPriceElement.value = `Rp${numberWithCommas(totalPrice)}`;
        }
    }

    function renderCart() {
        const cartContent = document.querySelector('.cart-content');
        cartContent.innerHTML = '';
        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item', 'flex', 'items-center', 'border-b', 'border-red-700', 'w-full');
            cartItem.innerHTML = `
                <input type="text" name="quantity_${item.product_id}" class="w-10 bg-transparent border-transparent text-white" value="${item.quantity}">
                <input type="text" name="product_names" class="bg-transparent border-transparent w-40 text-white" value="${item.product_name}" readonly>
                <input type="text" name="total_price" class="bg-transparent border-transparent text-white" value="Rp${numberWithCommas(item.price * item.quantity)}" readonly>
                <input type="hidden" name="product_id_${item.product_id}" value="${item.product_id}">
                <button class="remove-item bg-red-700 text-white p-1 ml-2 rounded-lg" data-product-id="${item.product_id}">Remove</button>
            `;
            cartContent.appendChild(cartItem);
        });
    }    
<div class="alert absolute md:text-sm text-xs text-white top-28 md:top-20 w-full flex justify-center items-center">
    <?php displayFlashMessages('success'); ?>
    <?php displayFlashMessages('danger'); ?>
</div>
<div class="content-container w-screen h-screen bg-black flex justify-center">
    <p class="md:text-white text-red-500 border border-red-700 md:border-transparent absolute md:text-md text-xs p-2 top-8 md:top-12 md:right-16 right-8 md:py-2 md:px-4 md:bg-red-700 rounded-full">
        Halo, <?= $_SESSION['user']['username'] ?></p>
    <img src="<?= urlpath('assets/images/cashier.png') ?>"
        class="md:w-72 md:h-32 w-80 h-40 object-cover absolute md:left-20 md:top-0 left-[20%] top-[4rem]">
    <div class="cashier border-2 border-red-700 w-[90%] ml-4 rounded-2xl md:mt-32 mt-48 mb-4 flex md:flex-row flex-col">
        <div class="menu border-b md:border-r border-red-700 h-full md:w-[70%] overflow-scroll overflow-x-hidden">
            <p class="text-white p-4 md:text-xl font-bold w-full border-b border-red-700">Menu</p>
            <div class="menu-list border-b border-red-700 flex flex-row grow flex-wrap md:flex-nowrap">
                <button data-category="all" class="category text-white text-xs py-3 basis-1/6 border-r md:border-r border-red-700 h-full active-category">All menu</button>
                <button data-category="best-seller" class="category text-white text-xs py-3 basis-1/6 border-r md:border-r border-red-700 h-full">Best Seller</button>
                <?php foreach ($categories as $category): ?>
                    <button data-category="<?= $category['category_id'] ?>" class="category text-white text-xs py-3 basis-1/6 border-r md:border-r border-red-700 h-full"><?= $category['category_name'] ?></button>
                <?php endforeach; ?>
            </div>
            <div class="menu-content flex flex-row flex-wrap shrink justify-center">
                <?php foreach ($products as $product): ?>
                    <div class="menu-item cursor-pointer border border-red-700 rounded-lg m-4 p-2" data-category="<?= $product['category_id'] ?>" data-product-id="<?= $product['product_id'] ?>"  data-best="<?= $product['is_best_seller'] ?>">
                        <img src="<?= urlpath('assets/product/') . $product['photo'] ?>" class="w-36 h-36 object-cover rounded-lg" alt="">
                        <p class="text-white text-center text-xs mt-2"><?= $product['product_name'] ?></p>
                        <p class="text-white text-center text-xs">Rp<?= number_format($product['price'], 0, ',', '.') ?></p>
                        <button data-product-id="<?= $product['product_id'] ?>" class="add-to-cart bg-red-700 text-sm text-white p-1 w-full hover:bg-red-900 mt-2 rounded-lg">Add to cart</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="bracket h-full md:w-[30%] p-4 overflow-y-auto">
            <p class="text-white p-4 md:text-xl font-bold w-full border-b border-red-700">Cart</p>
            <form action="<?= urlpath('dashboard') ?>" class="flex flex-col" method="POST">
                <div class="cart-content flex flex-col w-full overflow-x-hidden text-xs">
                    
                </div>
                <select name="payment" id="payment" class="mt-4 bg-red-700 text-white p-1 rounded-full border-transparent">
                    <option value="1">Cash</option>
                    <option value="2">Debit Card</option>
                    <option value="3">Credit Card</option>
                </select>
                <button type="submit" class="submit-order bg-red-700 text-white p-2 mt-4 rounded-lg text-xs">Submit Order</button>
            </form>
        </div>
    </div>
</div>
<style>
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
        border: 1px solid #b91c1c
    }

    ::-webkit-scrollbar-thumb {
        background: #b91c1c;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #b91c1c;
    }

    .active-category {
        background-color: #b91c1c;
    }
</style>
<?php ob_start(); ?>
<script type="module" src="<?= urlpath('resources/js/dashboard.js') ?>"></script>
<?php $customscript = ob_get_clean(); ?>
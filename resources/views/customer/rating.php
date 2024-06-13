<div class="alert absolute md:text-sm text-xs text-white top-28 md:top-20 w-full flex justify-center items-center">
    <?php displayFlashMessages('success'); ?>
    <?php displayFlashMessages('danger'); ?>
</div>
<div class="content-container w-screen h-screen bg-black flex justify-center">
    <a href="<?= urlpath('') ?>" class="z-10 absolute top-10 left-10"><img
            src="<?= urlpath('assets/icons/back.svg') ?>" class="w-10 h-10" alt=""></a>
    <p
        class="md:text-white text-red-500 border border-red-700 md:border-transparent absolute md:text-md text-xs p-2 top-8 md:top-12 md:right-16 right-8 md:py-2 md:px-4 md:bg-red-700 rounded-full">
        Halo, <?= $_SESSION['user']['username'] ?></p>
    <p class="text-white font-bold text-xl absolute left-30 top-10">Review Our Menu</p>
    <div class="cashier border-2 border-red-700 w-[90%] ml-4 md:mt-32 mt-48 mb-4 flex flex-col">
        <div class="menu border-b md:border-r border-red-700 h-full w-full overflow-scroll overflow-x-hidden">
            <div
                class="menu-list h-auto border-b border-red-700 flex justify-center items-center flex-row grow flex-wrap md:flex-nowrap">
                <button data-category="all"
                    class="category p-2 text-white text-xs basis-1/6 border-r md:border-r border-red-700 h-full active-category">All
                    menu</button>
                <button data-category="best-seller"
                    class="category p-2 text-white text-xs basis-1/6 border-r md:border-r border-red-700 h-full">Best
                    Seller</button>
                <?php foreach ($categories as $category): ?>
                <button data-category="<?= $category['category_id'] ?>"
                    class="category p-2 text-white text-xs basis-1/6 border-r md:border-r border-red-700 h-full"><?= $category['category_name'] ?></button>
                <?php endforeach; ?>
            </div>
            <div class="menu-content flex flex-row flex-wrap shrink justify-center">
                <?php foreach ($products as $product): ?>
                <div class="menu-item cursor-pointer border border-red-700 rounded-lg m-4 p-2"
                    data-category="<?= $product['category_id'] ?>" data-product-id="<?= $product['product_id'] ?>"
                    data-best="<?= $product['is_best_seller'] ?>">
                    <img src="<?= urlpath('assets/product/') . $product['photo'] ?>"
                        class="w-36 h-36 object-cover rounded-lg" alt="">
                    <p class="text-white text-center text-xs mt-2"><?= $product['product_name'] ?></p>
                    <p class="text-white text-center mb-2 text-xs">
                        Rp<?= number_format($product['price'], 0, ',', '.') ?></p>

                    <a href="<?= urlpath('review?product=' . $product['product_id']) ?>"
                        class="bg-red-700 text-sm text-white p-1 px-12 hover:bg-red-900 rounded-lg">Review</a>
                </div>
                <?php endforeach; ?>
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

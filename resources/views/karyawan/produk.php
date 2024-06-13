<div class="alert absolute md:text-sm text-xs text-white top-28 md:top-20 w-full flex justify-center items-center">
    <?php displayFlashMessages('success'); ?>
    <?php displayFlashMessages('danger'); ?>
</div>
<div class="content-container w-screen bg-black flex justify-center">
  <p class="md:text-white text-red-500 border border-red-700 md:border-transparent absolute md:text-md text-xs p-2 top-8 md:top-12 md:right-16 right-8 md:py-2 md:px-4 md:bg-red-700 rounded-full">
      Halo, <?= $_SESSION['user']['username'] ?></p>
  <img src="<?= urlpath('assets/images/cashier.png') ?>"
      class="md:w-72 md:h-32 w-80 h-40 object-cover absolute md:left-20 md:top-0 left-[20%] top-[4rem]">
  <div class="product w-[85%] md:mt-32 mt-48 mb-4">
    <div class="button flex flex-row gap-6">
      <a href="<?= urlpath('produk/tambah') ?>" class="text-white bg-red-700 hover:bg-red-900 rounded-full py-1 px-4">+ Tambah Produk</a>
    </div>
    <div class="product flex flex-row flex-wrap shrink w-full justify-center mt-6">
      <?php foreach ($products as $product): ?>
          <div class="menu-item cursor-pointer border border-red-700 rounded-lg m-4 p-2" data-category="<?= $product['category_id'] ?>" data-product-id="<?= $product['product_id'] ?>"  data-best="<?= $product['is_best_seller'] ?>">
              <img src="<?= urlpath('assets/product/') . $product['photo'] ?>" class="w-36 h-36 object-cover rounded-lg" alt="">
              <p class="text-white text-center text-xs mt-2"><?= $product['product_name'] ?></p>
              <p class="text-white text-center text-xs mb-2">Rp<?= number_format($product['price'], 0, ',', '.') ?></p>
              <a href="<?= urlpath('produk/edit?id=' . $product['product_id']) ?>" class="edit text-center bg-red-700 text-sm text-white py-1 px-8 w-full hover:bg-red-900 rounded-lg">Edit Product</a>
              <form action="<?= urlpath('produk') ?>" method="POST" class="mt-4">
                  <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
                  <button type="submit" class="delete text-center bg-red-700 text-sm py-1 px-6 text-white hover:bg-red-900 rounded-lg">Delete Product</button>
              </form>
          </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div class="alert absolute md:text-sm text-xs text-white top-28 md:top-20 w-full flex justify-center items-center">
    <?php displayFlashMessages('success'); ?>
    <?php displayFlashMessages('danger'); ?>
</div>
<div class="content-container w-screen h-screen bg-black flex justify-center">
    <p class="md:text-white text-red-500 border border-red-700 md:border-transparent absolute md:text-md text-xs p-2 top-8 md:top-12 md:right-16 right-8 md:py-2 md:px-4 md:bg-red-700 rounded-full">
        Halo, <?= $_SESSION['user']['username'] ?></p>
    <img src="<?= urlpath('assets/images/cashier.png') ?>"
        class="md:w-72 md:h-32 w-80 h-40 object-cover absolute md:left-20 md:top-0 left-[20%] top-[4rem]">
    <div class="tambahProduk w-[85%] ml-4 rounded-2xl md:mt-40 mt-48 mb-4 flex flex-col items-center">
        <p class="text-white text-center text-xl font-bold">Tambah Produk</p>
        <form action="<?= urlpath('produk/tambah') ?>" enctype="multipart/form-data" method="post" class="mt-10">
          <div class="relative">
              <input type="text" id="name"
                  name="name"
                  class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  placeholder=""
                  required/>
              <label for="name"
                  class="absolute text-sm bg-black text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-red-600 peer-focus:dark:text-red-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Nama Produk</label>
          </div>
          <div class="relative mt-4">
              <input type="text" id="price"
                  name="price"
                  class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  placeholder=""
                  required/>
              <label for="price"
                  class="absolute text-sm bg-black text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-red-600 peer-focus:dark:text-red-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Harga Produk</label>
          </div>
          <div class="relative mt-4">
              <select name="category_id"
                  class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  required>
                  <option value="" disabled selected>Pilih Kategori</option>
                  <?php foreach ($categories as $category) : ?>
                  <option value="<?= $category['category_id'] ?>" class="text-black"><?= $category['category_name'] ?></option>
                  <?php endforeach; ?>
              </select>
              <label for="category_id"
                  class="absolute text-sm bg-black text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-red-600 peer-focus:dark:text-red-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Kategori</label>
          </div>
          <label class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
          <input name="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
          <button class="bg-red-700 hover:bg-red-900 py-2 px-4 w-full rounded-full text-white mt-6">Submit</button>
        </form>
    </div>
</div>

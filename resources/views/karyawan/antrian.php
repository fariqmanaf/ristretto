<div class="alert absolute md:text-sm text-xs text-white top-28 md:top-20 w-full flex justify-center items-center">
    <?php displayFlashMessages('success'); ?>
    <?php displayFlashMessages('danger'); ?>
</div>
<div class="content-container w-screen h-screen bg-black flex justify-center">
    <p
        class="md:text-white text-red-500 border border-red-700 md:border-transparent absolute md:text-md text-xs p-2 top-8 md:top-12 md:right-16 right-8 md:py-2 md:px-4 md:bg-red-700 rounded-full">
        Halo, <?= $_SESSION['user']['username'] ?></p>
    <img src="<?= urlpath('assets/images/cashier.png') ?>"
        class="md:w-72 md:h-32 w-80 h-40 object-cover absolute md:left-20 md:top-0 left-[20%] top-[4rem]">
    <div class="antrian w-[85%] flex flex-col md:mt-28 mt-48 mb-4">
        <p class="text-white p-4 md:text-xl font-bold w-full">Antrian</p>
        <div class="antrian-content flex flex-col w-full overflow-x-hidden text-xs">
            <?php if($transaksi == null) { ?>
            <p class="text-white text-sm mt-2 text-center mt-[15%]">Tidak ada antrian</p>
            <?php } ?>
            <?php if($transaksi != null) { ?>
                <?php foreach ($transaksi as $transaction): ?>
                    <div class="antrian-item border flex flex-row justify-between items-center border-red-700 rounded-lg m-4 p-4">
                        <div class="produk">
                            <p class="text-white text-sm">Item: <?= $transaction['product_names'] ?></p>
                            <p class="text-white text-sm">Jumlah: <?= $transaction['quantities'] ?></p>
                        </div>
                        <form action="<?= urlpath('antrian') ?>" method="post">
                            <input type="hidden" name="transaction_id" value="<?= $transaction['transaction_id'] ?>">
                            <button type="submit"
                                class="bg-red-700 text-white p-3 w-full hover:bg-red-900 rounded-full">Selesai</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
        </div>
    </div>
</div>

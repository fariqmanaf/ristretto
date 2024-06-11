<nav>
  <div class="sidebar rounded-r-lg fixed top-6 -left-1 bg-black border-2 gap-6 border-red-700 flex flex-col p-2 py-4 justify-center shadow-lg shadow-red-500">
    <a href="<?= urlpath('dashboard') ?>" class="kasir cursor-pointer relative group">
      <img src="<?= urlpath('assets/icons/cashier.svg') ?>" class="h-8 w-8 hover:saturate-50" alt="">
      <p class="tooltip border border-red-700 bg-black text-white text-xs md:text-sm rounded-lg px-2 py-1 absolute left-10 top-2 ml-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">Kasir</p>
    </a>
    <a href="<?= urlpath('antrian') ?>" class="antrian cursor-pointer relative group">
      <img src="<?= urlpath('assets/icons/coffee.svg') ?>" class="h-8 w-8 hover:saturate-50" alt="">
      <p class="tooltip border border-red-700 bg-black text-white text-xs md:text-sm rounded-lg px-2 py-1 absolute left-10 top-2 ml-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">Antrian</p>
    </a>
    <a href="<?= urlpath('produk') ?>" class="stok cursor-pointer relative group">
      <img src="<?= urlpath('assets/icons/stock.svg') ?>" class="h-8 w-8 hover:saturate-50" alt="">
      <p class="tooltip border border-red-700 bg-black text-white text-xs md:text-sm rounded-lg px-2 py-1 absolute left-10 top-2 ml-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">Produk</p>
    </a>
    <a href="<?= urlpath('logout') ?>" class="logout cursor-pointer relative group">
      <img src="<?= urlpath('assets/icons/logout.svg') ?>" class="h-8 w-8 hover:saturate-50" alt="">
      <p class="tooltip border border-red-700 bg-black text-white text-xs md:text-sm rounded-lg px-2 py-1 absolute left-10 top-2 ml-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">Logout</p>
    </a>
  </div>
</nav>
<style>
.sidebar::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: 2px solid red;
  border-radius: inherit;
  z-index: -1;
  box-shadow: inherit;
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: .5;
  }
}
</style>
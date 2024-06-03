<?php include 'resources/partials/navbar.php'; ?>
<div class="alert absolute text-white top-20 w-full flex justify-center items-center">
    <?php displayFlashMessages('success'); ?>
    <?php displayFlashMessages('error'); ?>
</div>
<div id="home" class="backdrop w-screen h-screen bg-black flex flex-col justify-center items-center relative">
  <img src="assets/logo/ristretto-logo.png" alt="" class="z-10 w-96 h-96 -mt-12">
  <p class="z-10 w-[60%] md:dark:w-[40%] italic text-white text-center text-xs md:text-sm">"Kami menawarkan suasana yang nyaman dan hangat dengan interior yang modern dan elegan. Ristretto Cafe menyajikan berbagai jenis kopi berkualitas tinggi, teh, serta minuman lainnya."</p>
  <div class="fixed inset-0">
    <video id="backdrop-video" class="w-full h-full object-cover" src="assets/backdrop/backdrop.mp4" autoplay muted loop></video>
  </div>
</div>
<div id="about" class="w-screen h-screen flex flex-col justify-center items-center relative">
  <div id="bg-black" class="bg-black w-[100dvw] h-[100dvh] bg-black absolute rounded-full"></div>
  <div class="blurred-circle circle-1 w-60 h-60 md:w-96 md:h-96"></div>
  <div class="blurred-circle circle-2 w-60 h-60 md:w-96 md:h-96"></div>
  <div class="blurred-circle circle-3 w-60 h-60 md:w-96 md:h-96"></div>
  <div class="content-container z-10 gap-12 flex flex-col md:flex-row justify-center items-center">
    <img id="pict" src="<?= urlpath('assets/images/about.jpg') ?>" class="w-60 h-40 md:w-96 md:h-60 rounded-2xl border-2 border-white" alt="Lol">
    <p id="about-text" class="text-white md:-mt-20 w-[70%] text-center text-xs md:text-base md:w-[40%] md:text-justify">Ristretto adalah sebuah kafe yang menonjolkan suasana hangat dan nyaman, ideal untuk bersantai atau bekerja. Didirikan pada tahun 2024 di kota Jember, Indonesia, Ristretto menawarkan tempat pelarian sempurna dari keramaian kota yang sibuk. Interiornya didesain dengan sentuhan modern dan elegan.</p>
  </div>
  <button class="bg-white border-transparent transition duration-300 border-2 hover:border-white hover:bg-transparent hover:text-white z-10 rounded-full mt-12 md:-mt-16 py-2 px-6 md:ml-20 font-semibold">Review Our Menu</button>
</div>
<div id="our-location" class="w-screen h-screen flex flex-col justify-center items-center relative">
  <div id="bg-black2" class="bg-black w-[100dvw] h-[100dvh] bg-black absolute"></div>
  <div class="blurred-circle circle-4 w-60 h-60 md:w-96 md:h-96"></div>
  <div class="blurred-circle circle-5 w-60 h-60 md:w-96 md:h-96"></div>
  <p class="text-white z-10 font-bold text-[40px] mb-12">Our Location</p>
  <div id='map' class="z-10 md:w-[40%] md:h-[50%] w-[70%] h-[40%] border-4 border-red-500 rounded-2xl"></div>
  <p class="text-white z-10 text-xs md:text-sm italic mt-4 w-[70%] text-center">Jl. Bengawan Solo 3 No 4, Tegalboto, Jember, Jawa Timur</p>
</div>
<div id="contact" class="w-screen h-screen flex flex-col justify-center items-center relative">
  <div id="bg-black3" class="bg-black w-[100dvw] h-[100dvh] bg-black absolute"></div>
  <div class="image flex flex-col md:flex-row justify-center items-center">
    <div class="blurred-circle md:left-[10%] circle-6 w-60 h-60 md:w-80 md:h-80"></div>
    <img src="<?= urlpath('assets/logo/margiela.png') ?>" alt="" class="z-10 h-60 w-60 md:h-96 md:w-96">
    <div class="c2-container flex flex-col items-center justify-center">
      <p class="text-white z-10 text-center mt-4 md:mt-0 font-bold text-xl md:text-[40px] mb-12 w-[80%]">Wanna take our reservation service?</p>
      <div class="social-media flex flex-row gap-12 font-semibold md:text-sm text-xs">
        <a href="https://www.instagram.com/ristretto_cafe/" target="_blank" class="z-10 text-white text-center hover:text-red-500 transition duration-300">
          <img src="<?= urlpath('assets/icons/ig.svg') ?>" alt="" class="md:w-32 md:h-32 w-16 h-16">
          <p>Instagram</p>
        </a>
        <a href="https://www.facebook.com/ristretto_cafe/" target="_blank" class="z-10 text-white text-center hover:text-red-500 transition duration-300">
          <img src="<?= urlpath('assets/icons/fb.svg') ?>" alt="" class="md:w-32 md:h-32 w-16 h-16">
          <p>Facebook</p>
        </a>
        <a href="https://www.whatsapp.com/ristretto_cafe/" target="_blank" class="z-10 text-white text-center hover:text-red-500 transition duration-300">
          <img src="<?= urlpath('assets/icons/wa.svg') ?>" alt="" class="md:w-32 md:h-32 w-16 h-16">
          <p>Whatsapp</p>
        </a>
      </div>
    </div>
  </div>
</div>
<footer>
  <div class="flex flex-row justify-center items-center p-6 bg-black relative z-10">
    <p class="text-white text-xs md:text-sm">© 2024 Ristretto Cafe. All rights reserved.</p>
  </div>
</footer>
<nav class="bg-transparent border-gray-200 dark:bg-transparent fixed w-screen z-20">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between md:justify-center mx-auto p-6">
    <a href="<?= urlpath('/'); ?>" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="assets/favicon/favicon.png" class="h-24 absolute md:left-20 w-24" alt="Ristretto Logo" />
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-red-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-200 dark:text-red-400 dark:hover:bg-transparent dark:focus:ring-red-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="menu1 font-medium flex flex-col p-4 md:p-0 mt-4 font-semibold border border-red-500 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent dark:bg-white md:dark:bg-transparent dark:border-red-700">
        <li>
          <a href="#home" class="menu-link block border-b md:border-0 py-2 px-3 text-black active:text-red-500 bg-transparent rounded md:bg-transparent md:text-white md:p-0 dark:text-black md:dark:text-white md:hover:text-red-700 md:p-0 md:dark:hover:text-red-500 dark:hover:bg-transparent dark:hover:text-red-500" aria-current="page">Home</a>
        </li>
        <li>
          <a href="#about" class="menu-link block border-b py-2 px-3 text-black rounded hover:bg-gray-100 md:dark:text-white md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-black md:dark:hover:text-red-500 dark:hover:bg-transparent dark:hover:text-red-500 md:dark:hover:bg-transparent">About</a>
        </li>
        <li>
          <a href="#our-location" class="menu-link block border-b py-2 px-3 text-black rounded hover:bg-gray-100 md:dark:text-white md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-black md:dark:hover:text-red-500 dark:hover:bg-transparent dark:hover:text-red-500 md:dark:hover:bg-transparent">Our Location</a>
        </li>
        <li>
          <a href="#contact" class="menu-link block py-2 px-3 text-black rounded hover:bg-gray-100 md:dark:text-white md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-black md:dark:hover:text-red-500 dark:hover:bg-transparent dark:hover:text-red-500 md:dark:hover:bg-transparent">Contact</a>
        </li>
        <a href="<?= urlpath('login'); ?>"><button class="bg-red-500 hover:bg-red-700 w-full text-white p-1 rounded-xl md:w-24 md:absolute md:right-12">Login</button></a>
      </ul>
    </div>
  </div>
</nav>

<style>
  @media screen and (min-width: 768px) {
    .menu1 a::after{
      display: block;
      position: relative;
      left: 0;
      width: 0;
      height: 2px;
      background-color: red;
      transition: width ease-in-out 0.3s;
      content: '';
    }

    .menu1 a:hover::after{
      width: 100%;
    }
  }

  .active-menu {
  color: red !important;
}
</style>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.menu-link');
    const sections = document.querySelectorAll('div[id]');
    const homeLink = document.querySelector('.menu-link[href="#home"]');

    const setActiveLink = () => {
      let scrollY = window.pageYOffset;
      let isHomeActive = true;
      
      sections.forEach(current => {
        const sectionHeight = current.offsetHeight;
        const sectionTop = current.offsetTop - 100; // Offset untuk kompensasi navbar
        const sectionId = current.getAttribute('id');
        
        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
          links.forEach(link => {
            link.classList.remove('active-menu');
            if (link.getAttribute('href') === '#' + sectionId) {
              link.classList.add('active-menu');
              if (sectionId !== 'home') {
                isHomeActive = false;
              }
            }
          });
        }
      });

      if (isHomeActive || scrollY < 100) {
        links.forEach(link => link.classList.remove('active-menu'));
        homeLink.classList.add('active-menu');
      }
    };

    window.addEventListener('load', setActiveLink);
    window.addEventListener('scroll', setActiveLink);

    window.addEventListener('hashchange', setActiveLink);

    homeLink.addEventListener('click', function(e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  });
</script>

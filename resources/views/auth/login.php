<section class="bg-black dark:bg-black h-screen w-screen">
    <div class="alert absolute md:text-sm text-xs text-white top-28 md:top-20 w-full flex justify-center items-center">
        <?php displayFlashMessages('success'); ?>
        <?php displayFlashMessages('error'); ?>
    </div>
    <a href="<?= urlpath('') ?>" class="z-10 absolute top-10 left-10"><img src="<?= urlpath('assets/icons/back.svg') ?>" class="w-10 h-10" alt=""></a>
    <div class="blurred-circle circle-1 w-60 h-60 top-[40%] md:top-[20%] md:left-[20%] md:w-96 md:h-96"></div>
    <div class="blurred-circle circle-2 w-60 h-60 top-[40%] md:top-[20%] md:left-[50%] md:w-96 md:h-96"></div>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
        <a href="#"
            class="flex items-center mb-6 text-2xl font-semibold text-gray-900 h-20 w-40 overflow-hidden dark:text-white">
            <img alt="" src="<?= urlpath('assets/favicon/favicon.png') ?>" class="h-40 w-40 z-10">
        </a>
        <div
            class="w-[85%] z-10 bg-black rounded-2xl border-red-600 border-2 shadow dark:border-2 md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Login Ke Akunmu!
                </h1>
                <form class="space-y-4 md:space-y-6" action="<?= urlpath('login') ?>" method="POST">
                    <div class="relative">
                        <input type="text" id="email"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=""
                            required
                            name="email" />
                        <label for="email"
                            class="absolute text-sm bg-black text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Email</label>
                    </div>
                    <div class="relative">
                        <input type="password" id="password"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=""
                            required
                            name="password"/>
                        <label for="password"
                            class="absolute text-sm bg-black text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Password</label>
                    </div>
                    <button type="submit"
                        class="w-full hover:bg-red-700 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-primary-800">Sign
                        in</button>
                    <p class="text-sm font-light text-white dark:text-white text-center">
                        Belum Punya Akun? <a href="<?= urlpath('register') ?>"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Yuk Daftar!</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<style>
    input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    transition: background-color 5000s ease-in-out 0s;
    -webkit-text-fill-color: white !important;
}
</style>
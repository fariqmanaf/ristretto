<div class="alert absolute md:text-sm text-xs text-white top-28 md:top-20 w-full flex justify-center items-center">
    <?php displayFlashMessages('success'); ?>
    <?php displayFlashMessages('danger'); ?>
</div>
<div class="content-container w-screen h-screen bg-black flex flex-col justify-center items-center">
  <a href="<?= urlpath('rating') ?>" class="z-10 absolute top-10 left-10"><img src="<?= urlpath('assets/icons/back.svg') ?>" class="w-10 h-10" alt=""></a>
  <p class="md:text-white text-red-500 md:border-transparent absolute md:text-md text-xs p-2 top-8 md:top-12 md:right-16 right-8 md:py-2 md:px-4 md:bg-red-700 rounded-full">Halo, <?= $_SESSION['user']['username'] ?></p>
  <p class="text-white font-bold text-2xl absolute top-24">Review This Product</p>
  <div class="review-container flex flex-row mt-10 w-[80%]">
    <div class="reviewForm w-[50%] h-72 border border-red-700">
      <form action="<?= urlpath('review') ?>" method="POST" class="flex flex-col p-4">
        <input type="hidden" name="product_id" id="product_id" value="<?= $_GET['product'] ?>">
        <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user']['user_id'] ?>">
        <label for="comment" class="text-white text-xs mb-2">Comment</label>
        <textarea name="comment" id="comment" cols="20" rows="5" class="border mb-2 bg-transparent text-white border-red-700 p-2"></textarea>
        <div class="star-rating">
          <input type="radio" id="star5" name="star" value="1" class="hidden" />
          <label for="star5" class="text-gray-300 cursor-pointer hover:text-red-500 transition-colors duration-200">&#9733;</label>
          <input type="radio" id="star4" name="star" value="2" class="hidden" />
          <label for="star4" class="text-gray-300 cursor-pointer hover:text-red-500 transition-colors duration-200">&#9733;</label>
          <input type="radio" id="star3" name="star" value="3" class="hidden" />
          <label for="star3" class="text-gray-300 cursor-pointer hover:text-red-500 transition-colors duration-200">&#9733;</label>
          <input type="radio" id="star2" name="star" value="4" class="hidden" />
          <label for="star2" class="text-gray-300 cursor-pointer hover:text-red-500 transition-colors duration-200">&#9733;</label>
          <input type="radio" id="star1" name="star" value="5" class="hidden" />
          <label for="star1" class="text-gray-300 cursor-pointer hover:text-red-500 transition-colors duration-200">&#9733;</label>
        </div>
        <button type="submit" class="bg-red-700 text-white p-2 mt-2 rounded-full">Submit</button>
      </form>
    </div>
    <div class="reviewAll w-[50%] h-72 border border-red-700 overflow-y-scroll ">
      <div class="review-list p-4 ">
        <?php foreach ($ratings as $rating): ?>
          <div class="review-item border-b border-red-700 mb-2">
            <?php for ($i = 0; $i < $rating['star']; $i++): ?>
              <span class="text-red-500">&#9733;</span>
            <?php endfor; ?>
            <p class="text-white text-xs mb-1">Comment: <?= $rating['comment'] ?></p>
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
</style>
<script>
  const starRating = document.querySelectorAll('.star-rating input');
  const starLabel = document.querySelectorAll('.star-rating label');
  starRating.forEach((star, index) => {
    star.addEventListener('change', () => {
      starLabel.forEach((label, idx) => {
        if (idx <= index) {
          label.classList.add('text-red-500');
        } else {
          label.classList.remove('text-red-500');
        }
      });
    });
  });
</script>
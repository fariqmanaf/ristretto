  gsap.registerPlugin(ScrollTrigger);

  const bg = document.getElementById('bg-black');
  const circles = document.querySelectorAll('.blurred-circle');
  const pict = document.getElementById('pict');
  const aboutText = document.getElementById('about-text');

  gsap.from(aboutText, {
  duration: 2,
  scrollTrigger: {
      trigger: aboutText,
      start: 'top 80%',
      end: 'top 50%',
      scrub: true,
      opacity : 1
  },
  opacity: 0,
  ease: "power1.out"
  });

  gsap.from(pict, {
  duration: 2,
  scrollTrigger: {
      duration: 2,
      trigger: pict,
      start: 'top 80%',
      end: 'top 50%',
      scrub: true,
      x: 0
  },
  x : -200,
  opacity: 0,
  ease: "power1.out"
  });

  circles.forEach((circle) => {
  gsap.from(circle, {
      duration: 2,
      scrollTrigger: {
      opacity: 1,
      trigger: circle,
      start: 'top 100%',
      end: 'top 50%',
      scrub: true
      },
      opacity: 0
  });
  });

  gsap.fromTo(bg, 
  {
      width: '10vw',
      height: '10vh',
      opacity: 0
  }, 
  {
      width: '100vw',
      height: '100vh',
      borderRadius: '0',
      opacity: 1,
      duration: 2,
      scrollTrigger: {
      trigger: bg,
      start: 'top 100%',
      end: 'top 50%',
      scrub: true
      },
      ease: "power1.out"
  }
  );
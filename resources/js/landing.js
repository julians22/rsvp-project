import Glide from "@glidejs/glide";

const carousel = new Glide(".glide", {
    type: "slider",
    rewind: false,
    bound: true,
    // autoplay: 4000,
    gap: 24,
    // peek: 48,
    perView: 3,
    breakpoints: {
        1024: {
            perView: 2,
        },
        768: {
            perView: 1,
            gap: 6,
            // peek: 12,
        },
    },
});

carousel.mount();

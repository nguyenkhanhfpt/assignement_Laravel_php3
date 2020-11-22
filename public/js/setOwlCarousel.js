$(document).ready(function() {
    const owl = $("#products");
    const owl2 = $("#product-sale");
    const owl3 = $("#new-product");
    const owl4 = $("#products-view");
    const owlProductCate = $("#product-cate");
    const productImages = $('#product-images');
    const productImagesModal = $('#view-product #product-images');

    owl.owlCarousel({
        margin: 10,
        nav: true,
        loop: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    owl2.owlCarousel({
        margin: 10,
        nav: true,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 1
            }
        }
    });

    owl3.owlCarousel({
        margin: 10,
        nav: true,
        loop: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    owl4.owlCarousel({
        margin: 10,
        nav: true,
        loop: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    
    owlProductCate.owlCarousel({
        margin: 10,
        nav: true,
        loop: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    productImagesModal.owlCarousel({
        responsive: {
            600: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    });

    productImages.owlCarousel({
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
});

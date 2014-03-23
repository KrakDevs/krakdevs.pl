requirejs.config({
    paths: {
        domReady: '../vendor/requirejs-domready/domReady',
        jquery: '../vendor/jquery/dist/jquery.min',
        lightbox2: '../vendor/lightbox2/js/lightbox-2.6.min',
        bootstrap: '../vendor/bootstrap/dist/js/bootstrap.min',
        jcarousel: '../vendor/jcarousel/dist/jquery.jcarousel.min'
    },
    shim: {
        bootstrap: ['jquery'],
        jcarousel: ["jquery"],
        lightbox2: ["jquery"]
    }
});
/*
 * Welcome to your app's site main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (site.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
import '../../css/site/style.scss';

// import gsap from 'gsap';
// import scrollmagic from 'scrollmagic';

// import $ from 'jquery';


if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('./sw.js', { scope: '/'}).then(function(registration) {
            // Registration was successful
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
            // registration failed :(
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}





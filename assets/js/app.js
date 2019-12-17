/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
// require('../css/app.scss');
import '../css/app.scss';

// import $ from 'jquery';

// console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

if(true){
    // start loading animation
    import('jquery').then(($) => {
        // stop loading animation
        console.log('Async jQuery module importation for version:',$.fn.jquery);
    });
}

// Alex: with regenerator-runtime:
//
// async function initializeAutocompleteFeature($autoComplete){
//     const { default: autocomplete} =
//         await import('.components/algolia-autocomplete');
//     autocomplete($autoComplete, 'users', 'email');
// }
//
// $(document).ready(function() {
//     const $autoComplete = $('.js-user-autocomplete');
//     if (!$autoComplete.is(':disabled')) {
//         initializeAutocompleteFeature($autoComplete);
//     }
// });



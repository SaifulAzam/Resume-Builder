/**
 * Polyfills are required to make some of the functionalities work on the
 * old browsers. This should be the first line of code to import than any
 * other thing.
 */
import "es6-promise/auto";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
	"example-component",
	require("./components/ExampleComponent.vue")
);

const app = new Vue({
	el: "#app"
});

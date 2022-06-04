/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue').default;
 import Vue from 'vue';
 import VueRouter from 'vue-router'
 Vue.use(VueRouter)
 
 //Router Imported
 import {routes} from './routes'

 
 const router = new VueRouter({
     routes,
     mode:'history'
 })
 
  new Vue({
     el: '#app',
     router
     
 })
 
 
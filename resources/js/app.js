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
 
 //import user class
 import User from './Helpers/User'
 window.User = User;
 import AppStorage from './Helpers/AppStorage'
 window.AppStorage = AppStorage;
 //import notification class

import Notification from './Helpers/Notification'
 window.Notification = Notification;
 //sweet alert start 
 import Swal from 'sweetalert2'
 window.Swal = Swal;

 const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
  window.Toast = Toast;
 //sweet alert end
  window.Reload = new Vue();
 
 const router = new VueRouter({
     routes,
     mode:'history'
 })
 
  new Vue({
     el: '#app',
     router
     
 })
 
 

let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
let home = require('./components/home.vue').default;

//End Authentication..........

//Employee Component.........
let employee = require('./components/employee/create.vue').default;

export const routes = [
    { path:'/',component:login, name:'/'},
    {path: '/signup', component:register, name:'signup'},
    {path: '/forget', component:forget, name:'forget'},
    {path: '/home', component:home, name:'home'},
    {path: '/logout', component:logout, name:'logout'},

    {path: '/employee', component:employee, name:'addemployee'},

 


]
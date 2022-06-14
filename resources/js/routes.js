
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
let home = require('./components/home.vue').default;

//End Authentication..........

//Employee Component.........
let storeemployee = require('./components/employee/create.vue').default;
let employee = require('./components/employee/index.vue').default;
let editemployee = require('./components/employee/edit.vue').default;

//Suppliler Component.........
let storesupplier = require('./components/supplier/create.vue').default;
let supplier = require('./components/supplier/index.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;

export const routes = [
    { path:'/',component:login, name:'/'},
    {path: '/signup', component:register, name:'signup'},
    {path: '/forget', component:forget, name:'forget'},
    {path: '/home', component:home, name:'home'},
    {path: '/logout', component:logout, name:'logout'},

    {path: '/store_employee', component:storeemployee, name:'store_employee'},
    {path: '/employee', component:employee, name:'employee'},
    {path: '/editemployee/:id', component:editemployee, name:'editemployee'},

    {path: '/store_supplier', component:storesupplier, name:'store_supplier'},
    {path: '/supplier', component:supplier, name:'supplier'},
    {path: '/edit_supplier/:id', component:editsupplier, name:'edit_supplier'},


 


]
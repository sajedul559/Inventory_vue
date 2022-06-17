
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
let home = require('./components/home.vue').default;
let stock = require('./components/product/stock.vue').default;
let editstock = require('./components/product/edit_stock.vue').default;



//End Authentication..........

//Employee Component.........
let storeemployee = require('./components/employee/create.vue').default;
let employee = require('./components/employee/index.vue').default;
let editemployee = require('./components/employee/edit.vue').default;

//Suppliler Component.........
let storesupplier = require('./components/supplier/create.vue').default;
let supplier = require('./components/supplier/index.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;

//Category Component.........
let storecategory = require('./components/category/create.vue').default;
let category = require('./components/category/index.vue').default;
let editcategory = require('./components/category/edit.vue').default;

//Test Component.........
let storetest = require('./components/test/create.vue').default;
let test = require('./components/test/index.vue').default;
let edittest = require('./components/test/edit.vue').default;
//Test Component.........
let storeproduct = require('./components/product/create.vue').default;
let product = require('./components/product/index.vue').default;
let editproduct = require('./components/product/edit.vue').default;
//Expense Component.........
let storeexpense = require('./components/expense/create.vue').default;
let expense = require('./components/expense/expense.vue').default;
let editexpense = require('./components/expense/edit.vue').default;

//Expense Component.........
let salary = require('./components/salary/all_employee.vue').default;
let paysalary = require('./components/salary/pay_salary.vue').default;
let allsalary = require('./components/salary/index.vue').default;
let viewsalary = require('./components/salary/view.vue').default;
let editsalary = require('./components/salary/edit.vue').default;




export const routes = [
    { path:'/',component:login, name:'/'},
    {path: '/signup', component:register, name:'signup'},
    {path: '/forget', component:forget, name:'forget'},
    {path: '/home', component:home, name:'home'},
    {path: '/logout', component:logout, name:'logout'},
    {path: '/stock', component:stock, name:'stock'},
    {path: '/editstock', component:editstock, name:'edit_stock'},


     //Employee Routes
    {path: '/store_employee', component:storeemployee, name:'store_employee'},
    {path: '/employee', component:employee, name:'employee'},
    {path: '/editemployee/:id', component:editemployee, name:'editemployee'},
     //Supplier Routes
    {path: '/store_supplier', component:storesupplier, name:'store_supplier'},
    {path: '/supplier', component:supplier, name:'supplier'},
    {path: '/edit_supplier/:id', component:editsupplier, name:'edit_supplier'},

     //Category Routes
     {path: '/store_category', component:storecategory, name:'store_category'},
     {path: '/category', component:category, name:'category'},
     {path: '/edit_category/:id', component:editcategory, name:'edit_category'},
 
     //Test Routes
     {path: '/store_test', component:storetest, name:'store_test'},
     {path: '/test', component:test, name:'test'},
     {path: '/edit_test/:id', component:edittest, name:'edit_test'},
      //Product Routes
      {path: '/store_product', component:storeproduct, name:'store_product'},
      {path: '/product', component:product, name:'product'},
      {path: '/edit_product/:id', component:editproduct, name:'edit_product'},

       //Product Routes
       {path: '/store_expense', component:storeexpense, name:'store_expense'},
       {path: '/expense', component:expense, name:'expense'},
       {path: '/edit_expense/:id', component:editexpense, name:'edit_expense'},

        //Product Routes
       {path: '/given_salary', component:salary, name:'given_salary'},
       {path: '/pay_salary/:id', component:paysalary, name:'pay_salary'},
       {path: '/allsalary', component:allsalary, name:'allsalary'},
       {path: '/viewsalary/:id', component:viewsalary, name:'view_salary'},
       {path: '/editsalary/:id', component:editsalary, name:'edit_salary'},






  
 


 


]
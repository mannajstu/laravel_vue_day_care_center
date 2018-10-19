
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');
import VueRouter from 'vue-router'
import Gate from './Gate';
Vue.prototype.$gate =new Gate(window.user);


//vue form with laravel support
import {Form,HasError,AlertError,AlertErrors, AlertSuccess} from 'vform'
window.Form=Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)

// sweet alerts
import swal from 'sweetalert2'
window.swal = swal;


//common vue methods
require('./mixins');

Vue.use(VueRouter)


let routes = [
 
  { path: '/notfound', component: require('./components/NotFound.vue'),name: 'notfound',},
  { path: '/', component: require('./components/Dashboard.vue'),name: 'home',},
//user /admin route
  { path: '/user', component: require('./components/user/User.vue'),name: 'user',},
  { path: '/adduser', component: require('./components/user/AddUser.vue'),name: 'adduser',meta: { requiresAuth: true }},
   { path: '/user/:id', component: require('./components/user/SingleUser.vue'),name: 'singleuser',},
   { path: '/user/edit/:id', component: require('./components/user/AddUser.vue'),name: 'edituser',},
//parent route
   { path: '/parent', component: require('./components/parent/Parent.vue'),name: 'parent',},
  { path: '/addparent', component: require('./components/parent/AddParent.vue'),name: 'addparent',},
   { path: '/parent/:id', component: require('./components/parent/SingleParent.vue'),name: 'singleparent',},
   { path: '/parent/edit/:id', component: require('./components/parent/AddParent.vue'),name: 'editparent',},
   
  //child route
  { path: '/child/', component: require('./components/child/Child.vue'),name: 'child',},
  { path: '/child/:id', component: require('./components/child/SingleChild.vue'),name: 'singlechild',},
  { path: '/child/edit/:id', component: require('./components/Dashboard.vue'),name: 'editchild',},
//room route
  { path: '/room/', component: require('./components/room/Room.vue'),name: 'room',},
   { path: '/addroom', component: require('./components/room/AddRoom.vue'),name: 'addroom',},
  { path: '/room/:id', component: require('./components/room/SingleRoom.vue'),name: 'singleroom',},
 { path: '/room/edit/:id', component: require('./components/room/AddRoom.vue'),name: 'editroom',},

 //docor route
 { path: '/doctor/', component: require('./components/doctor/Doctor.vue'),name: 'doctor',},
   { path: '/adddoctor', component: require('./components/doctor/AddDoctor.vue'),name: 'adddoctor',},
  { path: '/doctor/:id', component: require('./components/doctor/SingleDoctor.vue'),name: 'singledoctor',},
 { path: '/doctor/edit/:id', component: require('./components/doctor/AddDoctor.vue'),name: 'editdoctor',},
 //tacher route
 { path: '/teacher/', component: require('./components/teacher/Teacher.vue'),name: 'teacher',},
   { path: '/addteacher', component: require('./components/teacher/AddTeacher.vue'),name: 'addteacher',},
  { path: '/teacher/:id', component: require('./components/teacher/SingleTeacher.vue'),name: 'singleteacher',},
 { path: '/teacher/edit/:id', component: require('./components/teacher/AddTeacher.vue'),name: 'editteacher',},

]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({


	mode:'history',
	base: __dirname,
  routes // short for `routes: routes`
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', 
	require('./components/ExampleComponent.vue'));

const app = new Vue({

	router,
    el: '#app'
});

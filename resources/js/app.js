
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


//datetime

   import datePicker from 'vue-bootstrap-datetimepicker';
  import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
  Vue.use(datePicker);


//common vue methods
require('./mixins');

Vue.use(VueRouter)
import Notices from './components/Notices.vue';
Vue.component('notices', Notices);
import ChildShortInfo from './components/child/ChildShortInfo.vue';
Vue.component('childchortinfo', ChildShortInfo);
// import FrontEnd from './components/frontend/FrontEnd.vue';
// Vue.component('frontend', FrontEnd);
// import FrontMenu from './components/frontend/FrontMenu.vue';
// Vue.component('frontmenu', FrontMenu);
Vue.component('pagination', require('laravel-vue-pagination'));

let routes = [
 
  { path: '/notfound', component: require('./components/NotFound.vue'),name: 'notfound',},
  { path: '/home', component: require('./components/Dashboard.vue'),name: 'adminhome',},
  { path: '/', component: require('./components/frontend/FrontEnd.vue'),name: 'frontendhome',},
  { path: '/adminactivation', component: require('./components/AdminActivation.vue'),name: 'adminactivation',},
  { path: '/login', component: require('./components/auth/Login.vue'),name: 'login',},

  
  { path: '/register', component: require('./components/auth/Register.vue'),name: 'register',},
  { path: '/headercontent', component: require('./components/home/HeaderContent.vue'),name: 'headercontent',},
  { path: '/addgeneralnotice', component: require('./components/notice/AddGeneralNotice.vue'),name: 'addgeneralnotice',},
  { path: '/generalnotice/edit/:id', component: require('./components/notice/AddGeneralNotice.vue'),name: 'editgeneralnotice',},
  { path: '/generalnotice/:id', component: require('./components/notice/SingleGeneralNotice.vue'),name: 'singlegeneralnotice',},
  { path: '/generalnotice', component: require('./components/notice/GeneralNotice.vue'),name: 'generalnotice',},
  { path: '/aboutpage', component: require('./components/About.vue'),name: 'about',},
  { path: '/about', component: require('./components/frontend/AboutFront.vue'),name: 'aboutfront',},
//user /admin route
  { path: '/user', component: require('./components/user/User.vue'),name: 'user',},
  { path: '/adduser', component: require('./components/user/AddUser.vue'),name: 'adduser',meta: { requiresAuth: true }},
   { path: '/user/:id', component: require('./components/user/SingleUser.vue'),name: 'singleuser',},
   { path: '/user/edit/:id', component: require('./components/user/AddUser.vue'),name: 'edituser',},
//parent route
   { path: '/parent/dashboard', component: require('./components/parent/ParentDashboard.vue'),name: 'parentdashboard',},
   { path: '/parent', component: require('./components/parent/Parent.vue'),name: 'parent',},
  { path: '/addparent', component: require('./components/parent/AddParent.vue'),name: 'addparent',},
   { path: '/parent/:id', component: require('./components/parent/SingleParent.vue'),name: 'singleparent',},
   { path: '/parent/edit/:id', component: require('./components/parent/AddParent.vue'),name: 'editparent',},
   
  //child route
  { path: '/child/', component: require('./components/child/Child.vue'),name: 'child',},
  { path: '/child/:id', component: require('./components/child/SingleChild.vue'),name: 'singlechild',},
  { path: '/child/edit/:id', component: require('./components/Dashboard.vue'),name: 'editchild',},
  { path: '/child/parent/edit/:id', component: require('./components/child/EditParentChild.vue'),name: 'editparentchild',},
//room route
  { path: '/room/', component: require('./components/room/Room.vue'),name: 'room',},
   { path: '/addroom', component: require('./components/room/AddRoom.vue'),name: 'addroom',},
  { path: '/room/:id', component: require('./components/room/SingleRoom.vue'),name: 'singleroom',},
 { path: '/room/edit/:id', component: require('./components/room/AddRoom.vue'),name: 'editroom',},
 //class route
  { path: '/class/', component: require('./components/class/Class.vue'),name: 'class',},
   { path: '/addclass', component: require('./components/class/AddClass.vue'),name: 'addclass',},
  { path: '/class/:id', component: require('./components/class/SingleClass.vue'),name: 'singleclass',},
 { path: '/class/edit/:id', component: require('./components/class/AddClass.vue'),name: 'editclass',},

 //docor route
 { path: '/doctor/dashboard', component: require('./components/doctor/DoctorDashboard.vue'),name: 'doctordashboard',},
 { path: '/doctor/', component: require('./components/doctor/Doctor.vue'),name: 'doctor',},
   { path: '/adddoctor', component: require('./components/doctor/AddDoctor.vue'),name: 'adddoctor',},
  { path: '/doctor/:id', component: require('./components/doctor/SingleDoctor.vue'),name: 'singledoctor',},
 { path: '/doctor/edit/:id', component: require('./components/doctor/AddDoctor.vue'),name: 'editdoctor',},
 //tacher route
 { path: '/teacher/dashboard', component: require('./components/teacher/TeacherDashboard.vue'),name: 'teacherdashboard',},
  { path: '/teacher/', component: require('./components/teacher/Teacher.vue'),name: 'teacher',},
   { path: '/addteacher', component: require('./components/teacher/AddTeacher.vue'),name: 'addteacher',},
  { path: '/teacher/:id', component: require('./components/teacher/SingleTeacher.vue'),name: 'singleteacher',},
 { path: '/teacher/edit/:id', component: require('./components/teacher/AddTeacher.vue'),name: 'editteacher',},

 //exam route
  { path: '/exam/', component: require('./components/exam/Exam.vue'),name: 'exam',},
   { path: '/addexam', component: require('./components/exam/AddExam.vue'),name: 'addexam',},
    { path: '/addexamchild', component: require('./components/exam/AddExamChild.vue'),name: 'addexamchild',},
  { path: '/exam/:id', component: require('./components/exam/SingleExam.vue'),name: 'singleexam',},
  { path: '/childexam/', component: require('./components/exam/SingleChildExam.vue'),name: 'singlechildexam',props: true},
 { path: '/exam/edit/:id', component: require('./components/exam/AddExam.vue'),name: 'editexam',},
 //gallery route
  { path: '/gallerypage/', component: require('./components/gallery/Gallery.vue'),name: 'gallery',},
   { path: '/addgallery', component: require('./components/gallery/AddGallery.vue'),name: 'addgallery',},
  { path: '/gallery/:id', component: require('./components/gallery/SingleGallery.vue'),name: 'singlegallery',},
 { path: '/gallery/edit/:id', component: require('./components/gallery/EditGallery.vue'),name: 'editgallery',},
{ path: '/gallery', component: require('./components/frontend/FrontGallery.vue'),name: 'frontgallery',},
//message
{ path: '/admintoparent', component: require('./components/message/AdminToParent.vue'),name: 'admintoparent',props: true},
{ path: '/admintoparent/:id', component: require('./components/message/SingleAdminToParent.vue'),name: 'singleadmintoparent',},
 { path: '/doctortoparent', component: require('./components/message/DoctorToParent.vue'),name: 'doctortoparent',props: true},
{ path: '/doctortoparent/:id', component: require('./components/message/SingleDoctorToParent.vue'),name: 'singledoctortoparent',}, 
{ path: '/teachertoparent', component: require('./components/message/TeacherToParent.vue'),name: 'teachertoparent',props: true},
{ path: '/teachertoparent/:id', component: require('./components/message/SingleTeacherToParent.vue'),name: 'singleteachertoparent',},
{ path: '/parenttoadmin', component: require('./components/message/ParentToAdmin.vue'),name: 'parenttoadmin',props: true},
{ path: '/parenttoadmin/:id', component: require('./components/message/SingleParentToAdmin.vue'),name: 'singleparenttoadmin',},
{ path: '/parenttodoctor', component: require('./components/message/ParentToDoctor.vue'),name: 'parenttodoctor',props: true},
{ path: '/parenttodoctor/:id', component: require('./components/message/SingleParentToDoctor.vue'),name: 'singleparenttodoctor',},

{ path: '/parenttoteacher', component: require('./components/message/ParentToTeacher.vue'),name: 'parenttoteacher',props: true},
{ path: '/parenttoteacher/:id', component: require('./components/message/SingleParentToTeacher.vue'),name: 'singleparenttoteacher',},  

{ path: '/doctortoadmin/:id', component: require('./components/message/SingleDoctorToAdmin.vue'),name: 'singledoctortoadmin',}, 
{ path: '/admintodoctor/:id', component: require('./components/message/SingleAdminToDoctor.vue'),name: 'singleadmintodoctor',}, 
{ path: '/admintoteacher/:id', component: require('./components/message/SingleAdminToTeacher.vue'),name: 'singleadmintoteacher',},
{ path: '/teachertoadmin/:id', component: require('./components/message/SingleTeacherToAdmin.vue'),name: 'singleteachertoadmin',}, 
{ path: '/contact', component: require('./components/message/GuestToAdmin.vue'),name: 'guesttoadmin',},
{ path: '/guestmsg', component: require('./components/message/GuestToAdminMsg.vue'),name: 'guesttoadminmsg',},     
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


const app = new Vue({

	router,
    el: '#app'
});

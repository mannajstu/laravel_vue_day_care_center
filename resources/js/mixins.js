
Vue.mixin({
	methods: {
    successmsg() {
      swal({
  position: 'top-end',
  type: 'success',
  title: 'Your Info Has Been Saved',
  showConfirmButton: false,
  timer: 1800
})
    },
    restform(){

this.form.reset();
this.form.clear();

},
    
  },
  
})

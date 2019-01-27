Vue.mixin({
  methods: {
    progressmsg() {
      let timerInterval;
      swal({
        title: "Task Will Be Done Shortly",
        html: "I will close in <strong></strong> seconds.",
        timer: 4000,
        onOpen: () => {
          swal.showLoading();
          timerInterval = setInterval(() => {
            swal
              .getContent()
              .querySelector("strong").textContent = swal.getTimerLeft();
          }, 100);
        },
        onClose: () => {
          clearInterval(timerInterval);
        }
      }).then(result => {
        if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.timer
        ) {
          console.log("I was closed by the timer");
        }
      });
    },
    successmsg() {
      swal({
        position: "top-end",
        type: "success",
        title: "Your Info Has Been Saved",
        showConfirmButton: false,
        timer: 1800
      });
    },
    errormsg() {
      swal({
        type: "error",
        title: "Oops...",
        text: "Something went wrong!"
      });
    },

    restform() {
      this.form.reset();
      this.form.clear();
    }
  }
});

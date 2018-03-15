<script>
  var seconds = 6;

  function timer() {
    var time = document.getElementById('timer');
    var button = document.getElementById('resend-button');
    if (time) {
      time.innerHTML = seconds;
      seconds--;
      if (time.innerHTML == 0) {

        time.style.display = 'none';
        button.classList.remove("repass-btn-dis");
        button.classList.add("repass-btn");
        button.disabled = false;

      } else {

        setTimeout(timer, 1000);
      }
    }
  }

  setTimeout(timer, 1000);
</script>
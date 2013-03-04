<?php
session_start();
session_destroy();
?>
<p>You're now logged out, you will be redirected in <span id="counter">8</span> second(s).</p>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        location.href = '../';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },800);
</script>


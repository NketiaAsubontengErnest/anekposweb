<footer class="footer">
  <script src="<?= ASSETS ?>/js/flush_arlert.js"></script>
  <?php if (isset($_SESSION['messsage'])) : ?>
    <script>
      swal({
        title: "<?= $_SESSION['status_headen'] ?>",
        text: "<?= $_SESSION['messsage'] ?>",
        icon: "<?= $_SESSION['status_code'] ?>",
        button: "OK, THANKS!",
      });
      <?php
      unset($_SESSION['messsage']);
      unset($_SESSION['status_code']);
      unset($_SESSION['status_headen']);
      ?>
    </script>
  <?php endif; ?>
  <div class="container-fluid d-flex justify-content-between">

    <div class="copyright">
      Copyright ©
      <script>
        document.write(new Date().getFullYear())
      </script>, made with <i class="fa fa-heart heart text-danger"></i> by
      <a href="https://ernestnketiaasubonteng.netlify.app/">Anek Tech</a>
    </div>
    <div>
      <div id="dateTimeDisplay" style="font-size: 16px; font-weight: bold;"></div>
    </div>
  </div>
</footer>
</div>


<!-- End Custom template -->
</div>
<!--   Core JS Files   -->
<script src="<?= ASSETS ?>/js/core/jquery-3.7.1.min.js"></script>
<script src="<?= ASSETS ?>/js/core/popper.min.js"></script>
<script src="<?= ASSETS ?>/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="<?= ASSETS ?>/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="<?= ASSETS ?>/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="<?= ASSETS ?>/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="<?= ASSETS ?>/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="<?= ASSETS ?>/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="<?= ASSETS ?>/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="<?= ASSETS ?>/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="<?= ASSETS ?>/js/plugin/jsvectormap/world.js"></script>

<!-- Sweet Alert -->
<script src="<?= ASSETS ?>/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Kaiadmin JS -->
<script src="<?= ASSETS ?>/js/kaiadmin.min.js"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="<?= ASSETS ?>/js/setting-demo.js"></script>



<script>
  function updateDateTime() {
    const now = new Date();
    const options = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
    };
    document.getElementById('dateTimeDisplay').innerText = now.toLocaleDateString('en-US', options);
  }

  // Update the date and time every second
  setInterval(updateDateTime, 1000);

  // Initialize the display
  updateDateTime();
</script>

<script>
  $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#177dff",
    fillColor: "rgba(23, 125, 255, 0.14)",
  });

  $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#f3545d",
    fillColor: "rgba(243, 84, 93, .14)",
  });

  $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#ffa534",
    fillColor: "rgba(255, 165, 52, .14)",
  });
</script>
</body>

</html>
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Tasya Ramadhinta Khoirunnisa</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <a href="https://www.instagram.com/tasyarkh/" target="_blank">made by </a>Tasyarkh</span>
  </div>
</footer>
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<?php {
  $db = \Config\Database::connect();
  $level_m = $db->table('user')
    ->where('level', 'MANAGER')
    ->countAllResults();

  $level_a = $db->table('user')
    ->where('level', 'ADMIN')
    ->countAllResults();

  $level_k = $db->table('user')
    ->where('level', 'KASIR')
    ->countAllResults();
} ?>

<!-- plugins:js -->
<script src="<?= base_url(); ?>/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url(); ?>/assets/vendors/chart.js/Chart.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url(); ?>/assets/js/off-canvas.js"></script>
<script src="<?= base_url(); ?>/assets/js/hoverable-collapse.js"></script>
<script src="<?= base_url(); ?>/assets/js/misc.js"></script>
<script src="<?= base_url(); ?>/assets/js/settings.js"></script>
<script src="<?= base_url(); ?>/assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?= base_url(); ?>assets/js/file-upload.js"></script>

<script src="<?= base_url(); ?>/assets/auth/js/core/popper.min.js"></script>
<script src="<?= base_url(); ?>/assets/auth/js/core/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  var total = document.getElementById('total');
  var bayar = document.getElementById('bayar');
  var kembalian = document.getElementById('kembalian');
  var hasil = 0;

  var button = document.getElementById('button');
  button.disabled = true;

  if (kembalian.innerHTML == '') {
    kembalian.innerHTML = "Rp.-";
  }

  bayar.addEventListener('keyup', function() {
    hasil = total.innerHTML - bayar.value;
    console.log(hasil);
    if (hasil <= 0) {
      kembalian.innerHTML = "Rp." + Math.abs(hasil);
      button.disabled = false;
    } else {
      kembalian.innerHTML = "Rp.-";
      button.disabled = true;
    }
  });
</script>
<script>
  $(document).on('click', '.update', function(e) {
    var idUser = $(this).attr("data-idUser");
    var namaUser = $(this).attr("data-namaUser");
    var username = $(this).attr("data-username");
    var password = $(this).attr("data-password");
    var status = $(this).attr("data-status");

    $('#idUser_u').val(idUser);
    $('#namaUser_u').val(namaUser);
    $('#username_u').val(username);
    $('#password_u').val(password);

    if (status == "Aktif") {
      $('#status_u').val('Aktif').change();
    } else {
      $('#status_u').val('Pasif').change();
    }
  });
</script>
<script>
  $(document).on('click', '.editMej', function(e) {
    var idMeja = $(this).attr("data-idMeja");
    var status = $(this).attr("data-status");

    $('#idMeja_u').val(idMeja);
    $('#status_u').val(status);
  });
</script>
<script>
  $(document).on('click', '.updateMenu', function(e) {
    var idMenu = $(this).attr("data-idMenu");
    var namaMenu = $(this).attr("data-namaMenu");
    var harga = $(this).attr("data-harga");
    var gambar = $(this).attr("data-gambar");
    var stok = $(this).attr("data-stok");
    var status = $(this).attr("data-status");

    $('#idMenu_u').val(idMenu);
    $('#namaMenu_u').val(namaMenu);
    $('#harga_u').val(harga);
    $('#gambar_u').val(gambar);
    $('#stok_u').val(stok);
    if (status == "Habis") {
      $('#status_u').val('Habis').change();
    } else {
      $('#status_u').val('Tersedia').change();
    }
  });
</script>
<script>
  <?php if (session()->getFlashdata('mejaEdit')) { ?>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'info',
      title: 'Status Meja Berubah'
    })

  <?php } ?>
</script>
<script>
  <?php if (session()->getFlashdata('userSimpan')) { ?>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: 'Data Pegawai Berhasil Ditambah'
    })

  <?php } ?>
  <?php if (session()->getFlashdata('userEdit')) { ?>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'info',
      title: 'Data Pengguna Berhasil Diedit'
    })

  <?php } ?>
  <?php if (session()->getFlashdata('userHapus')) { ?>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'error',
      title: 'Data Pengguna Berhasil Dihapus'
    })

  <?php } ?>
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  });
</script>

<script>
  (function($) {
    'use strict';
    $.fn.andSelf = function() {
      return this.addBack.apply(this, arguments);
    }
    $(function() {
      if ($("#currentBalanceCircle").length) {
        var bar = new ProgressBar.Circle(currentBalanceCircle, {
          color: '#000',
          // This has to be the same size as the maximum width to
          // prevent clipping
          strokeWidth: 12,
          trailWidth: 12,
          trailColor: '#0d0d0d',
          easing: 'easeInOut',
          duration: 1400,
          text: {
            autoStyleContainer: false
          },
          from: {
            color: '#d53f3a',
            width: 12
          },
          to: {
            color: '#d53f3a',
            width: 12
          },
          // Set default step function for all animate calls
          step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = Math.round(circle.value() * 100);
            circle.setText('');

          }
        });

        bar.text.style.fontSize = '1.5rem';
        bar.animate(0.4); // Number from 0.0 to 1.0
      }
      if ($('#audience-map').length) {
        $('#audience-map').vectorMap({
          map: 'world_mill_en',
          backgroundColor: 'transparent',
          panOnDrag: true,
          focusOn: {
            x: 0.5,
            y: 0.5,
            scale: 1,
            animate: true
          },
          series: {
            regions: [{
              scale: ['#3d3c3c', '#f2f2f2'],
              normalizeFunction: 'polynomial',
              values: {

                "BZ": 75.00,
                "US": 56.25,
                "AU": 15.45,
                "GB": 25.00,
                "RO": 10.25,
                "GE": 33.25
              }
            }]
          }
        });
      }
      if ($("#transaction-history").length) {
        var areaData = {
          labels: ["Manager", "Admin", "Kasir"],
          datasets: [{
            data: [<?= $level_m; ?>, <?= $level_a; ?>, <?= $level_k; ?>],
            backgroundColor: [
              "#78c0a8", "#fcebb6", "#f0a830"
            ]
          }]
        };
        var areaOptions = {
          responsive: true,
          maintainAspectRatio: true,
          segmentShowStroke: false,
          cutoutPercentage: 70,
          elements: {
            arc: {
              borderWidth: 0
            }
          },
          legend: {
            display: false
          },
          tooltips: {
            enabled: true
          }
        }
        var transactionhistoryChartPlugins = {
          beforeDraw: function(chart) {
            var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;

            ctx.restore();
            var fontSize = 1;
            ctx.font = fontSize + "rem sans-serif";
            ctx.textAlign = 'left';
            ctx.textBaseline = "middle";
            ctx.fillStyle = "#ffffff";

            var text = "",
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2.4;

            ctx.fillText(text, textX, textY);

            ctx.restore();
            var fontSize = 0.75;
            ctx.font = fontSize + "rem sans-serif";
            ctx.textAlign = 'left';
            ctx.textBaseline = "middle";
            ctx.fillStyle = "#6c7293";

            var texts = "",
              textsX = Math.round((width - ctx.measureText(text).width) / 1.93),
              textsY = height / 1.7;

            ctx.fillText(texts, textsX, textsY);
            ctx.save();
          }
        }
        var transactionhistoryChartCanvas = $("#transaction-history").get(0).getContext("2d");
        var transactionhistoryChart = new Chart(transactionhistoryChartCanvas, {
          type: 'doughnut',
          data: areaData,
          options: areaOptions,
          plugins: transactionhistoryChartPlugins
        });
      }
    });
  })(jQuery);
</script>
<!-- End custom js for this page -->
</body>

</html>
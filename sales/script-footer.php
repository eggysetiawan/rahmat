<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>
<script type="text/javascript" src="../js/jquery.datetimepicker.full.js"></script>
<script src="../fontawesome/js/all.js"></script>
<script src="../fontawesome/js/fontawesome.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.js"></script>
<script src="../js/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script type='text/javascript' src='/js/jquery.mousewheel.min.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/semantic.js"></script>

<!-- =======menghapus border pada div======== -->
<script>
  $(document).ready(function() {
    $(".modal-dialog").addClass("modal-lg");
  })
</script>
<!-- =======menghapus border pada div======== -->

<script>
  $(function() {

    $('#body1').mousewheel(function(event, delta) {

      this.scrollLeft -= (delta * 30);

      event.preventDefault();

    });

  });
</script>

<script>
  // Tooltips Initialization
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

<script>
  $(document).ready(function() {
    $('#example').DataTable({
      "order": [
        [0, "dsc"]
      ],
      "deferRender": true
    });
  });
  $(function() {

    $('#body1').mousewheel(function(event, delta) {

      this.scrollLeft -= (delta * 30);

      event.preventDefault();

    });

  });
</script>

<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "order": [
        [0, "dsc"]
      ],
      "deferRender": true
    });
  });
</script>

<script type="text/javascript">
  // Material Select Initialization
  $(document).ready(function() {
    $('.mdb-select').materialSelect();
  });
</script>

<script type="text/javascript">
  $(function() {
    $('.active-bar ul li a').filter(function() {
      return this.href == location.href
    }).parent().addClass('active1').siblings().removeClass('active1')
    $('.active-bar ul li a').click(function() {
      $(this).parent().addClass('active1').siblings().removeClass('active1')
    })
  })
</script>

<script>
  $(document).ready(function() {
    $('#incfont').click(function() {
      curSize = parseInt($('.body').css('font-size')) + 1;
      if (curSize <= 18)
        $('.body').css('font-size', curSize);
    });
    $('#decfont').click(function() {
      curSize = parseInt($('.body').css('font-size')) - 1;
      if (curSize >= 11)
        $('.body').css('font-size', curSize);
    });
  });
</script>

<script>
  $('.rotate').click(function() {
    $(this).toggleClass('down');
  })
</script>

<script>
  $('.toggle-penawaran').click(function() {
    $(this).toggleClass('down1');
  })
</script>

<!-- <script>
	$(document).ready(function(){
	
  $(".toogle1").click(function(){
    $(".penawaran2").toggle();
  });
});
</script> -->

<script>
  $(document).ready(function() {
    $(".penawaran2").hide();
    $(".penawaran3").hide();
    $(".penawaran4").hide();
    $(".toggle1").click(function() {
      $(".penawaran2").slideToggle(1500);
      $(this).toggleClass("open");
    });

    $(".toggle2").click(function() {
      $(".penawaran3").slideToggle(1500);
      $(this).toggleClass("open");
    });

    $(".toggle3").click(function() {
      $(".penawaran4").slideToggle(1500);
      $(this).toggleClass("open");
    });

  });
</script>

<!-- <script>
	$(".toggle1").click(function(){
	$(this).addClass('active');
	$(".plus-1").hide();
});

	 $(".minus-1").click(function(){
    $("active").remove();
  });

</script> -->


<script type="text/javascript">
  // var i = 1; i <= 18; i++;	
  var rupiah = document.getElementById("rupiah1");
  rupiah.addEventListener("keyup", function(e) {

    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, "Rp ");
  });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp " + rupiah : "";
  }
</script>

<script>
  $(document).ready(function() {
    $("#intiwid-show").slideUp(300);
    $("#agfa-show").slideUp(300);
    $("#ajex-show").slideUp(300);
    $("#bayer-show").slideUp(300);
    $("#clear-show").slideUp(300);
    $("#careRay-show").slideUp(300);
    $("#iradimed-show").slideUp(300);
    $("#radimetric-show").slideUp(300);

    $("#agfa").click(function() {
      $("#intiwid-show").slideUp(300);
      $("#ajex-show").slideUp(300);
      $("#bayer-show").slideUp(300);
      $("#clear-show").slideUp(300);
      $("#careRay-show").slideUp(300);
      $("#iradimed-show").slideUp(300);
      $("#radimetric-show").slideUp(300);
      $("#agfa-show").slideToggle(500);
      $(this).toggleClass("open");
    });

    $("#ajex").click(function() {
      $("#intiwid-show").slideUp(300);
      $("#agfa-show").slideUp(300);
      $("#bayer-show").slideUp(300);
      $("#clear-show").slideUp(300);
      $("#careRay-show").slideUp(300);
      $("#iradimed-show").slideUp(300);
      $("#radimetric-show").slideUp(300);
      $("#ajex-show").slideToggle(500);
      $(this).toggleClass("open");
    });

    $("#bayer1").click(function() {
      $("#intiwid-show").slideUp(300);
      $("#agfa-show").slideUp(300);
      $("#ajex-show").slideUp(300);
      $("#clear-show").slideUp(300);
      $("#careRay-show").slideUp(300);
      $("#iradimed-show").slideUp(300);
      $("#radimetric-show").slideUp(300);
      $("#bayer-show").slideToggle(500);
      $(this).toggleClass("open");
    });

    $("#careRay").click(function() {
      $("#intiwid-show").slideUp(300);
      $("#agfa-show").slideUp(300);
      $("#ajex-show").slideUp(300);
      $("#bayer-show").slideUp(300);
      $("#clear-show").slideUp(300);
      $("#iradimed-show").slideUp(300);
      $("#radimetric-show").slideUp(300);
      $("#careRay-show").slideToggle(500);
      $(this).toggleClass("open");
    });

    $("#clear1").click(function() {
      $("#intiwid-show").slideUp(300);
      $("#agfa-show").slideUp(300);
      $("#ajex-show").slideUp(300);
      $("#bayer-show").slideUp(300);
      $("#careRay-show").slideUp(300);
      $("#iradimed-show").slideUp(300);
      $("#radimetric-show").slideUp(300);
      $("#clear-show").slideToggle(500);
      $(this).toggleClass("open");
    });

    $("#iradimed").click(function() {
      $("#intiwid-show").slideUp(300);
      $("#agfa-show").slideUp(300);
      $("#ajex-show").slideUp(300);
      $("#bayer-show").slideUp(300);
      $("#clear-show").slideUp(300);
      $("#careRay-show").slideUp(300);
      $("#radimetric-show").slideUp(300);
      $("#iradimed-show").slideToggle(500);
      $(this).toggleClass("open");
    });

    $("#radimetric").click(function() {
      $("#intiwid-show").slideUp(300);
      $("#agfa-show").slideUp(300);
      $("#ajex-show").slideUp(300);
      $("#bayer-show").slideUp(300);
      $("#clear-show").slideUp(300);
      $("#careRay-show").slideUp(300);
      $("#iradimed-show").slideUp(300);
      $("#radimetric-show").slideToggle(500);
      $(this).toggleClass("open");
    });

    $("#intiwid").click(function() {
      $("#agfa-show").slideUp(300);
      $("#ajex-show").slideUp(300);
      $("#bayer-show").slideUp(300);
      $("#clear-show").slideUp(300);
      $("#careRay-show").slideUp(300);
      $("#iradimed-show").slideUp(300);
      $("#radimetric-show").slideUp(300);
      $("#intiwid-show").slideToggle(500);
      $(this).toggleClass("open");
    });
  });
</script>

<!-- --------------------CHAT----------------------- -->
<script>
  $(document).ready(function() {
    $(document).bind('keypress', function(e) {
      if (e.keyCode == 13) {
        $('#my_form').submit();
        $('#comment').val("");
      }
    });
  });
</script>
<script type="text/javascript">
  function post() {
    var comment = document.getElementById("comment").value;
    var name = document.getElementById("username").value;
    var username313 = document.getElementById("tousername").value;
    var pk_id313 = document.getElementById("pk_id").value;
    if (comment && name && username313) {
      $.ajax({
        type: 'post',
        url: 'commentajax.php',
        data: {
          user_comm: comment,
          user_name: name,
          user_name313: username313,
          pkid313: pk_id313
        },
        success: function(response) {
          document.getElementById("comment").value = "";
        }
      });
    }
    return false;
  }
</script>

<script>
  function autoRefresh_div() {
    $("#result").load("load.php").show(); // a function which will load data from other file after x seconds
  }

  setInterval('autoRefresh_div()', 2000);
</script>
<!-- --------------------END CHAT----------------------- -->
<!-- notif chat -->
<script>
  $(document).ready(function() {

    function load_unseen_notification(view = '') {
      $.ajax({
        url: "fetch.php",
        method: "POST",
        data: {
          view: view
        },
        dataType: "json",
        success: function(data) {
          $('.dropdown-menu1').html(data.notification);
          if (data.unseen_notification > 0) {
            $('.count').html(data.unseen_notification);
          }
        }
      });
    }

    load_unseen_notification();

    $('#comment_form').on('submit', function(event) {
      event.preventDefault();
      if ($('#subject').val() != '' && $('#comment').val() != '') {
        var form_data = $(this).serialize();
        $.ajax({
          url: "insert.php",
          method: "POST",
          data: form_data,
          success: function(data) {
            $('#comment_form')[0].reset();
            load_unseen_notification();
          }
        });
      } else {
        alert("Both Fields are Required");
      }
    });

    $(document).on('click', '.dropdown-toggle', function() {
      $('.count').html('');
      load_unseen_notification('yes');
    });

    setInterval(function() {
      load_unseen_notification();;
    }, 5000);

  });
</script>
<!-- END NOTIF CHAT -->

<script>
  $(document).ready(function() {
    $('.select2').selectize({
      sortField: 'text'
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('.select3').selectize({
      sortField: 'text'
    });
  });
</script>
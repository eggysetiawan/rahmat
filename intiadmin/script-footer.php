<!-- 	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>

	<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>

	<script src="js/jquery-ui.js"></script>


	<script src="../fontawesome/js/all.js"></script>
	<script src="../fontawesome/js/fontawesome.js"></script>

	
<script>
      $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 0, "asc" ]],
        "deferRender": true
    } );
} );
</script>


	<script type="text/javascript">
	
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
	</script>


 -->




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

<script>
	$(document).ready(function() {
		$('#example').DataTable({
			"order": [
				[0, "dsc"]
			],
			"deferRender": true
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

<script>
	$('.rotate').click(function() {
		$(this).toggleClass('down');
	})
</script>
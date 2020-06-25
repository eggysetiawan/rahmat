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
	$('#example').DataTable( {
	"order": [[ 0, "dsc" ]],
	"deferRender": true
	} );
	} );
</script>

<script>
	$(document).ready(function() {
	$('#example1').DataTable( {
	"order": [[ 0, "dsc" ]],
	"deferRender": true
	} );
	} );
</script>

<script type="text/javascript">
	// Material Select Initialization
	$(document).ready(function() {
	$('.mdb-select').materialSelect();
	});
</script>

<script type="text/javascript">
	$(function(){
		$('.active-bar ul li a').filter(function(){return this.href==location.href}).parent().addClass('active1').siblings().removeClass('active1')
		$('.active-bar ul li a').click(function(){
				$(this).parent().addClass('active1').siblings().removeClass('active1')
		})
	})
</script>

<script>
      $('.rotate').click(function(){
 $(this).toggleClass('down')  ; 
})
</script>
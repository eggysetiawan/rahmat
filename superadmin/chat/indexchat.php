<?php require '../../functionsales.php';  ?>

<script language="JavaScript" type="text/javascript">
  function addSmiley(textToAdd) {
    document.formshout.pesan.value += textToAdd;
    document.formshout.pesan.focus();
  }
</script>


<?php
$qshoutbox = mysql_num_rows(mysql_query("SELECT * FROM shoutbox"));
if ($qshoutbox > 0) {
  echo "<img src='shoutbox.jpg' /><br /><br />";
  echo "<iframe src='shoutbox.php' width=230 height=250 border=1 solid></iframe><br /><br />";
  echo "<table class=shout width=20%>
        <form name=formshout action=simpanshoutbox.php method=POST>
        <tr><td>Nama</td><td> : <input class=shout type=text name=nama size=21></td></tr>
        <tr><td>Website</td><td> : <input class=shout type=text name=website size=21></td></tr>
        <tr><td valign=top>Pesan</td><td> : <textarea class=shout name='pesan' style='width: 160px; height: 35px;'></textarea></td></tr>";
  ?>
  <tr>
    <td colspan=2>
      <a onClick="addSmiley(':-)')"><img src='smiley/1.gif'></a>
      <a onClick="addSmiley(':-(')"><img src='smiley/2.gif'></a>
      <a onClick="addSmiley(';-)')"><img src='smiley/3.gif'></a>
      <a onClick="addSmiley(';-D')"><img src='smiley/4.gif'></a>
      <a onClick="addSmiley(';;-)')"><img src='smiley/5.gif'></a>
      <a onClick="addSmiley('<:D>')"><img src='smiley/6.gif'></a>
    </td>
  </tr>
<?php
  echo "<tr><td colspan=2><input class=shout type=submit name=submit value=Kirim><input class=shout type=reset name=reset value=Reset></td></tr>
        </form></table><br />";
}
?>
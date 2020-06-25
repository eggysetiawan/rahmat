<?php

require 'function_radiology.php';

session_start();

if (isset($_POST['submit'])) {
  $password = $_POST['password'];
  $passwordulang = $_POST['passwordulang'];

if ($password == $passwordulang)
{
password($_POST);
echo "<script>alert('Password Changed');
document.location.href='password.php';
</script>";
}
else
{
echo "<script>alert('password tidak sama');</script>";
}

}

if ($_SESSION['level'] == "radiology") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>About | Radiology</title>
<?php include('head.php'); ?>
</head>

<body>

<?php include('menu-bar.php'); ?><br>
<nav aria-label="breadcrumb">
          <ol class="breadcrumb1 breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $lang['settings'] ?></li>
          </ol>
        </nav>

        <div id="container1">
          <div id="content1">
            <h1><?= $lang['settings'] ?></h1>
<div class="container-fluid">
  <div class="about-inti col-md-7">


    <div class="row">
      <div class="col-xs-6 col-md-2">
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#changePw" style="text-decoration: none;">
          <img src="../image/pw.png" >
          <center><?= $lang['change_pw'] ?></center>
        </a>
      </div>
      <div class="col-xs-6 col-md-2">
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#changeLanguage" style="text-decoration: none;">
          <img src="../icon-menubar/language.png" >
          <center><?= $lang['change_language'] ?></center>
        </a>
      </div>
    </div>


<!-- Modal -->
  <div class="modal fade" id="changeLanguage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?= $lang['change_language'] ?></h4>
        </div>
        <div class="modal-body">


          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default"><a style="text-decoration: none;" href="?lang=en"><img style="width: 20px;" src="../image/usa.png"> English&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default"><a style="text-decoration: none;" href="?lang=id"><img style="width: 20px;" src="../image/indonesia.png"> Bahasa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></button>
            </div>
          </div>

         
         
            
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- End Modal -->


<!-- Modal -->
  <div class="modal fade" id="changePw" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?= $lang['change_pw'] ?></h4>
        </div>
        <div class="modal-body">
          <form action="" method="post">
      <label for="password"><b><?= $lang['input_pw'] ?></b></label><br>
      <input class="form-control" type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>.." required>
      <label for="passwordulang"><b><?= $lang['input_pw2'] ?></b></label><br>
      <input class="form-control" type="password" name="passwordulang" id="passwordulang" placeholder="<?= $lang['input_pw2'] ?>.." required><br>     
    
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" name="submit"><?= $lang['change_pw'] ?></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- End Modal -->



    

<br>

</div>
</div>
</div>

<div class="footerindex">
    <div class="">
          <div class="footer-login col-sm-12"><br>
            <center><p>&copy; Powered by Intiwid IT Solution 2019</a>.</p></center>
          </div> 
        </div>
</div>
</div>
<?php include('script-footer.php'); ?>
  </body>
  </html>
 <?php } else {header("location:../index.php");} ?>
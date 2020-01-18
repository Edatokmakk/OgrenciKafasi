<?php
#Bu Giriş formu sayfası, eğer kullanıcı zaten giriş yaptıysa, isset ($ _ SESSION ["uid"]) ile kullanıcının bu sayfaya erişmesine izin vermeyeceğiz.
#return ifadesinin altında true olursa kullanıcıyı profil.php sayfasına yönlendirilir
if (isset($_SESSION["uid"])) {
	header("location:profile.php");
}
//action.php sayfasında kullanıcı "ödeme için hazır" düğmesini tıklarsa, action.php sayfasından bir formda veri geçirilir
if (isset($_POST["login_user_with_product"])) {
	//ürün listesi dizisi
	$product_list = $_POST["product_id"];
	//Burada dizi json biçimine dönüştürüyoruz çünkü dizi çerezde saklanamıyor
	$json_e = json_encode($product_list);
	//burada çerez oluşturuyoruz ve çerez adı product_list
	setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);

}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Öğrenci Kafası</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">Öğrenci Kafası</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Anasayfa</a></li>
				<li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Ürün</a></li>
			</ul>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="signup_msg">
				<!--kayıt formundan uyarı-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Kullanıcı Giriş Formu</div>
					<div class="panel-body">
						<!--Kullanıcı giriş formu-->
						<form onsubmit="return false" id="login">
							<label for="email">E-posta</label>
							<input type="email" class="form-control" name="email" id="email" required/>
							<label for="email">Şifre</label>
							<input type="password" class="form-control" name="password" id="password" required/>
							<p><br/></p>
							<a href="#" style="color:#333; list-style:none;">Şifremi Unuttum</a><input type="submit" class="btn btn-success" style="float:right;" Value="Giriş Yap">
							<!--Kullanıcının bir hesabı yoksa hesap oluştur düğmesini tıklar-->
							<div><a href="customer_registration.php?register=1">Yeni Hesap Oluştur</a></div>
						</form>
				</div>
				<div class="panel-footer"><div id="e_msg"></div></div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>

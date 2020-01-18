<?php include "./templates/top.php"; ?>

<?php include "./templates/navbar.php"; ?>

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
			<h4>Yönetici Kayıt Formu</h4>
			<p class="message"></p>
			<form id="admin-register-form">
			  <div class="form-group">
			    <label for="name">İsim</label>
			    <input type="text" class="form-control" name="name" id="name" placeholder="İsim giriniz">
			  </div>
			  <div class="form-group">
			    <label for="email">E-posta Adresi</label>
			    <input type="email" class="form-control" name="email" id="email" placeholder="E-posta adresi giriniz">
			    <small id="emailHelp" class="form-text text-muted">E-postanızı asla başkasıyla paylaşmayacağız.</small>
			  </div>
			  <div class="form-group">
			    <label for="password">Şifre</label>
			    <input type="password" class="form-control" name="password" id="password" placeholder="Şifre">
			  </div>
			  <div class="form-group">
			    <label for="cpassword">Şifreyi Doğrula</label>
			    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Şifre">
			  </div>
			  <input type="hidden" name="admin_register" value="1">
			  <button type="button" class="btn btn-primary register-btn">Kaydol</button>
			</form>
		</div>
	</div>
</div>





<?php include "./templates/footer.php"; ?>

<script type="text/javascript" src="./js/main.js"></script>

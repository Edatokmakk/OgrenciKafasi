<?php
include "db.php";

session_start();
#Giriş scripti buradan başlıyor
#Kullanıcı, veritabanındaki verilerle kimlik bilgileri başarıyla eşleşirse, login_success dizesini çağırırız
#login_success string Anonim işlev $ ("# login") öğesini çağırmak için geri döner. click ()
if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = mysqli_real_escape_string($con,$_POST["email"]);
	$password = md5($_POST["password"]);
	$sql = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	//kullanıcı kaydı veritabanında mevcutsa $ count 1'e eşit olacaktır
	if($count == 1){
		$row = mysqli_fetch_array($run_query);
		$_SESSION["uid"] = $row["user_id"];
		$_SESSION["name"] = $row["first_name"];
		$ip_add = getenv("REMOTE_ADDR");
		//login_form.php sayfasında bir çerez oluşturduk, bu çerez mevcutsa kullanıcının giriş yapmadığı anlamına gelir
			if (isset($_COOKIE["product_list"])) {
				$p_list = stripcslashes($_COOKIE["product_list"]);
				//burada saklı json ürün listesi çerez normal diziye çözüyoruz
				$product_list = json_decode($p_list,true);
				for ($i=0; $i < count($product_list); $i++) {
					//Veritabanından kullanıcı kimliğini aldıktan sonra, burada ürün listelenmiş olup olmadığı kullanıcı sepeti öğesini kontrol ediyoruz
					$verify_cart = "SELECT id FROM cart WHERE user_id = $_SESSION[uid] AND p_id = ".$product_list[$i];
					$result  = mysqli_query($con,$verify_cart);
					if(mysqli_num_rows($result) < 1){
						//kullanıcı sepete ilk kez ürün ekliyorsa, user_id değerini geçerli kimliğe sahip veritabanı tablosuna güncelleyeceğiz
						$update_cart = "UPDATE cart SET user_id = '$_SESSION[uid]' WHERE ip_add = '$ip_add' AND user_id = -1";
						mysqli_query($con,$update_cart);
					}else{
						//zaten bu ürün veritabanı tablosunda mevcutsa, bu kaydı sileceğiz
						$delete_existing_product = "DELETE FROM cart WHERE user_id = -1 AND ip_add = '$ip_add' AND p_id = ".$product_list[$i];
						mysqli_query($con,$delete_existing_product);
					}
				}
				//burada kullanıcı çerezini yok ediyoruz
				setcookie("product_list","",strtotime("-1 day"),"/");
				//kullanıcı alışveriş sepeti sayfasından sonra oturum açıyorsa kart girişi
				echo "cart_login";
				exit();

			}
			//kullanıcı sayfadan giriş yapıyorsa login_success göndeririz
			echo "login_success";
			exit();
		}else{
			echo "<span style='color:red;'>Giriş yapmadan önce kaydolun..!</span>";
			exit();
		}

}

?>

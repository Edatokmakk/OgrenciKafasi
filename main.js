$(document).ready(function(){
	cat();
	brand();
	product();
	//cat (), sayfa yüklendiğinde veritabanından kategori kaydını alan bir işlevdir
	function cat(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{category:1},
			success	:	function(data){
				$("#get_category").html(data);

			}
		})
	}
	//brand (), sayfa her yüklendiğinde veritabanından sektör kaydını alan bir işlevdir
	function brand(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{brand:1},
			success	:	function(data){
				$("#get_brand").html(data);
			}
		})
	}
	//product (), sayfa her yüklendiğinde veritabanından ürün kaydını alan bir işlevdir
		function product(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getProduct:1},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	}
	/*	sayfa başarıyla yüklendiğinde, kullanıcı kategoriyi tıkladığında kategori kimliği alır
	ve kategori kimliğini alırız. kimliğe göre ürünleri göstereceğiz
	*/
	$("body").delegate(".category","click",function(event){
		$("#get_product").html("<h3>Loading...</h3>");
		event.preventDefault();
		var cid = $(this).attr('cid');

			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{get_seleted_Category:1,cat_id:cid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})

	})

	/*	sayfa başarıyla yüklendiğinde, kullanıcı markayı tıkladığında sektörlerin
	 bir listesini alırız ve sektör kimliğine göre ürünleri göstereceğiz
	*/
	$("body").delegate(".selectBrand","click",function(event){
		event.preventDefault();
		$("#get_product").html("<h3>Loading...</h3>");
		var bid = $(this).attr('bid');

			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{selectBrand:1,brand_id:bid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})

	})
	/*
		Sayfanın üst kısmında, kullanıcı ürünün adını koyduğunda arama düğmesi bulunan bir arama kutusu vardır.
		verilen dize ve sql sorgusu yardımıyla kullanıcı
		 verilen dize veritabanı anahtar kelimeler sütunumuza eşleşen ürün eşleşecek
	*/
	$("#search_btn").click(function(){
		$("#get_product").html("<h3>Yükleniyor...</h3>");
		var keyword = $("#search").val();
		if(keyword != ""){
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{search:1,keyword:keyword},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
		}
	})
	//end


	/*
		İşte #login giriş formu kimliği ve bu form index.php sayfasında mevcuttur buradan giriş verileri login.php
		sayfasına gönderilir login.php sayfasından login_success
	  dizesini alırsanız, kullanıcı başarıyla oturum açmış demektir ve window.location kullanıcıyı
		ana sayfadan profile.php sayfasına yönlendirmek için
	*/
	$("#login").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url	:	"login.php",
			method:	"POST",
			data	:$("#login").serialize(),
			success	:function(data){
				if(data == "login_success"){
					window.location.href = "profile.php";
				}else if(data == "cart_login"){
					window.location.href = "cart.php";
				}else{
					$("#e_msg").html(data);
					$(".overlay").hide();
				}
			}
		})
	})
	//son

	//Ödeme yapmadan önce Kullanıcı Bilgilerini alma
	$("#signup_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "register.php",
			method : "POST",
			data : $("#signup_form").serialize(),
			success : function(data){
				$(".overlay").hide();
				if (data == "register_success") {
					window.location.href = "cart.php";
				}else{
					$("#signup_msg").html(data);
				}

			}
		})
	})
	//Ödeme yapmadan önce Kullanıcı Bilgilerini alma sonu.

	//Sepete ürün ekleme
	$("body").delegate("#product","click",function(event){
		var pid = $(this).attr("pid");
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {addToCart:1,proId:pid},
			success : function(data){
				count_item();
				getCartItem();
				$('#product_msg').html(data);
				$('.overlay').hide();
			}
		})
	})
	//ürün ekleme sonu
	//Kullanıcı sepeti öğelerini sayma işlevi
	count_item();
	function count_item(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {count_item:1},
			success : function(data){
				$(".badge").html(data);
			}
		})
	}
	//Kullanıcı sepeti öğelerini sayma işlevi sonra

	//Sepet öğesini Veritabanından açılır menüye getirme
	getCartItem();
	function getCartItem(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,getCartItem:1},
			success : function(data){
				$("#cart_product").html(data);
			}
		})
	}

	//Sepet öğesini Veritabanından açılır menüye getirme sonu
	/*
		Kullanıcı miktarını her değiştirdiğinde, tuş fonksiyonunu
		kullanarak toplam tutarını hemen güncelleyeceğiz ancak kullanıcı
		sayı dışında bir şey (? '' "",. () '' vb.) koyduğunda, adet = 1
		yapacağız kullanıcı miktar 0 veya daha az 0 koyarsa, tekrar 1 adet = 1
		yapacağız ('.total'). her () bu sınıf .total için döngü işlev tekrarıdır ve her repetasyonda
		sınıf .total değerinin toplam işlemini gerçekleştiririz ve sonucu .net_total
	*/
	$("body").delegate(".qty","keyup",function(event){
		event.preventDefault();
		var row = $(this).parent().parent();
		var price = row.find('.price').val();
		var qty = row.find('.qty').val();
		if (isNaN(qty)) {
			qty = 1;
		};
		if (qty < 1) {
			qty = 1;
		};
		var total = price * qty;
		row.find('.total').val(total);
		var net_total=0;
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
		$('.net_total').html("Total : $ " +net_total);

	})
	//adet değiştirme sonu

	/*
		kullanıcı .remove sınıfına her tıkladığında o satırın ürün kimliğini alırız ve
		ürün kaldırma işlemini gerçekleştirmek için action.php adresine gönderin
	*/
	$("body").delegate(".remove","click",function(event){
		var remove = $(this).parent().parent().parent();
		var remove_id = remove.find(".remove").attr("remove_id");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{removeItemFromCart:1,rid:remove_id},
			success	:	function(data){
				$("#cart_msg").html(data);
				checkOutDetails();
			}
		})
	})
	/*
		kullanıcı .update sınıfını her tıkladığında bu satırın ürün kimliğini alırız ve
		ürün adet güncelleme işlemini gerçekleştirmek için action.php adresine gönderilir
	*/
	$("body").delegate(".update","click",function(event){
		var update = $(this).parent().parent().parent();
		var update_id = update.find(".update").attr("update_id");
		var qty = update.find(".qty").val();
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{updateCartItem:1,update_id:update_id,qty:qty},
			success	:	function(data){
				$("#cart_msg").html(data);
				checkOutDetails();
			}
		})


	})
	checkOutDetails();
	net_total();
	/*
		checkOutDetails () işlevi iki amaçla çalışır İlk olarak action.php sayfasında
		php isset ($ _ POST ["Common"]) özelliğini etkinleştirir ve bunun içinde
		isset ($ _ POST ["getCartItem"]) olan iki isset işlevi vardır ve diğeri
		isset ($ _ POST ["checkOutDetials"]) getCartItem, sepet öğesini açılır menüye göstermek için kullanılır
		checkOutDetails alışveriş sepeti öğesini Cart.php sayfasında göstermek için
	*/
	function checkOutDetails(){
	 $('.overlay').show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,checkOutDetails:1},
			success : function(data){
				$('.overlay').hide();
				$("#cart_checkout").html(data);
					net_total();
			}
		})
	}
	/*
		net total fonksiyonu, sepet öğesinin toplam miktarını hesaplamak için kullanılır
	*/
	function net_total(){
		var net_total = 0;
		$('.qty').each(function(){
			var row = $(this).parent().parent();
			var price  = row.find('.price').val();
			var total = price * $(this).val()-0;
			row.find('.total').val(total);
		})
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
		$('.net_total').html("Total : $ " +net_total);
	}

	//sepette ürün kaldırma

	page();
	function page(){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{page:1},
			success	:	function(data){
				$("#pageno").html(data);
			}
		})
	}
	$("body").delegate("#page","click",function(){
		var pn = $(this).attr("page");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{getProduct:1,setPage:1,pageNumber:pn},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	})
})

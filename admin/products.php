<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">

    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Ürün Listesi</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Ürün Ekle</a>
      	</div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>İsim</th>
              <th>Resim</th>
              <th>Fiyat</th>
              <th>Adet</th>
              <th>Kategori</th>
              <th>Sektör</th>
              <th>Düzenle/Sil</th>
            </tr>
          </thead>
          <tbody id="product_list">

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<!-- Ürün ekleme Modal -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ürün Ekle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-product-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Ürün İsmi</label>
		        		<input type="text" name="product_name" class="form-control" placeholder="Ürün İsmi Giriniz">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Sektör İsmi</label>
		        		<select class="form-control brand_list" name="brand_id">
		        			<option value="">Sektör Seç</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Kategori İsmi</label>
		        		<select class="form-control category_list" name="category_id">
		        			<option value="">Kategori Seç</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Ürün Tanımı</label>
		        		<textarea class="form-control" name="product_desc" placeholder="Ürün tanımı giriniz"></textarea>
		        	</div>
        		</div>
            <div class="col-12">
              <div class="form-group">
                <label>Ürün Adeti</label>
                <input type="number" name="product_qty" class="form-control" placeholder="Ürün Adeti Giriniz">
              </div>
            </div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Ürün Fiyatı</label>
		        		<input type="number" name="product_price" class="form-control" placeholder="Ürün Fiyatı Giriniz">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Anahtar Kelimeler <small>(örn: web, yazılım, donanım)</small></label>
		        		<input type="text" name="product_keywords" class="form-control" placeholder="Anahtar Kelime Giriniz">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Ürün Resmi <small>(format: jpg, jpeg, png)</small></label>
		        		<input type="file" name="product_image" class="form-control">
		        	</div>
        		</div>
        		<input type="hidden" name="add_product" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-product">Ürün Ekle</button>
        		</div>
        	</div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- Ürün ekleme Modal sonu -->

<!-- ürün düzenleme Modal başlangıcı -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ürün Ekle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-product-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Ürün İsmi</label>
                <input type="text" name="e_product_name" class="form-control" placeholder="Ürün İsmi Giriniz">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Sektör İsmi</label>
                <select class="form-control brand_list" name="e_brand_id">
                  <option value="">Sektör Seç</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Kategori İsmi</label>
                <select class="form-control category_list" name="e_category_id">
                  <option value="">Kategori Seç</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Ürün Tanımı</label>
                <textarea class="form-control" name="e_product_desc" placeholder="Ürün tanımı giriniz"></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Ürün Adeti</label>
                <input type="number" name="e_product_qty" class="form-control" placeholder="Ürün Adeti Giriniz">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Ürün Fiyatı</label>
                <input type="number" name="e_product_price" class="form-control" placeholder="Ürün Fiyatı Giriniz">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Anahtar Kelimeler <small>(örn: web, yazılım, donanım)</small></label>
                <input type="text" name="e_product_keywords" class="form-control" placeholder="Anahtar Kelime Giriniz">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Ürün Resmi <small>(format: jpg, jpeg, png)</small></label>
                <input type="file" name="e_product_image" class="form-control">
                <img src="../product_images/1.0x0.jpg" class="img-fluid" width="50">
              </div>
            </div>
            <input type="hidden" name="pid">
            <input type="hidden" name="edit_product" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary submit-edit-product">Ürün Ekle</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- ürün ekleme Modal sonu -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/products.js"></script>

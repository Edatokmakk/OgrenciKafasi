<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">

    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Müşteriler</h2>
      	</div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>İsim</th>
              <th>E-posta</th>
              <th>Cep Telefonu</th>
              <th>Adres</th>
            </tr>
          </thead>
          <tbody id="customer_list">
          
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<!-- Modal -->
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
		        		<label>Ürün Fiyatı</label>
		        		<input type="number" name="product_price" class="form-control" placeholder="Ürün fiyatı giriniz">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Anahtar Kelimeler <small>(örn: web, yazılım, donanım)</small></label>
		        		<input type="text" name="product_keywords" class="form-control" placeholder="Anahtar Kelimeleri giriniz">
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
<!-- Modal -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/customers.js"></script>

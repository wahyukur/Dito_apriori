<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $page; ?></h1>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-8">
        <div class="owl-carousel owl-theme">
            <?php foreach ($kategori as $kat) { ?>
            <div class="item my-3">
                <div class="card bg-dark text-white">
                    <img src="<?php echo base_url($kat->gambar_group) ?>" class="card-img img-responsive" alt="card-img" style="height: 100px;">
                    <div class="card-img-overlay">
                        <a class="nav-link active" href="<?php echo base_url('index.php/order/select/'.$kat->id_group) ?>">
                            <h5 class="card-title" style="color: white"><?php echo $kat->nama_menu_group; ?></h5>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="row">
            <?php 
            foreach ($item as $row){ ?>
                <div class="col-3">
                    <div class="card my-1">
                        <?php 
                        if (empty($row->gambar)) { ?>
                            <img src="<?php echo base_url('assets/img/null-img.jpg') ?>" class="card-img-top" alt="Image" style="height: 110px;">
                        <?php } else { ?>
                            <img src="<?php echo base_url($row->gambar) ?>" class="card-img-top" alt="Image" style="height: 110px;">
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title" style="font-size:1.3vw;"><?php echo $row->nama_menu;?></h5>
                            <div class="row">
                                <div class="col-md-7 my-auto">
                                    <h5 style="font-size:1vw;"><?php echo number_format($row->harga);?></h5>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" name="quantity" id="<?php echo $row->id_menu;?>" value="1" class="quantity form-control">
                                </div>
                            </div>
                            <button class="add_cart btn btn-success btn-block my-1" data-productid="<?php echo $row->id_menu;?>" data-productname="<?php echo $row->nama_menu;?>" data-productprice="<?php echo $row->harga;?>">Add</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-4">
        <div class="shop-cart">
            <h4>Detail Pesanan</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="detail_cart">

                </tbody>
            </table>
            <a href="<?php echo base_url('index.php/order/checkout') ?>" class="btn btn-primary">Checkout</a>
        </div>
    </div>
</div>
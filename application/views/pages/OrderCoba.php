<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $page; ?></h1>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-8">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <div class="card bg-dark text-white">
                    <img src="https://waktunyakapalapi.com/wp-content/uploads/2017/12/Ini-Dia-Perbedaan-antara-Kopi-Arabika-dan-Robusta.jpg" class="card-img" alt="card-img">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Card title</h5>
                        <a class="nav-link active" href="#">Active</a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card bg-dark text-white">
                    <img src="https://waktunyakapalapi.com/wp-content/uploads/2017/12/Ini-Dia-Perbedaan-antara-Kopi-Arabika-dan-Robusta.jpg" class="card-img" alt="card-img">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Card title</h5>
                        <a class="nav-link active" href="#">Active</a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card bg-dark text-white">
                    <img src="https://waktunyakapalapi.com/wp-content/uploads/2017/12/Ini-Dia-Perbedaan-antara-Kopi-Arabika-dan-Robusta.jpg" class="card-img" alt="card-img">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Card title</h5>
                        <a class="nav-link active" href="#">Active</a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card bg-dark text-white">
                    <img src="https://waktunyakapalapi.com/wp-content/uploads/2017/12/Ini-Dia-Perbedaan-antara-Kopi-Arabika-dan-Robusta.jpg" class="card-img" alt="card-img">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Card title</h5>
                        <a class="nav-link active" href="#">Active</a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card bg-dark text-white">
                    <img src="https://waktunyakapalapi.com/wp-content/uploads/2017/12/Ini-Dia-Perbedaan-antara-Kopi-Arabika-dan-Robusta.jpg" class="card-img" alt="card-img">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Card title</h5>
                        <a class="nav-link active" href="#">Active</a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card bg-dark text-white">
                    <img src="https://waktunyakapalapi.com/wp-content/uploads/2017/12/Ini-Dia-Perbedaan-antara-Kopi-Arabika-dan-Robusta.jpg" class="card-img" alt="card-img">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Card title</h5>
                        <a class="nav-link active" href="#">Active</a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card bg-dark text-white">
                    <img src="https://waktunyakapalapi.com/wp-content/uploads/2017/12/Ini-Dia-Perbedaan-antara-Kopi-Arabika-dan-Robusta.jpg" class="card-img" alt="card-img">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Card title</h5>
                        <a class="nav-link active" href="#">Active</a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card bg-dark text-white">
                    <img src="https://waktunyakapalapi.com/wp-content/uploads/2017/12/Ini-Dia-Perbedaan-antara-Kopi-Arabika-dan-Robusta.jpg" class="card-img" alt="card-img">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Card title</h5>
                        <a class="nav-link active" href="#">Active</a>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            
            <?php foreach ($item as $row) : ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://asset-a.grid.id/crop/0x0:0x0/700x465/photo/bolasport/medium_f2b219f03afae94e715751ec101912c3.jpg" class="card-img-top" alt="Image">
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
            <?php endforeach;?>
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
        </div>
    </div>
</div>
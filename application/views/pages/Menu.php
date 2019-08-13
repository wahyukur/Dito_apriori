<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $page; ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#inputMenu">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Input Menu
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 50%;">Nama Menu</th>
                        <th style="width: 15%;">Kode Menu</th>
                        <th style="width: 10%;">Kategori</th>
                        <th style="width: 10%;">Harga</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Nama Menu</th>
                        <th>Kode Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($item as $data) {
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->nama_menu ?></td>
                        <td><?php echo $data->kode ?></td>
                        <td><?php 
                            if ($data->kategori == 1) {
                                echo "Minuman";
                            } else {
                                echo "Cemilan";
                            }
                        ?></td>
                        <td><?php echo $data->harga ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?php echo base_url('index.php/menu/edit/'.$data->id_menu) ?>" class="btn btn-warning">
                                    <i class="fas fa-edit fa-sm"></i>
                                </a>
                                <a href="<?php echo base_url('index.php/menu/delete/'.$data->id_menu) ?>" class="btn btn-danger">
                                    <i class="fas fa-trash fa-sm"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="inputMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo base_url('index.php/menu/store') ?>" method="post">
                <!-- <input type="hidden" name="id_menu" value=""> -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Menu</label>
                        <input type="text" name="nama_menu" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" name="kode" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" id="exampleFormControlSelect1">
                            <option value="">-- Kategori --</option>
                            <option value="1">Minuman</option>
                            <option value="2">Cemilan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
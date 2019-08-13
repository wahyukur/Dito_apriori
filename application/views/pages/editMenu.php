<div class="card">
    <div class="card-body">
        <form action="<?php echo base_url('index.php/menu/update') ?>" method="post">
            <input type="hidden" name="id_menu" value="<?php echo $item->id_menu ?>">
            <div class="form-group">
                <label>Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" value="<?php echo $item->nama_menu ?>">
            </div>
            <div class="form-group">
                <label>Kode</label>
                <input type="text" name="kode" class="form-control" value="<?php echo $item->kode ?>">
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" class="form-control" id="exampleFormControlSelect1">
                    <option value="<?php echo $item->id_menu ?>">
                        <?php 
                        if ($item->kategori == 1) {
                            echo "Minuman";
                        } else {
                            echo "Cemilan";
                        }
                        ?>
                    </option>
                    <option value="">-- Kategori --</option>
                    <option value="1">Minuman</option>
                    <option value="2">Cemilan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="<?php echo $item->harga ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            <a class="btn btn-secondary" href="<?php echo base_url('index.php/menu') ?>">Cancel</a>
        </form>
    </div>
</div>


<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">NOP</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="number"  name="nop" class="form-control" value="<?=!empty($d->nop)?$d->nop:''?>">
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Nama</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text"  name="nama" class="form-control" value="<?=!empty($d->nama)?$d->nama:''?>">
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Luas Bumi/Tanah</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="number"  name="bumi" class="form-control" value="<?=!empty($d->bumi)?$d->bumi:''?>">
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Luas Bangunan</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="number"  name="bangunan" class="form-control" value="<?=!empty($d->bangunan)?$d->bangunan:''?>">
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Jumlah Pajak</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="number"  name="pajak" class="form-control" value="<?=!empty($d->pajak)?$d->pajak:''?>">
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Alamat Objek Pajak</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text"  name="alamat_op" class="form-control" value="<?=!empty($d->alamat_op)?$d->alamat_op:''?>">
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Alamat Wajib Pajak</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text"  name="alamat_wp" class="form-control" value="<?=!empty($d->alamat_wp)?$d->alamat_wp:''?>">
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Keterangan</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text"  name="ket" class="form-control" value="Belum Bayar" readonly>
    </div>
</div>
<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">

    <div class="card">
        <div class="card-content">

            <form class="form form-vertical" method="post" action="/minat/<?= $detail['kodeMinat'] ?>/update" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1" style="padding-top: 3pt; padding-left: 21pt;">
                            <a href="/minat" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <div class="col">
                            <h4 class="card-title">Edit Data Minat</h4>
                            <p style="font-size: 13px;">Data Minat</p>
                        </div>
                    </div>
                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>


                    <div class="form-body">
                        <h5>Data Pemohon</h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kode Minat *</label>
                                                <input type="text" class="form-control" name="kodeMinat" value="<?= $detail['kodeMinat'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Pemohon *</label>
                                                <input type="text" class="form-control" name="namaPemohon" value="<?= $detail['namapemohon'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>Lokasi</h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Provinsi *</label>
                                                <select name="idProvinsi" id="provinsi" class="form-control" required>
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php foreach ($provinsi as $key => $value) { ?>
                                                        <option <?= $value['id'] == $detail['idProvinsi'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kabupaten *</label>
                                                <select name="idKabupaten" id="kabupaten" class="form-control" required>
                                                    <option value=""> -- Pilih Kabupaten -- </option>
                                                    <?php foreach ($data_kabupaten as $key => $value) { ?>
                                                        <option <?= $value['id'] == $detail['idKabupaten'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kecamatan *</label>
                                                <select name="idKecamatan" id="kecamatan" class="form-control" required>
                                                    <option value=""> -- Pilih Kecamatan -- </option>
                                                    <?php foreach ($data_kecamatan as $key => $value) { ?>
                                                        <option <?= $value['id'] == $detail['idKecamatan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kelurahan *</label>
                                                <select name="idKelurahan" id="kelurahan" class="form-control" required>
                                                    <option value=""> -- Pilih Kelurahan -- </option>
                                                    <?php foreach ($data_kelurahan as $key => $value) { ?>
                                                        <option <?= $value['id'] == $detail['idKelurahan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kode Pos *</label>
                                                <input type="text" class="form-control" name="kodepos" value="<?= $detail['kodepos'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="first-name-vertical">RT *</label>
                                                <input type="text" class="form-control" name="rt" value="<?= $detail['rt'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="first-name-vertical">RW *</label>
                                                <input type="text" class="form-control" name="rw" value="<?= $detail['rw'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Koordinat</label>
                                                <input type="text" class="form-control" id="koordinat" name="koordinat" value="<?= $detail['latitude'] . ',' . $detail['longtitude'] ?>">
                                                <span class="text-danger" style="font-size: 10pt;" id="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Alamat *</label>
                                                <textarea name="alamat" id="" class="form-control"><?= $detail['alamat'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>Kontak</h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">No. Telp *</label>
                                                <input type="text" class="form-control" name="telpkontak" value="<?= $data_kontak_telp['isiKontak'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Whatsapp *</label>
                                                <input type="text" class="form-control" name="whatsappkontak" value="<?= $data_kontak_whatsapp['isiKontak'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Email *</label>
                                                <input type="text" class="form-control" name="emailkontak" value="<?= $data_kontak_email['isiKontak'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>Layanan</h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Layanan</label>
                                                <select name="idLayanan" id="layanan" class="form-control">
                                                    <?php foreach ($layanan as $key => $value) { ?>
                                                        <option <?= $value['idLayananinternet'] == $data_minat_layanan['idLayanan'] ? 'selected' : '' ?> value="<?= $value['idLayananinternet'] ?>"><?= $value['namaLayanan'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kecepatan</label>
                                                <select name="idLayanandetail" id="layanan" class="form-control">
                                                    <?php foreach ($layanan_detail as $key => $value) { ?>
                                                        <option <?= $value['idLayananinternetdetail'] == $data_minat_layanan['idLayanandetail'] ? 'selected' : '' ?> value="<?= $value['idLayananinternetdetail'] ?>"><?= $value['kecepatan'] ?> Mbps</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Sales</label>
                                                <select name="idSales" id="layanan" class="form-control">
                                                    <?php foreach ($data_sales as $key => $value) { ?>
                                                        <option <?= $value['idSales'] == $detail['idSales'] ? 'selected' : '' ?> value="<?= $value['idSales'] ?>"><?= $value['namaSales'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h5>Upload Foto</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body border border-1 rounded form-group">
                                    <label for="first-name-vertical">Foto Lokasi</label>
                                    <div class="row mt-2">
                                        <div class="col-1">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Detail
                                            </button>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="fotolokasi" id="file" onchange="Filevalidation()">
                                                <span class="text-danger" style="font-size: 10pt;" id="errorFile"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto Lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="/assets/media/<?= $detail['pathMedia'] ?>" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="/assets/js/BsMultiSelect.min.js"></script>
<script src="/assets/js/minat.js"></script>

<script>
    $(document).ready(function() {

        $('#koordinat').on("focusout", function() {
            var koordinat = $(this).val();
            if (!koordinat.includes(',')) {
                $('#error').html("Format Salah. Contoh: Latitude(koma)Longtitude ");
                document.getElementById("koordinat").value = '';
            } else {
                $('#error').html("");
            }
        });

        Filevalidation = () => {
            const fi = document.getElementById('file');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file >= 2048) {
                        $('#errorFile').html("File terlalu besar, file harus kurang dari 2mb");
                        fi.value = '';
                    } else {
                        document.getElementById('size').innerHTML = '<b>' +
                            file + '</b> KB';
                    }
                }
            }
        }
    });
</script>

</body>

</html>
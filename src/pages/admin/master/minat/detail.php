<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">

    <div class="card">
        <div class="card-content">

            <form class="form form-vertical" method="post" action="/minat/store" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-start">
                                <h3><?= $datas['namapemohon'] ?></h3>

                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-end">
                                <h4>Status: <span style="color: blue;"><?= $datas['statusText'] ?></span> </h4>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                    <!-- <div class="row mb-3">
                        <div class="col mb-3">
                            <div class="d-flex justify-content-start">
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-end">
                                <a href="/minat/<?= $datas['kodeMinat'] ?>/edit" class="btn btn btn-primary float-right"><i class="bi bi-pencil"></i> Edit </a>
                            </div>
                        </div>
                    </div> -->

                    <div class="form-body">
                        <h5></h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group2">
                                                <label for="first-name-vertical">Kode</label>
                                                <h6><?= $datas['kodeMinat'] ?></h6>
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
                                        <div class="col-3 ">
                                            <div class="form-group2">
                                                <label for="first-name-vertical">Provinsi</label>
                                                <h6><?= $datas['nameProvinsi'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-3 ">
                                            <div class="form-group2">
                                                <label for="first-name-vertical">Kabupaten</label>
                                                <h6><?= $datas['nameKabupaten'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-3 ">
                                            <div class="form-group2">
                                                <label for="first-name-vertical">Kecamatan</label>
                                                <h6><?= $datas['nameKecamatan'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-3 mb-3 ">
                                            <div class="form-group2">
                                                <label for="first-name-vertical">Kelurahan</label>
                                                <h6><?= $datas['nameKelurahan'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-3 ">
                                            <div class="form-group2">
                                                <label for="first-name-vertical">Kode Pos</label>
                                                <h6><?= $datas['kodepos'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group2">
                                                <label for="first-name-vertical">RT/RW</label>
                                                <h6><?= $datas['rt'] . "/" .  $datas['rw'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-5 mb-3">
                                            <div class="form-group2">
                                                <label for="first-name-vertical">Koordinat</label>
                                                <h6><?= $datas['latitude'] . "," .  $datas['longtitude'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group2">
                                                <label for="first-name-vertical">Alamat</label>
                                                <h6><?= $datas['alamat'] ?></h6>
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
                                                <label for="first-name-vertical">No. Telp</label>
                                                <h6><?= $data_kontak_telp['isiKontak'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Whatsapp</label>
                                                <h6><?= $data_kontak_whatsapp['isiKontak'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Email</label>
                                                <h6><?= $data_kontak_email['isiKontak'] ?></h6>
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
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Layanan</label>
                                                <h6><?= $data_minat_layanan['namaLayanan'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kecepatan</label>
                                                <h6><?= $data_minat_layanan['kecepatan'] ?> Mbps</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Sales</label>
                                                <h6><?= $datas['nameSales'] == NULL ? $datas['nameReseller'] : $datas['nameSales'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>Foto Lokasi</h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="gallery">
                                                <figure>
                                                    <img src="/assets/media/<?= $datas['pathMedia'] ?>" class="img-fluid" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if ($datas['keterangan'] != NULL) { ?>
                            <h5>Alasan Pembatalan</h5>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body border border-1 rounded">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h6>
                                                        <?= $datas['keterangan'] ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>



                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="/minat" class="btn btn-secondary me-1">CLose</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>

<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="/assets/js/BsMultiSelect.min.js"></script>
<script src="/assets/js/minat.js"></script>
<script src="/assets/js/main.js"></script>

<!-- POPUP -->
<!-- <script>
    popup = {
        init: function() {
            $('figure').click(function() {
                popup.open($(this));
            });

            $(document).on('click', '.popup img', function() {
                return false;
            }).on('click', '.popup', function() {
                popup.close();
            })
        },
        open: function($figure) {
            $('.gallery').addClass('pop');
            $popup = $('<div class="popup" />').appendTo($('body'));
            $fig = $figure.clone().appendTo($('.popup'));
            $bg = $('<div class="bg" />').appendTo($('.popup'));
            // $close = $('<div class="close"><svg><use xlink:href="#close"></use></svg></div>').appendTo($fig);
            $shadow = $('<div class="shadow" />').appendTo($fig);
            src = $('img', $fig).attr('src');
            $shadow.css({
                backgroundImage: 'url(' + src + ')'
            });
            $bg.css({
                backgroundImage: 'url(' + src + ')'
            });
            setTimeout(function() {
                $('.popup').addClass('pop');
            }, 10);
        },
        close: function() {
            $('.gallery, .popup').removeClass('pop');
            setTimeout(function() {
                $('.popup').remove()
            }, 100);
        }
    }

    popup.init()
</script> -->


</body>

</html>
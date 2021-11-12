<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Data Minat</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 10px;"></div>
                        <a type="button" class="btn btn-sm btn-primary mb-1" href="/minat/create"><i class="fas fa-plus"></i> Tambah Data </a>
                        <table class="table " id="table1">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Kode Minat</td>
                                    <td>Tanggal</td>
                                    <td>Nama</td>
                                    <td>Layanan</td>
                                    <td>Alamat</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datas as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><a href="/minat/<?= $value['kodeMinat'] ?>"><?= $value['kodeMinat'] ?></a></td>
                                        <td><?= date('d-m-Y', strtotime($value['createdAt'])) ?></td>
                                        <td><?= $value['namapemohon'] ?></td>
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td><?= $value['alamat'] ?></td>
                                        <td><?= $value['statusText'] ?></td>
                                        <td>

                                            <a class=" dropdown-toggle" style="font-size: 11pt;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="font-size: 10pt;">
                                                <li><a href="/minat/<?= $value['kodeMinat'] ?>" class=" dropdown-item text-warning"><i class="fas fa-eye"></i> Detail</a></li>
                                                <li><a href="/minat/<?= $value['kodeMinat'] ?>/edit" class="dropdown-item text-primary"><i class="fas fa-edit"></i> Edit</a></li>

                                                <?php if ($_SESSION['idRole'] == 'admin-010') { ?>
                                                    <li><a href="#" class="dropdown-item text-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="<?= $value['kodeMinat'] ?>"><i class="fas fa-user-slash"></i> Hapus</a></li>

                                                <?php } ?>

                                            </ul>

                                            <!-- <div class="btn-group">
                                                <a href="/minat/<?= $value['kodeMinat'] ?>" class="btn btn-sm btn-light text-warning"><i class="fas fa-eye"></i></a>
                                                <a href="/minat/<?= $value['kodeMinat'] ?>/edit" class="btn btn-sm btn-light text-primary"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm btn-light text-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="<?= $value['kodeMinat'] ?>"><i class="fas fa-user-slash"></i></a>
                                            </div> -->
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin?
            </div>
            <div class="modal-footer">
                <a href="" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                <a href="" class="btn btn-danger btn-hapus-modal">Hapus</a>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin?
            </div>
            <div class="modal-footer">
                <a href="" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                <a href="" class="btn btn-danger btn-hapus-modal">Hapus</a>
            </div>
        </div>
    </div>
</div>


<!-- Modal Riwayat -->
<div class="modal fade" id="riwayat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="riwayatLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="riwayatLabel">Riwayat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table " id="table1">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Deskripsi</td>
                            <td>Tanggal</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Contoh</td>
                            <td>1-10-2010</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>

<script src="/assets/js/main.js"></script>
<script src="/assets/js/minat.js"></script>

</body>

</html>
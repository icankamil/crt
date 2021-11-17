<header class='mb-3' style="    box-shadow: 0 1px 3px #bdbdbd;">
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item dropdown me-1">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bi bi-envelope bi-sub fs-4 text-gray-600'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Mail</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">No new mail</a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Notifications</h6>
                            </li>
                            <li><a class="dropdown-item">No notification available</a></li>
                        </ul>
                    </li> -->
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-black-600" style="color: black;"><?= $_SESSION['_sf2_attributes']['namaUser'] ?></h6>
                                <p class="mb-0 text-sm text-black-600" style="color: black;"><?= $_SESSION['_sf2_attributes']['namaRole'] ?></p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <!-- <img src="assets/images/faces/1.jpg"> -->
                                    <i class="fas fa-user-circle" style="font-size: 30pt;color: #737881;"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">

                        <!-- <li>
                            <a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                Edit Password</a>
                        </li> -->
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li> -->
                        <li><a class="dropdown-item" href="/admin/logout"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active" style="    box-shadow: 1px 0 6px #636161;">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="/minat"><img src="/assets/images/logo/logogram-urban-acess.png" class="img-fluid" alt="Logo" srcset="" style="width: 72%;    margin-left: 2rem;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="btn for-hover text-light sidebar-hide d-xl-none d-block" style="position: absolute;top: 0rem;right: 0.5rem;font-size: 16pt;"><i class="fas fa-times"></i></a>
                </div>
            </div>
        </div>
        <hr style="width: 16rem;border-top: 1px solid #1c232e;margin: auto;">
        <div class="sidebar-menu">
            <ul class="menu">
                <!-- <li class="sidebar-title">Menu</li> -->

                <?php if ($isPermited($GLOBALS['userPermissions'], ['minat', 'list-minat-per-status', 'request-survey-vendor', 'input-hasil-survey-soft', 'konfirmasi-hasil-survey', 'atur-tanggal-onsite', 'input-hasil-survey-onsite', 'registrasi-user', 'instalasi', 'aktivasi', 'aktif'], 'required-one')) { ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link  <?= strpos($GLOBALS['url'], '/minat')  !== false || strpos($GLOBALS['url'], '-survey')  !== false || strpos($GLOBALS['url'], '-onsite')  !== false || strpos($GLOBALS['url'], '-minat')  !== false || strpos($GLOBALS['url'], '/instalasi')  !== false || strpos($GLOBALS['url'], '/instalasi')  !== false || strpos($GLOBALS['url'], '/aktivasi')  !== false || strpos($GLOBALS['url'], '/aktif')  !== false || strpos($GLOBALS['url'], '/registrasi-user-minat')  !== false ? 'oncom' : ''; ?>">
                            <i class="fas fa-file-alt"></i>
                            <span>Minat</span>
                            <i class="icon-dropdown2 fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu" style="<?= $GLOBALS['aliasRole'] == 'admin' ? 'display: none;' : 'display: block;' ?>">
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['minat'], 'required-one')) { ?>
                                <li class="submenu-item">
                                    <a href="/minat">Data Minat</a>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['list-minat-per-status'], 'required-one')) { ?>
                                <li class="submenu-item">
                                    <a href="/minat-status/1">List Minat Per Status</a>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['request-survey-vendor', 'input-hasil-soft-survey', 'konfirmasi-hasil-survey'], 'required-one')) { ?>
                                <li class="sidebar-item has-sub submenu-item">
                                    <a href="form-layout.html" class="sidebar-link">
                                        <i class="icon-dropdown2 fas fa-caret-down"></i>
                                        <span style="margin-left: 0rem;">Data Soft Survey</span>
                                    </a>
                                    <ul class="submenu" style="<?= $GLOBALS['aliasRole'] == 'admin' ? 'display: none;' : 'display: block;' ?>">
                                        <?php if ($isPermited($GLOBALS['userPermissions'], ['request-survey-vendor'], 'required-one')) { ?>
                                            <li class="submenu-item ">
                                                <a href="/request-survey-vendor">Request Survey Vendor</a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($isPermited($GLOBALS['userPermissions'], ['input-hasil-soft-survey'], 'required-one')) { ?>
                                            <li class="submenu-item ">
                                                <a href="/input-hasil-soft-survey">Input Hasil Survey</a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($isPermited($GLOBALS['userPermissions'], ['konfirmasi-hasil-survey'], 'required-one')) { ?>
                                            <li class="submenu-item ">
                                                <a href="/konfirmasi-hasil-survey">Konfirmasi Hasil Survey</a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['atur-tanggal-onsite', 'input-hasil-survey-onsite'], 'required-one')) { ?>
                                <li class="sidebar-item has-sub submenu-item">
                                    <a href="form-layout.html" class="sidebar-link">
                                        <i class="icon-dropdown2 fas fa-caret-down"></i>
                                        <span style="margin-left: 0rem;">Survey On Site</span>
                                    </a>
                                    <ul class="submenu" style="<?= $GLOBALS['aliasRole'] == 'admin' ? 'display: none;' : 'display: block;' ?>">
                                        <?php if ($isPermited($GLOBALS['userPermissions'], ['atur-tanggal-onsite'], 'required-one')) { ?>
                                            <li class="submenu-item ">
                                                <a href="/atur-tanggal-onsite">Atur Tanggal On Site</a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($isPermited($GLOBALS['userPermissions'], ['input-hasil-survey-onsite'], 'required-one')) { ?>
                                            <li class="submenu-item ">
                                                <a href="/input-hasil-survey-onsite">Input Hasil Survey</a>
                                            </li>
                                        <?php } ?>
                                        <!-- <?php if ($isPermited($GLOBALS['userPermissions'], ['konfirmasi-hasil-survey-onsite'], 'required-one')) { ?>
                                            <li class="submenu-item ">
                                                <a href="/konfirmasi-hasil-survey-onsite">Konfirmasi Hasil Survey</a>
                                            </li>
                                        <?php } ?> -->
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['registrasi-user'], 'required-one')) { ?>
                                <li class="submenu-item">
                                    <a href="/registrasi-user-minat">Registrasi User</a>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['instalasi'], 'required-one')) { ?>
                                <li class="submenu-item">
                                    <a href="/instalasi">Instalasi</a>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['aktivasi'], 'required-one')) { ?>
                                <li class="submenu-item">
                                    <a href="/aktivasi">Aktivasi</a>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['aktif'], 'required-one')) { ?>
                                <li class="submenu-item">
                                    <a href="/aktif">Start Billing</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($isPermited($GLOBALS['userPermissions'], ['data-user-registrasi'], 'required-one')) { ?>
                    <li class="sidebar-item <?= $GLOBALS['url'] == '/registrasi-user' ? 'oncom' : ''; ?>">
                        <a href="/registrasi-user" class='sidebar-link'>
                            <i class="fas fa-users"></i>
                            <span>Data User Registrasi</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($isPermited($GLOBALS['userPermissions'], ['layanan-internet', 'kecepatan-internet'], 'required-one')) { ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link  <?= strpos($GLOBALS['url'], '/layanan-internet')  !== false || strpos($GLOBALS['url'], '/kecepatan-internet')  !== false  ? 'oncom' : ''; ?>">
                            <i class="fas fa-wifi"></i>
                            <span>Layanan Internet</span>
                            <i class="icon-dropdown2 fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu" style="<?= $GLOBALS['aliasRole'] == 'admin' ? 'display: none;' : 'display: block;' ?>">
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['layanan-internet'], 'required-one')) { ?>
                                <li class="submenu-item ">
                                    <a href="/layanan-internet">Layanan Internet</a>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['kecepatan-internet'], 'required-one')) { ?>
                                <li class="submenu-item ">
                                    <a href="/kecepatan-internet">Kecepatan Internet</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($isPermited($GLOBALS['userPermissions'], ['urban-lite', 'urban-max', 'urban-ultimate'], 'required-one')) { ?>
                    <li class="sidebar-item has-sub ">
                        <a href="#" class="sidebar-link  <?= strpos($GLOBALS['url'], '/urban')  !== false  ? 'oncom' : ''; ?>">
                            <i class="bi bi-people-fill"></i>
                            <span>Data User</span>
                            <i class="icon-dropdown2 fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu" style="<?= $GLOBALS['aliasRole'] == 'admin' ? 'display: none;' : 'display: block;' ?>">
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['urban-lite'], 'required-one')) { ?>
                                <li class="submenu-item ">
                                    <a href="/urban-lite">UrbanLite</a>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['urban-max'], 'required-one')) { ?>
                                <li class="submenu-item ">
                                    <a href="/urban-max">UrbanMax</a>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['urban-ultimate'], 'required-one')) { ?>
                                <li class="submenu-item ">
                                    <a href="/urban-ultimate">UrbanUltimate</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($isPermited($GLOBALS['userPermissions'], ['reseller', 'sales-perorangan'], 'required-one')) { ?>
                    <li class="sidebar-item has-sub ">
                        <a href="form-layout.html" class="sidebar-link <?= $GLOBALS['url'] == '/reseller' || $GLOBALS['url'] == '/sales-perorangan'  ? 'oncom' : ''; ?>">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Data Sales</span>
                            <i class="icon-dropdown2 fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu" style="<?= $GLOBALS['aliasRole'] == 'admin' ? 'display: none;' : 'display: block;' ?>">
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['reseller'], 'required-one')) { ?>
                                <li class="submenu-item ">
                                    <a href="/reseller">Reseller</a>
                                </li>
                            <?php } ?>
                            <?php if ($isPermited($GLOBALS['userPermissions'], ['sales-perorangan'], 'required-one')) { ?>
                                <li class="submenu-item ">
                                    <a href="/sales-perorangan">Sales Perorangan</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($isPermited($GLOBALS['userPermissions'], ['data-vendor'], 'required-one')) { ?>
                    <li class="sidebar-item <?= strpos($GLOBALS['url'], '/vendor')  !== false ? 'oncom' : ''; ?>">
                        <a href="/vendor" class='sidebar-link'>
                            <i class="fas fa-store"></i>
                            <span>Data Vendor</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($isPermited($GLOBALS['userPermissions'], ['forecast'], 'required-one')) { ?>
                    <li class="sidebar-item <?= $GLOBALS['url'] == '/forecast'  ? 'oncom' : ''; ?> ">
                        <a href="/forecast" class='sidebar-link'>
                            <i class="bi bi-file-text-fill"></i>
                            <span>Forecast</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($isPermited($GLOBALS['userPermissions'], ['riwayat'], 'required-one')) { ?>
                    <li class="sidebar-item <?= $GLOBALS['url'] == '/riwayat'  ? 'oncom' : ''; ?> ">
                        <a href="/riwayat" class='sidebar-link'>
                            <i class="fas fa-history"></i>
                            <span>Riwayat</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($isPermited($GLOBALS['userPermissions'], ['user-management'], 'required-one')) { ?>
                    <li class="sidebar-item <?= $GLOBALS['url'] == '/user-management'  ? 'oncom' : ''; ?> ">
                        <a href="/user-management" class='sidebar-link'>
                            <i class="fas fa-users-cog"></i>
                            <span>User Management</span>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
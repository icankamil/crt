<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <!-- Link feater icon -->
  <script src="https://unpkg.com/feather-icons"></script>
  <!-- link css -->
  <link rel="stylesheet" type="text/css" href="assets/css/Login/logincss.css">

  <title>BPNB 2021</title>
</head>

<body> 
  <!-- 
    <div class="container">
      <div class="row justify-content-lg-center">
        <div class="col col-sm-6">
          <div class="card">
            <p>p</p>
          </div>
        </div>
        <div class="col col-sm-6">
          <img src="assets/media/asset2.png" class="rounded d-block w-30 h-50">
        </div>
        
      </div>
      
    </div> -->

  <!-- <div class="container">
      <div class="row ">
        <div class="col-sm-6">
          <div class="card shadow">
            <h1>SIMBADAK</h1>
            <form>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
        <div class="col col-sm-6">
          <img src="assets/media/asset2.png" class="rounded w-30 h-50 align-middle">
        </div>
      </div>
    </div> -->
  <div class="position-absolute top-50 start-50 translate-middle">
    <div class="row">
      <div class="col-md-6 .d-none .d-sm-12 .d-md-none">
        <div class="card shadow w-30 h-100">
          <div class="container">
		        <img src="assets/media/logo.png" class="w-25 d-block mx-auto pt-3">
            <h3 class="text-center mt-1">SIMBADAK</h3>
			      <h6 class="text-center">Sistem Informasi Basis Data Kebudayaan</h6>
            <hr class="text-warning w-70 mb-3">
            <form method="post" action="login/process">
              <label for="">Masuk Sebagai:</label>
              <div class="row">
                  <div class="col-md-5 col-sm-12 col-xs-12">
                    <input type="radio" name="opsi_login" value="pegawai" checked>&nbsp;&nbsp;Pegawai
                  </div>
                  <div class="col-md-5 col-sm-12 col-xs-12">
                    <input type="radio" name="opsi_login" value="eksternal">&nbsp;&nbsp;Eksternal
                  </div>
                </div>
                <div class="input-group mt-3 mb-2">
                <span class="input-group-text" id="inputGroup-sizing-default">
                  <i data-feather="user"></i>
                </span>
                <input type="text" name="nip_nik" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="NIP/NIK">
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">
                  <i data-feather="key"></i>
                </span>
                <input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="password">
              </div>
              <button type="submit" class="btn btn-success w-100" name="login" value="login">Masuk</button>
              <?php if (count($errors) > 0) { ?>
                <ul>
                  <?php foreach ($errors as $error) { ?>
                    <li><?= $error ?> </li>
                  <?php } ?>
                </ul>
              <?php } ?>
              <!-- <a href="#" type="button" class="btn text-secondary" id="forget">lupa password?</a> -->
            </form>
            <p class="pt-3 text-warning small text-center">--- <span class="text-dark">Belum punya akun?</span> ---</p>
            <a href="register-eksternal" type="submit" class="btn btn-outline-warning w-100 mb-4">Sign-up</a>
            <a href="#" type="button" class="btn btn-secondary btn-sm w-50 float-start mb-3" id="hlmn">← Halaman depan</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6" id="pict">
        <div class="card w-30 h-100">
      		<img src="assets/media/asset2.png" class="card-img h-100" alt="...">
        <div class="card-img-overlay">
          <div class="position-absolute top-50 start-50 translate-middle">
           <img src="assets/media/kemdikbud.png" class="w-50 d-block mx-auto mb-3">
            <h1 class="card-title text-center text-white">BPNB</h1>
            <h6 class="card-text text-center text-white">Badan Pelestarian Nilai Budaya<br>Provinsi Jawa Barat</h6>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript; choose one of the two! -->
  <!-- script feather icon -->
  <script>
    feather.replace()
  </script>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>
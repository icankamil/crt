<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Intenal Urban Access</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/mazer/bootstrap.css">
  <link rel="stylesheet" href="assets/css/mazer/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/mazer/app.css">
  <link rel="stylesheet" href="assets/css/mazer/auth.css">
</head>

<body>
  <div id="auth">

    <div class="row h-100">
      <div class="col-lg-4 col-12">
        <div id="auth-left" style="padding-bottom: 10pt;">
          <div class="auth-logo">
            <a href="/admin"><img src="assets/images/logo/logo-urban.png" alt="Logo" style="width: 84%; height: auto;margin-left: auto;margin-right: auto;display: block;"></a>
          </div>

          <form action="/admin/login" method="POST">
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="text" class="form-control form-control-xl" placeholder="Username" name="username">
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <div class="form-check form-check-lg d-flex align-items-end">
              <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-gray-600" for="flexCheckDefault">
                Keep me logged in
              </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
          </form>
        </div>
        <?php if (count($errors) > 0) { ?>
          <?php foreach ($errors as $error) { ?>
            <div class="alert alert-danger w-50 mx-auto alert-dismissible fade show" role="alert">
              <strong><?= $error ?></strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
      <div class="col-lg-8 d-none d-lg-block">
        <div id="auth-right">

        </div>
      </div>
    </div>

  </div>
</body>

</html>
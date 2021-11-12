
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>

<body>
    <h3>Registrasi</h3>
     <?php if(count($errorsPassword) > 0) { ?>
              <ul>
              <?php foreach ($errorsPassword as $error) { ?>
                <li><?= $error ?> </li>
              <?php } ?>
              </ul>
            </div>
            <?php } ?>
    <form method="post" action="process-register-eksternal">
    	<table>
    	<tr>
         <td>
             Username :
        <input type="text" name="namaUser">
         </td>   
         </tr>
         <tr>
         <td>
             NIK :
        <input type="text" name="nik">
         </td>   
         </tr>
         <tr>
             <td>
             Password :
        <input type="Password" name="passwordUser">
         </td>
         </tr>
        <tr>
            <td>
                Confirm Password :
            </td>
        </tr>
        <tr>
            <td>
                <input type="password" name="cPassword">
            </td>
        </tr>
         <tr>
         <td>
             <button type="submit" name="register"> Registrasi </button>
         </td>
        </tr>
        </table>
    </form>
</body>
</html>
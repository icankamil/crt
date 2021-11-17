<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<body>
    <h1>FORM LOGIN</h1>
    <?php if (count($errors) > 0) { ?>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?= $error ?> </li>
            <?php } ?>
        </ul>
        </div>
    <?php } ?>
    <form method="post" action="login/process">
        <tr>
            <td>
                NIP/NIK :
            </td>
            <td>
                <input type="text" name="nip_nik">
            </td>
        </tr>
        <tr>
            <td>
                Password :
            </td>
            <td>
                <input type="password" name="password">
            </td>
        </tr>
        <tr>
            <select name="opsi_login">
                <option value="pegawai" name="pegawai">
                    pegawai
                </option>
                <option value="eksternal" name="eksternal">
                    eksternal
                </option>
            </select>

        </tr>
        <tr>
            <button name="login" type="submit" value="login">Login </button>
        </tr>

    </form>
</body>

</html>
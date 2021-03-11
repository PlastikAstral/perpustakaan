<?php
	session_start();

	if ( isset($_SESSION["login"]) ) {
		header('location: module/index.php');
	}

	include 'config/function.php';

	if ( isset($_POST["submit"]) ) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		$result = mysqli_query($conn, "SELECT * FROM tbluser WHERE username = '$username'");

		// cek username
		if ( mysqli_num_rows($result) === 1 ) {
			// cek password
			$row = mysqli_fetch_assoc($result);
			if (password_verify($password, $row["password"]) ) {
				$_SESSION["login"] = true;
				$_SESSION["iduser"] = $row['id'];
				$_SESSION["datauser"] = "$username";
				header('location: module/index.php');
			} else {
				echo "
					<script>
						alert('Password Salah!');
					</script>
				";
			}
		} else {
			echo "
				<script>
					alert('Username Salah!');
				</script>
			";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Aplikasi Perpustakaan</h1>
                    <p class="auth-subtitle mb-5">Perguruan Mathla'ul Anwar Pusat</p>
                    <br>
                    <p class="auth-subtitle mb-2">Log In</p>

                    <form method="POST"  action="">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="username" class="form-control form-control-xl" placeholder="Username" autocomplete="off" type="text" name="text">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="password" class="form-control form-control-xl" placeholder="Password" autocomplete="off"  type="password" name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7">
                <div id="auth-right">
                </div>
            </div>
        </div>

    </div>
</body>

</html>
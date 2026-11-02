<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DISPERINDAG</title>
    <link rel="stylesheet" href="<?= base_url('css/style_login.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <div class="header">
                <img src="<?= base_url('images/logo.png'); ?>" alt="Logo Disperindag" class="logo">
                <h2>DISPERINDAG</h2>
            </div>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('user/register/process') ?>" method="post">
                <input type="text" name="username" placeholder="Username" required>

                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fa-solid fa-eye" id="togglePassword" onclick="togglePassword('password', 'togglePassword')"></i>
                </div>

                <div class="password-container">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <i class="fa-solid fa-eye" id="toggleConfirmPassword" onclick="togglePassword('confirm_password', 'toggleConfirmPassword')"></i>
                </div>
                <p><a href="<?= base_url('user/login') ?>">Sudah punya akun? Login</a></p>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            var passwordInput = document.getElementById(inputId);
            var toggleIcon = document.getElementById(iconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>
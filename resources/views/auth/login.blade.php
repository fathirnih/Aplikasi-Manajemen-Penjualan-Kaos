<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Premium - Sistem Kami</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-deep: #000B58;
            --primary-medium: #0046FF;
            --primary-light: #3396D3;
            --accent-gold: #D4AF37;
            --text-light: #ffffff;
            --text-dark: #1e293b;
            --shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--primary-deep), var(--primary-medium));
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(51, 150, 211, 0.1) 0%, rgba(0, 11, 88, 0) 70%);
            top: -50%;
            left: -50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-30px, -30px) rotate(180deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 1;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-deep), var(--primary-medium));
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
            top: -100px;
            right: -100px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), transparent);
            bottom: -80px;
            left: -80px;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--accent-gold), #FFD700);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(to right, var(--text-light), #e0e0e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-left h1 {
            font-size: 32px;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
            font-weight: 700;
        }

        .login-left p {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .features {
            list-style: none;
            margin-top: 30px;
        }

        .features li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .features i {
            color: var(--accent-gold);
            margin-right: 10px;
            font-size: 16px;
        }

        .login-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
            color: var(--text-dark);
        }

        .login-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .login-header h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(to right, var(--primary-medium), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-header p {
            color: var(--primary-light);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--primary-deep);
        }

        .form-input {
            width: 100%;
            padding: 15px 45px 15px 15px;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius);
            font-size: 14px;
            transition: var(--transition);
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-medium);
            box-shadow: 0 0 0 3px rgba(0, 70, 255, 0.1);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 40px;
            color: var(--primary-light);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: var(--primary-medium);
        }

        .forgot-password {
            color: var(--primary-medium);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
        }

        .forgot-password:hover {
            color: var(--primary-deep);
            text-decoration: underline;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-medium), var(--primary-light));
            color: white;
            border: none;
            border-radius: var(--radius);
            padding: 15px 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            box-shadow: 0 4px 15px rgba(0, 70, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 70, 255, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-login:hover::after {
            left: 100%;
        }

        .status-message {
            padding: 15px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }

        .error-message i {
            margin-right: 5px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            padding: 0 15px;
            color: var(--text-light);
            font-size: 14px;
            color: var(--primary-light);
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: var(--primary-medium);
            border: 1px solid #e2e8f0;
            transition: var(--transition);
            cursor: pointer;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: var(--primary-deep);
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .login-left, .login-right {
                padding: 40px 30px;
            }
            
            .login-left h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="logo-text">Manajemen Penjualan Kaos</div>
            </div>
            <h1>Selamat Datang di Sistem Penjualan Kaos</h1>
            <p>Masuk ke akun  Anda untuk mengakses fitur-fitur web di halaman dashboard.</p>
            
            <ul class="features">
                <li><i class="fas fa-shield-alt"></i> Keamanan tingkat enterprise</li>
                <li><i class="fas fa-bolt"></i> Performa tinggi dan responsif</li>
                <li><i class="fas fa-star"></i> Antarmuka premium yang intuitif</li>
                <li><i class="fas fa-headset"></i> Dukungan pelanggan 24/7</li>
            </ul>
        </div>
        
        <div class="login-right">
            <div class="login-header">
                <h2>Masuk ke Akun</h2>
                <p>Masukkan data Anda untuk mengakses dashboard</p>
            </div>
            
        

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input id="email" class="form-input" type="email" name="email" required autofocus autocomplete="username" />
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="error-message">
                        <!-- Error messages would appear here -->
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">Kata Sandi</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="error-message">
                        <!-- Error messages would appear here -->
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="form-options">
                    <label class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>

                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk ke Akun
                </button>

                <div class="divider">
                    <span>Atau lanjutkan dengan</span>
                </div>

                <div class="social-login">
                    <div class="social-btn">
                        <i class="fab fa-google"></i>
                    </div>
                    <div class="social-btn">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-btn">
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Tambahkan efek animasi pada input saat fokus
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.color = '#0046FF';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.input-icon').style.color = '#3396D3';
            });
        });
    </script>
</body>
</html>
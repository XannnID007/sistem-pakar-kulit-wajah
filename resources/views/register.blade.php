<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Skins</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Background Animations */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: drift 20s linear infinite;
        }

        @keyframes drift {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(-50px, -50px) rotate(360deg);
            }
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 10;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .welcome-text {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #374151;
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #374151;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: #9ca3af;
            font-size: 0.95rem;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            font-size: 1rem;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
        }

        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: #e5e7eb;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak .strength-fill {
            width: 33%;
            background: #ef4444;
        }

        .strength-medium .strength-fill {
            width: 66%;
            background: #f59e0b;
        }

        .strength-strong .strength-fill {
            width: 100%;
            background: #10b981;
        }

        .btn-primary {
            width: 100%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            text-align: center;
            color: #9ca3af;
            margin: 1.5rem 0;
            position: relative;
            font-size: 0.9rem;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 1rem;
        }

        .login-link {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #5a67d8;
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            border-left: 4px solid #ef4444;
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .alert ul {
            margin: 0;
            padding-left: 1rem;
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border-left-color: #10b981;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-container {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .logo {
                font-size: 1.8rem;
            }
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .form-validation {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
            font-size: 0.8rem;
        }

        .validation-icon {
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .valid {
            color: #10b981;
        }

        .invalid {
            color: #ef4444;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="logo-section">
            <div class="logo">
                <i class="fas fa-leaf"></i>
                Skins
            </div>
            <p class="welcome-text">Bergabung dengan kami!</p>
            <p class="subtitle">Buat akun untuk mulai diagnosa kulit</p>
        </div>

        @if ($errors->any())
            <div class="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" id="name" name="name" class="form-control"
                        placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autocomplete="name">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" id="email" name="email" class="form-control"
                        placeholder="Masukkan alamat email" value="{{ old('email') }}" required autocomplete="email">
                </div>
                <div class="form-validation" id="emailValidation" style="display: none;">
                    <div class="validation-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <span>Email valid</span>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Buat password yang kuat" required autocomplete="new-password"
                        oninput="checkPasswordStrength()">
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('password', this)"></i>
                </div>
                <div class="password-strength">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <small id="strengthText">Minimal 6 karakter</small>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Ulangi password Anda" required autocomplete="new-password"
                        oninput="checkPasswordMatch()">
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('password_confirmation', this)"></i>
                </div>
                <div class="form-validation" id="passwordMatch" style="display: none;">
                    <div class="validation-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <span>Password cocok</span>
                </div>
            </div>

            <button type="submit" class="btn-primary" id="registerBtn">
                <span class="btn-text">
                    <i class="fas fa-user-plus"></i>
                    Daftar Sekarang
                </span>
            </button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="login-link">
            Sudah punya akun?
            <a href="{{ route('login.form') }}">Masuk di sini</a>
        </div>
    </div>

    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            const strengthContainer = strengthBar.parentElement.parentElement;

            let strength = 0;
            let text = '';

            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            strengthContainer.className = 'password-strength';

            if (strength < 2) {
                strengthContainer.classList.add('strength-weak');
                text = 'Password lemah';
            } else if (strength < 4) {
                strengthContainer.classList.add('strength-medium');
                text = 'Password sedang';
            } else {
                strengthContainer.classList.add('strength-strong');
                text = 'Password kuat';
            }

            strengthText.textContent = text;
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchIndicator = document.getElementById('passwordMatch');

            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    matchIndicator.style.display = 'flex';
                    matchIndicator.className = 'form-validation valid';
                    matchIndicator.querySelector('span').textContent = 'Password cocok';
                    matchIndicator.querySelector('i').className = 'fas fa-check';
                } else {
                    matchIndicator.style.display = 'flex';
                    matchIndicator.className = 'form-validation invalid';
                    matchIndicator.querySelector('span').textContent = 'Password tidak cocok';
                    matchIndicator.querySelector('i').className = 'fas fa-times';
                }
            } else {
                matchIndicator.style.display = 'none';
            }
        }

        // Email validation
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value;
            const validation = document.getElementById('emailValidation');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email.length > 0 && emailRegex.test(email)) {
                validation.style.display = 'flex';
                validation.className = 'form-validation valid';
            } else if (email.length > 0) {
                validation.style.display = 'flex';
                validation.className = 'form-validation invalid';
                validation.querySelector('span').textContent = 'Format email tidak valid';
                validation.querySelector('i').className = 'fas fa-times';
            } else {
                validation.style.display = 'none';
            }
        });

        // Form submit animation
        document.getElementById('registerForm').addEventListener('submit', function() {
            const btn = document.getElementById('registerBtn');
            const btnText = btn.querySelector('.btn-text');

            btn.disabled = true;
            btnText.innerHTML = '<div class="loading"></div> Memproses...';
        });

        // Input focus animations
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>

</html>

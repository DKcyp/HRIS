<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - HRIS V2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .login-header i {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }
        .login-body {
            padding: 30px;
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78,115,223,0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #224abe 0%, #1a3a8f 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(78,115,223,0.4);
        }
        .login-footer {
            text-align: center;
            padding: 15px 30px 25px;
            color: #6c757d;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="card login-card">
        <div class="login-header">
            <i class="fas fa-building"></i>
            <h4 class="mb-0">HRIS V2</h4>
            <small class="opacity-75">Human Resource Information System</small>
        </div>
        <div class="login-body">
            <div id="loginAlert" class="alert d-none" role="alert"></div>
            <form id="loginForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-login btn-primary w-100" id="btnLogin">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </form>
        </div>
        <div class="login-footer">
            <small>&copy; 2026 HRIS V2. All rights reserved.</small>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('btnLogin');
            const alertBox = document.getElementById('loginAlert');

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
            alertBox.classList.add('d-none');

            try {
                const formData = new FormData(this);
                const res = await fetch('{{ route("login.post") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                const result = await res.json();

                if (result.success) {
                    alertBox.className = 'alert alert-success';
                    alertBox.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + result.message;
                    alertBox.classList.remove('d-none');
                    setTimeout(() => { window.location.href = result.redirect; }, 800);
                } else {
                    alertBox.className = 'alert alert-danger';
                    alertBox.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + result.message;
                    alertBox.classList.remove('d-none');
                }
            } catch(ex) {
                alertBox.className = 'alert alert-danger';
                alertBox.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Terjadi kesalahan, coba lagi';
                alertBox.classList.remove('d-none');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i> Login';
            }
        });
    </script>
</body>
</html>

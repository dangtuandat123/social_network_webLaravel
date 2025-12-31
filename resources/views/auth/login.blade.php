<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập | Social Media</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #3B82F6;
            --primary-dark: #2563EB;
            --bg-main: #F8FAFC;
            --text-primary: #1E293B;
            --text-muted: #94A3B8;
            --border-color: #E2E8F0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .auth-container {
            width: 100%;
            max-width: 420px;
        }
        
        .auth-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
        }
        
        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-logo i {
            font-size: 3rem;
            color: var(--primary);
        }
        
        .auth-logo h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 0.5rem;
        }
        
        .auth-logo p {
            color: var(--text-muted);
            margin: 0;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--text-primary);
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-muted);
        }
        
        .auth-footer a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
        }
        
        .auth-footer a:hover {
            text-decoration: underline;
        }
        
        .input-group-text {
            background: transparent;
            border-right: none;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-logo">
                <i class="ri-bubble-chart-fill"></i>
                <h1>Đăng nhập</h1>
                <p>Chào mừng bạn trở lại!</p>
            </div>
            
            @if($errors->any())
                <div class="alert alert-danger py-2">
                    @foreach($errors->all() as $error)
                        <div><i class="ri-error-warning-line me-1"></i>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-mail-line"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="you@example.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-lock-line"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">
                    <i class="ri-login-box-line me-1"></i> Đăng nhập
                </button>
            </form>
            
            <div class="auth-footer">
                Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
            </div>
        </div>
    </div>
</body>
</html>

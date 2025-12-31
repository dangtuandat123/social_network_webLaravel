<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', subject: app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Social Media | Mạng Xã Hội</title>

    <link rel="shortcut icon" href="{{ asset('template_assets/images/favicon.ico') }}" />
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Custom CSS Variables -->
    <style>
      :root {
        --primary: #6366F1;
        --primary-dark: #4F46E5;
        --primary-light: #818CF8;
        --secondary: #EC4899;
        --accent: #14B8A6;
        --success: #22C55E;
        --warning: #F59E0B;
        --danger: #EF4444;
        --bg-main: #F0F4FF;
        --bg-card: #FFFFFF;
        --text-primary: #1E293B;
        --text-secondary: #64748B;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --gradient-primary: linear-gradient(135deg, #6366F1 0%, #EC4899 100%);
        --gradient-secondary: linear-gradient(135deg, #14B8A6 0%, #6366F1 100%);
        --gradient-warm: linear-gradient(135deg, #F59E0B 0%, #EF4444 100%);
        --gradient-cool: linear-gradient(135deg, #06B6D4 0%, #8B5CF6 100%);
        --shadow-sm: 0 2px 8px rgba(99, 102, 241, 0.08);
        --shadow-md: 0 4px 20px rgba(99, 102, 241, 0.12);
        --shadow-lg: 0 8px 30px rgba(99, 102, 241, 0.15);
        --shadow-glow: 0 0 20px rgba(99, 102, 241, 0.25);
        --radius-sm: 10px;
        --radius-md: 14px;
        --radius-lg: 18px;
        --radius-xl: 24px;
      }
      
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      
      body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: var(--bg-main);
        background-image: 
          radial-gradient(at 20% 20%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
          radial-gradient(at 80% 80%, rgba(236, 72, 153, 0.08) 0px, transparent 50%),
          radial-gradient(at 50% 50%, rgba(20, 184, 166, 0.05) 0px, transparent 50%);
        color: var(--text-primary);
        line-height: 1.6;
        min-height: 100vh;
      }
      
      /* Button Styles */
      .btn-primary {
        background: var(--gradient-primary);
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
      }
      .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        background: var(--gradient-primary);
      }
      
      .btn-outline-primary {
        color: var(--primary);
        border: 2px solid var(--primary);
        border-radius: var(--radius-sm);
        font-weight: 600;
        background: transparent;
        transition: all 0.3s ease;
      }
      .btn-outline-primary:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        transform: translateY(-2px);
      }
      
      /* Card Styles */
      .card {
        background: var(--bg-card);
        border: none;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
      }
      .card:hover {
        box-shadow: var(--shadow-lg);
      }
      
      /* Form Styles */
      .form-control, .form-select {
        border: 2px solid var(--border-color);
        border-radius: var(--radius-sm);
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: rgba(255,255,255,0.8);
      }
      .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        background: white;
      }
      
      /* Modal Styles */
      .modal-content {
        border: none;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        backdrop-filter: blur(10px);
      }
      
      /* Alert Styles */
      .alert {
        border: none;
        border-radius: var(--radius-md);
        font-weight: 500;
      }
      .alert-success {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(20, 184, 166, 0.15) 100%);
        color: #15803D;
      }
      .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(236, 72, 153, 0.15) 100%);
        color: #DC2626;
      }
      
      /* Utilities */
      .text-muted { color: var(--text-muted) !important; }
      .bg-light { background: var(--bg-main) !important; }
      
      /* Gradient Text */
      .text-gradient {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }
      
      /* Animations */
      @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
      }
      
      @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 5px rgba(99, 102, 241, 0.3); }
        50% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.5); }
      }
      
      /* Scrollbar */
      ::-webkit-scrollbar { width: 8px; }
      ::-webkit-scrollbar-track { background: var(--bg-main); }
      ::-webkit-scrollbar-thumb { 
        background: var(--gradient-primary); 
        border-radius: 10px; 
      }
      
      /* Responsive */
      @media (max-width: 768px) {
        .container { padding: 0 1rem; }
      }
    </style>
  </head>
  <body>
    @include('layouts.header')
    
    <main>
      @yield('content')
    </main>
    
    @include('layouts.footer')

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>


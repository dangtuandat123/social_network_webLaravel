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
        --primary: #3B82F6;
        --primary-dark: #2563EB;
        --secondary: #8B5CF6;
        --success: #10B981;
        --warning: #F59E0B;
        --danger: #EF4444;
        --bg-main: #F8FAFC;
        --bg-card: #FFFFFF;
        --text-primary: #1E293B;
        --text-secondary: #64748B;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
      }
      
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      
      body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: var(--bg-main);
        color: var(--text-primary);
        line-height: 1.6;
        min-height: 100vh;
      }
      
      /* Button Styles */
      .btn-primary {
        background: var(--primary);
        border-color: var(--primary);
        border-radius: var(--radius-sm);
        font-weight: 500;
        transition: all 0.2s ease;
      }
      .btn-primary:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-1px);
      }
      
      .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
        border-radius: var(--radius-sm);
        font-weight: 500;
      }
      .btn-outline-primary:hover {
        background: var(--primary);
        border-color: var(--primary);
      }
      
      /* Card Styles */
      .card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
      }
      
      /* Form Styles */
      .form-control, .form-select {
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
      }
      .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
      }
      
      /* Modal Styles */
      .modal-content {
        border: none;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
      }
      
      /* Utilities */
      .text-muted { color: var(--text-muted) !important; }
      .bg-light { background: var(--bg-main) !important; }
      
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


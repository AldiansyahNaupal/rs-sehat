<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'RS Sehat' }} - Rumah Sakit Terdepan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|poppins:300,400,500,600,700" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- NProgress Loading Bar -->
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Scripts and Styles -->
    <link rel="stylesheet" href="/build/assets/app-DOkwvqPn.css" onerror="this.onerror=null; this.href='https://cdn.tailwindcss.com';">
    
    <!-- Fallback TailwindCSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Essential custom CSS inline -->
    <style>
        .container-custom{max-width:1200px;margin:0 auto;padding:0 1rem}
        .section-padding{padding:4rem 0}
        @media(min-width:768px){.section-padding{padding:6rem 0}}
        .btn-primary{background-color:#3b82f6;color:#fff;padding:0.75rem 1.5rem;border-radius:0.5rem;text-decoration:none;display:inline-block;transition:all 0.3s ease;border:none;cursor:pointer}
        .btn-primary:hover{background-color:#2563eb;transform:translateY(-2px)}
        .btn-outline{border:2px solid #3b82f6;color:#3b82f6;padding:0.75rem 1.5rem;border-radius:0.5rem;text-decoration:none;display:inline-block;transition:all 0.3s ease}
        .btn-outline:hover{background-color:#3b82f6;color:#fff}
        .mobile-menu.hidden{display:none}
        @media(max-width:1023px){.lg\\:hidden{display:none}.lg\\:flex{display:none}}
    </style>
    
    <!-- Custom Loading Bar Styles -->
    <style>
        /* Customize NProgress bar */
        #nprogress .bar {
            background: linear-gradient(90deg, #3B82F6, #10B981) !important;
            height: 3px !important;
        }
        
        #nprogress .peg {
            box-shadow: 0 0 10px #3B82F6, 0 0 5px #3B82F6 !important;
        }
        
        #nprogress .spinner-icon {
            border-top-color: #3B82F6 !important;
            border-left-color: #3B82F6 !important;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    {{-- Navigation --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    <!-- NProgress JavaScript -->
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    
    <!-- Loading Bar Script -->
    <script>
        // Configure NProgress
        NProgress.configure({ 
            showSpinner: true,
            minimum: 0.2,
            speed: 500,
            trickleSpeed: 200
        });

        // Show loading bar on page navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Handle all links
            const links = document.querySelectorAll('a[href]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    // Only show loading for internal links (not external, mailto, tel, etc.)
                    if (href && 
                        !href.startsWith('#') && 
                        !href.startsWith('mailto:') && 
                        !href.startsWith('tel:') && 
                        !href.startsWith('javascript:') &&
                        !href.startsWith('http://') &&
                        !href.startsWith('https://') &&
                        !this.hasAttribute('download') &&
                        this.target !== '_blank') {
                        
                        NProgress.start();
                    }
                });
            });

            // Handle form submissions
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    NProgress.start();
                });
            });

            // Handle browser back/forward buttons
            window.addEventListener('beforeunload', function() {
                NProgress.start();
            });

            // Complete loading bar when page is fully loaded
            window.addEventListener('load', function() {
                NProgress.done();
            });

            // Also complete on page show (for browser back/forward)
            window.addEventListener('pageshow', function() {
                NProgress.done();
            });
        });
    </script>

    {{-- Scripts --}}
    @stack('scripts')
</body>
</html>
    </script>

    <!-- Production JavaScript -->
    <script src="/build/assets/app-C0G0cght.js" defer></script>

    {{-- Scripts --}}
    @stack('scripts')
</body>
</html>

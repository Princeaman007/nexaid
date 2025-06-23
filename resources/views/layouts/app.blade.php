<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Site Web')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        /* Header avec sélecteur de langue */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .logo h1 {
            margin: 0;
            color: #333;
            font-size: 1.8rem;
        }

        .language-switcher {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .language-switcher span {
            font-weight: bold;
            color: #666;
        }

        .language-switcher a {
            padding: 5px 12px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f8f9fa;
            color: #333;
            font-size: 14px;
            transition: all 0.2s;
        }

        .language-switcher a.active {
            background: #007cba;
            color: white;
            border-color: #007cba;
        }

        .language-switcher a:hover {
            background: #e9ecef;
            transform: translateY(-1px);
        }

        .language-switcher a.active:hover {
            background: #005a8b;
        }

        nav {
            margin: 20px 0;
        }

        nav a {
            margin-right: 10px;
            text-decoration: none;
            color: #007cba;
            font-weight: 500;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .dropdown {
            display: inline-block;
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9fa;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            border-radius: 4px;
            margin-top: 5px;
            border: 1px solid #dee2e6;
        }

        .dropdown-content a {
            color: #333 !important;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            margin-right: 0 !important;
        }

        .dropdown-content a:hover {
            background-color: #e9ecef;
            text-decoration: none !important;
        }

        .show {
            display: block;
        }

        .flash-message {
            background: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .flash-message.error {
            background: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
        }

        footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }

            .language-switcher {
                order: -1;
            }

            nav {
                text-align: center;
            }

            .dropdown-content {
                min-width: 180px;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <header class="header">
            <div class="logo">
                <h1>{{ config('app.name', 'NEXAID') }}</h1>
            </div>

            
        </header>

        <!-- Navigation avec menus déroulants -->
        <nav>
            <a href="{{ route('home') }}">{{ __('nav.home') }}</a> |
            <a href="{{ route('internships.index') }}">{{ __('nav.internships') }}</a> |

            <!-- Services -->
            <div class="dropdown" style="display: inline-block;">
                <a href="#" id="servicesDropdownBtn" style="margin-right: 10px;"
                    onclick="toggleDropdown('servicesDropdown', event)">
                    {{ __('nav.services') }} ▼
                </a>
                <div id="servicesDropdown" class="dropdown-content">
                    <a href="{{ route('services.internship-search') }}">{{ __('nav.internship_search') }}</a>
                    <a href="{{ route('services.housing') }}">{{ __('nav.housing') }}</a>
                <a href="{{ route('services.airport-pickup') }}">{{ __('nav.airport_pickup') }}</a>
                    <a href="{{ route('services.support') }}">{{ __('nav.support') }}</a>
                </div>
            </div> |

            <!-- Entreprises -->
            <div class="dropdown" style="display: inline-block;">
                <a href="#" id="companyDropdownBtn" style="margin-right: 10px;"
                    onclick="toggleDropdown('companyDropdown', event)">
                    {{ __('nav.companies') }} ▼
                </a>
                <div id="companyDropdown" class="dropdown-content">
                    <a href="{{ route('compagnies.hiring') }}">{{ __('nav.why_intern') }}</a>
                    <a href="{{ route('compagnies.partnership') }}">{{ __('nav.how_it_works') }}</a>
                    <a href="{{ route('compagnies.send-offer') }}">{{ __('nav.send_offer') }}</a>
                    {{-- <a href="{{ route('compagnies.register') }}">{{ __('nav.partnership_form') ?? 'Formulaire Partenariat' }}</a> --}}
                </div>
            </div> |

            <a href="{{ route('blog.index') }}">{{ __('nav.blog') }}</a> |
            <a href="{{ route('partners.index') }}">{{ __('nav.partners') }}</a> |
            <a href="{{ route('values.index') }}">{{ __('nav.values') }}</a> |
            <a href="{{ route('info') }}">{{ __('nav.faq') }}</a> |
            <a href="{{ route('contact.index') }}">{{ __('nav.contact') }}</a>
        </nav>

        <hr>

        <!-- Messages flash -->
        @if(session('success'))
        <div class="flash-message">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="flash-message error">
            {{ session('error') }}
        </div>
        @endif

        @if(session('locale_set'))
        <div class="flash-message">
            {{ __('nav.language_changed') }} {{ config('app.locale_names.' . session('locale_set'),
            session('locale_set')) }}
        </div>
        @endif

        <!-- Contenu principal -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'NEXAID') }}. {{ __('nav.rights') }}</p>
        </footer>
    </div>

    <script>
        function toggleDropdown(id, event) {
            event.preventDefault();
            var dropdown = document.getElementById(id);
            var allDropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < allDropdowns.length; i++) {
                if (allDropdowns[i].id !== id) {
                    allDropdowns[i].classList.remove('show');
                }
            }
            dropdown.classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropdown a')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        setTimeout(function() {
            var flashMessages = document.getElementsByClassName('flash-message');
            for (let i = 0; i < flashMessages.length; i++) {
                flashMessages[i].style.opacity = '0';
                flashMessages[i].style.transition = 'opacity 0.5s';
                setTimeout(() => {
                    if (flashMessages[i]) {
                        flashMessages[i].style.display = 'none';
                    }
                }, 500);
            }
        }, 5000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    @stack('scripts')

</body>

</html>
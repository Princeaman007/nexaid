<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Site Web</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        nav a {
            margin-right: 10px;
        }
        
        /* Styles pour les menus déroulants */
        .dropdown {
            display: inline-block;
            position: relative;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9fa;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 4px;
            margin-top: 5px;
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        
        .show {
            display: block;
        }
    </style>
</head>

<body>
    <nav>
        <a href="{{ route('home') }}">Home</a> |
        <a href="{{ route('internships.index') }}">Internships</a> |
        
        <!-- Début menu Services -->
        <div class="dropdown" style="display: inline-block;">
            <a href="#" id="servicesDropdownBtn" style="margin-right: 10px;" onclick="toggleDropdown('servicesDropdown', event)">
                Our Services ▼
            </a>
            <div id="servicesDropdown" class="dropdown-content">
                <a href="{{ route('services.internship-search') }}">Internship search</a>
                <a href="{{ route('services.housing') }}">Housing</a>
                <a href="{{ route('services.language-courses') }}">Language courses</a>
                <a href="{{ route('services.airport-pickup') }}">Airport pickup</a>
                <a href="{{ route('services.support') }}">Support</a>
            </div>
        </div> |
        <!-- Fin menu Services -->
        
        <!-- Début menu Entreprises -->
        <div class="dropdown" style="display: inline-block;">
            <a href="#" id="companyDropdownBtn" style="margin-right: 10px;" onclick="toggleDropdown('companyDropdown', event)">
                Companies ▼
            </a>
            <div id="companyDropdown" class="dropdown-content">
                <a href="{{ route('company.why-intern') }}">Why hire an intern</a>
                <a href="{{ route('company.how-it-works') }}">How it works</a>
                <a href="{{ route('company.send-offer') }}">Submit an offer</a>
            </div>
        </div> |
        <!-- Fin menu Entreprises -->
        
        <a href="{{ route('blog.index') }}">Blog</a> |
        <a href="{{ route('partners.index') }}">Partners</a> |
        <a href="{{ route('values.index') }}">Values & Mission</a> |
        <a href="{{ route('info') }}">FAQ</a> |
        <a href="{{ route('contact.index') }}">Contact</a>
    </nav>

    <hr>

    @yield('content')

    <script>
        // Fonction pour ouvrir/fermer le menu déroulant
        function toggleDropdown(id, event) {
            event.preventDefault();
            var dropdown = document.getElementById(id);
            
            // Ferme tous les autres menus déroulants
            var allDropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < allDropdowns.length; i++) {
                if (allDropdowns[i].id !== id) {
                    allDropdowns[i].classList.remove('show');
                }
            }
            
            // Bascule l'affichage du menu actuel
            dropdown.classList.toggle("show");
        }

        // Fermer les menus déroulants si l'utilisateur clique en dehors
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
    </script>
</body>

</html>
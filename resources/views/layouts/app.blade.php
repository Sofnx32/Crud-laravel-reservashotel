<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas - @yield('title', 'Hotel')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">   
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'hotel-gold': '#D4AF37',
                        'hotel-navy': '#1B365D',
                        'hotel-cream': '#F8F6F0',
                        'hotel-dark': '#2C3E50',
                        'hotel-light': '#F5F5DC'
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'body': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-hotel-cream font-body">
    <div class="min-h-screen">
        <!-- Header Hotel -->
        <header class="bg-hotel-navy shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo Hotel -->
                    <div class="flex items-center space-x-4">
                        <div class="text-hotel-gold text-2xl">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <div>
                            <h1 class="text-white font-display text-xl font-bold">Hotel Tecsup Resort</h1>
                            <p class="text-hotel-cream text-xs">Sistema Gestion de Reservas</p>
                        </div>
                    </div>
                    
                    
                    <div class="text-hotel-cream">
                        <div class="text-sm font-medium">
                            <i class="fas fa-clock mr-1"></i>
                            <span id="timeDisplay"></span>
                        </div>
                        <div class="text-xs text-hotel-light">
                            Trujillo, Perú
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Navigation -->
        <nav class="bg-white shadow-md border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex space-x-8">
                    <a href="{{ route('reservas.index') }}" 
                       class="flex items-center px-3 py-4 text-sm font-medium border-b-2 transition-colors duration-200 {{ request()->routeIs('reservas.*') ? 'border-hotel-gold text-hotel-navy' : 'border-transparent text-gray-500 hover:text-hotel-navy hover:border-gray-300' }}">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Reservas
                    </a>
                    <a href="{{ route('clientes.index') }}" 
                       class="flex items-center px-3 py-4 text-sm font-medium border-b-2 transition-colors duration-200 {{ request()->routeIs('clientes.*') ? 'border-hotel-gold text-hotel-navy' : 'border-transparent text-gray-500 hover:text-hotel-navy hover:border-gray-300' }}">
                        <i class="fas fa-users mr-2"></i>
                        Clientes
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Alerts -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <p class="text-green-800">{{ session('success') }}</p>
                        <button type="button" class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-3 mt-1"></i>
                        <div>
                            <h4 class="text-red-800 font-medium mb-2">Por favor corrige los siguientes errores:</h4>
                            <ul class="text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="flex items-center">
                                        <i class="fas fa-circle text-red-400 text-xs mr-2"></i>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-hotel-navy text-hotel-cream mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            <i class="fas fa-hotel text-hotel-gold text-xl"></i>
                            <h3 class="font-display text-lg font-bold">Hotel Tecsup Resort</h3>
                        </div>
                        <p class="text-hotel-light text-sm">Sistema de gestión de reservas y clientes hoteleros de última generación.</p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4 text-hotel-gold">Enlaces Rápidos</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('reservas.index') }}" class="text-hotel-light hover:text-hotel-gold transition-colors">Ver Reservas</a></li>
                            <li><a href="{{ route('clientes.index') }}" class="text-hotel-light hover:text-hotel-gold transition-colors">Ver Clientes</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4 text-hotel-gold">Información</h4>
                        <div class="text-sm text-hotel-light space-y-2">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-hotel-gold"></i>
                                <span>Trujilo, Perú</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2 text-hotel-gold"></i>
                                <span id="footerTime"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-hotel-dark mt-8 pt-6 text-center">
                    <p class="text-sm text-hotel-light">
                        © 2025 Hotel Tecsup Resort. Sistema desarrollado con Tailwind CSS.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        function updatePeruTime() {
            const options = {
                timeZone: 'America/Lima',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };

            // Obtener hora peruana real (sin cálculos manuales)
            const peruTime = new Intl.DateTimeFormat('es-PE', options).format(new Date());
            const formatted = peruTime.replace(',', ' - ');

            const timeDisplay = document.getElementById('timeDisplay');
            const footerTime = document.getElementById('footerTime');

            if (timeDisplay) {
                timeDisplay.textContent = formatted;
            }

            if (footerTime) {
                footerTime.textContent = formatted.replace(' - ', ' ');
            }
        }

        // Actualizar cada segundo
        updatePeruTime();
        setInterval(updatePeruTime, 1000);
    </script>

</body>
</html>
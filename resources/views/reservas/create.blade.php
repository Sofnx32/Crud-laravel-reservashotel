@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-6 mb-8 shadow-lg">
    <div class="flex items-center">
        <div class="flex-1">
            <h2 class="text-3xl font-bold text-white font-display">Nueva Reserva Express</h2>
            <p class="text-blue-100 mt-1">Registro rápido de reservas - Hotel Tecsup Resort</p>
        </div>
        <a href="{{ route('reservas.index') }}" 
           class="bg-white text-blue-700 px-4 py-2 rounded-lg font-semibold hover:bg-blue-50 transition-colors duration-200 flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </div>
</div>

<form action="{{ route('reservas.store') }}" method="POST" class="space-y-8">
    @csrf

    <!-- Cliente Selection -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-hotel-navy to-blue-800 text-white p-6">
            <h3 class="text-xl font-semibold mb-1">
                <i class="fas fa-user mr-2"></i>
                Selección del Huésped
            </h3>
            <p class="text-blue-100 text-sm">Busca y selecciona el huésped para la reserva</p>
        </div>
        
        <div class="p-6">
            <label for="cliente_id" class="block text-sm font-semibold text-gray-700 mb-3">
                <i class="fas fa-search text-hotel-gold mr-2"></i>
                Huésped Registrado *
            </label>
            <select name="cliente_id" id="cliente_id" required
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-hotel-gold focus:border-hotel-gold transition-colors duration-200">
                <option value="">🔍 Buscar huésped...</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        👤 {{ $cliente->nombre }} {{ $cliente->apellido }} | 📧 {{ $cliente->email }} | 📱 {{ $cliente->telefono }}
                    </option>
                @endforeach
            </select>
            @error('cliente_id')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-6">
            <h3 class="text-xl font-semibold mb-1">
                <i class="fas fa-bed mr-2"></i>
                Tipo de Habitación y Servicios
            </h3>
            <p class="text-green-100 text-sm">Selecciona el tipo de habitación - precios incluyen todos los servicios</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="room-type-card border-2 border-gray-200 rounded-lg p-4 hover:border-hotel-gold transition-all duration-200 cursor-pointer"
                     onclick="selectRoomType('estandar', 120, 'estandar')">
                    <input type="radio" name="tipo_radio" id="tipo_estandar" value="estandar" class="sr-only">
                    <div class="text-center">
                        <div class="text-4xl mb-2">🏨</div>
                        <h4 class="font-bold text-gray-800 mb-1">Estándar</h4>
                        <div class="text-2xl font-bold text-green-600 mb-2">S/ 120</div>
                        <div class="text-xs text-gray-600">por noche</div>
                        <div class="mt-3 text-xs text-gray-500">
                            ✓ 1-2 personas<br>
                            ✓ Cama doble<br>
                            ✓ Wifi gratis<br>
                            ✓ Desayuno incluido
                        </div>
                    </div>
                </div>

                <div class="room-type-card border-2 border-gray-200 rounded-lg p-4 hover:border-hotel-gold transition-all duration-200 cursor-pointer"
                     onclick="selectRoomType('premium', 180, 'premium')">
                    <input type="radio" name="tipo_radio" id="tipo_premium" value="premium" class="sr-only">
                    <div class="text-center">
                        <div class="text-4xl mb-2">⭐</div>
                        <h4 class="font-bold text-gray-800 mb-1">Premium</h4>
                        <div class="text-2xl font-bold text-green-600 mb-2">S/ 180</div>
                        <div class="text-xs text-gray-600">por noche</div>
                        <div class="mt-3 text-xs text-gray-500">
                            ✓ 1-3 personas<br>
                            ✓ Cama king size<br>
                            ✓ Vista al mar<br>
                            ✓ Desayuno + almuerzo
                        </div>
                    </div>
                </div>
                <div class="room-type-card border-2 border-gray-200 rounded-lg p-4 hover:border-hotel-gold transition-all duration-200 cursor-pointer"
                     onclick="selectRoomType('suite', 280, 'suite')">
                    <input type="radio" name="tipo_radio" id="tipo_suite" value="suite" class="sr-only">
                    <div class="text-center">
                        <div class="text-4xl mb-2">🏰</div>
                        <h4 class="font-bold text-gray-800 mb-1">Suite</h4>
                        <div class="text-2xl font-bold text-green-600 mb-2">S/ 280</div>
                        <div class="text-xs text-gray-600">por noche</div>
                        <div class="mt-3 text-xs text-gray-500">
                            ✓ 1-4 personas<br>
                            ✓ Sala de estar<br>
                            ✓ Terraza privada<br>
                            ✓ Todo incluido
                        </div>
                    </div>
                </div>

                <!-- Presidencial -->
                <div class="room-type-card border-2 border-gray-200 rounded-lg p-4 hover:border-hotel-gold transition-all duration-200 cursor-pointer"
                     onclick="selectRoomType('presidencial', 450, 'presidencial')">
                    <input type="radio" name="tipo_radio" id="tipo_presidencial" value="presidencial" class="sr-only">
                    <div class="text-center">
                        <div class="text-4xl mb-2">👑</div>
                        <h4 class="font-bold text-gray-800 mb-1">Presidencial</h4>
                        <div class="text-2xl font-bold text-green-600 mb-2">S/ 450</div>
                        <div class="text-xs text-gray-600">por noche</div>
                        <div class="mt-3 text-xs text-gray-500">
                            ✓ 1-6 personas<br>
                            ✓ Jacuzzi privado<br>
                            ✓ Mayordomo 24/7<br>
                            ✓ Experiencia VIP
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="tipo" id="tipo" value="{{ old('tipo') }}">
            <input type="hidden" name="precio_base" id="precio_base" value="{{ old('precio_base') }}">
            
            <!-- Precio base info -->
            <div id="precio-info" class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6 hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-semibold text-green-800">Tipo seleccionado:</h4>
                        <p id="tipo-seleccionado" class="text-green-700"></p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-green-600" id="precio-por-noche">S/ 0</div>
                        <div class="text-sm text-green-600">por noche</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white p-6">
            <h3 class="text-xl font-semibold mb-1">
                <i class="fas fa-calendar-plus mr-2"></i>
                Habitación y Fechas
            </h3>
            <p class="text-purple-100 text-sm">Asigna habitación y define el período de estadía</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Número de habitación -->
                <div>
                    <label for="habitacion" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-door-open text-purple-600 mr-2"></i>
                        Número de Habitación *
                    </label>
                    <input type="text" name="habitacion" id="habitacion" required
                           value="{{ old('habitacion') }}"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200"
                           placeholder="101, 201, 301...">
                    @error('habitacion')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Fecha de entrada -->
                <div>
                    <label for="fecha_entrada" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-check text-green-600 mr-2"></i>
                        Ingreso *
                    </label>
                    <input type="date" name="fecha_entrada" id="fecha_entrada" required
                           value="{{ old('fecha_entrada') }}"
                           min="{{ date('Y-m-d') }}"
                           onchange="calcularPrecio()"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                    @error('fecha_entrada')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="fecha_salida" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-times text-red-600 mr-2"></i>
                        Salida *
                    </label>
                    <input type="date" name="fecha_salida" id="fecha_salida" required
                           value="{{ old('fecha_salida') }}"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           onchange="calcularPrecio()"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors duration-200">
                    @error('fecha_salida')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <div id="calculadora-precio" class="bg-blue-50 border border-blue-200 rounded-lg p-6 hidden">
                <h4 class="font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-calculator mr-2"></i>
                    Calculadora de Precio Automática
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-center">
                    <div class="bg-white rounded-lg p-4">
                        <div class="text-2xl font-bold text-blue-600" id="noches">0</div>
                        <div class="text-sm text-gray-600">Noches</div>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <div class="text-2xl font-bold text-green-600" id="precio-por-noche-calc">S/ 0</div>
                        <div class="text-sm text-gray-600">Por noche</div>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <div class="text-2xl font-bold text-orange-600" id="subtotal">S/ 0</div>
                        <div class="text-sm text-gray-600">Subtotal</div>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <div class="text-2xl font-bold text-red-600" id="total">S/ 0</div>
                        <div class="text-sm text-gray-600">Total Final</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estado y Precio Final -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-orange-600 to-orange-700 text-white p-6">
            <h3 class="text-xl font-semibold mb-1">
                <i class="fas fa-flag-checkered mr-2"></i>
                Estado y Confirmación
            </h3>
            <p class="text-orange-100 text-sm">Estado de la reserva y precio final</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="estado" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-info-circle text-orange-600 mr-2"></i>
                        Estado de la Reserva *
                    </label>
                    <select name="estado" id="estado" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200">
                        <option value="">Seleccionar estado</option>
                        <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="confirmada" {{ old('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                        <option value="cancelada" {{ old('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                    @error('estado')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="precio" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                        Precio Total (S/) *
                    </label>
                    <input type="number" step="0.01" name="precio" id="precio" required
                           value="{{ old('precio') }}"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 text-lg font-bold"
                           placeholder="0.00" readonly>
                    <p class="mt-1 text-xs text-gray-500">
                        <i class="fas fa-calculator mr-1"></i>
                        Se calcula automáticamente según tipo y fechas
                    </p>
                    @error('precio')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
        <h4 class="font-semibold text-yellow-800 mb-3 flex items-center">
            <i class="fas fa-lightbulb mr-2"></i>
            Información Importante
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-yellow-800">
            <div>
                <p class="mb-2"><i class="fas fa-check text-yellow-600 mr-2"></i><strong>Entrada:</strong> A partir de las 9:00 AM</p>
                <p class="mb-2"><i class="fas fa-check text-yellow-600 mr-2"></i><strong>Salida:</strong> Antes de las 5:00 PM</p>
                <p><i class="fas fa-check text-yellow-600 mr-2"></i><strong>Cancelación:</strong> 24h antes sin penalidad</p>
            </div>
            <div>
                <p class="mb-2"><i class="fas fa-check text-yellow-600 mr-2"></i><strong>Estacionamiento:</strong> Gratis para huéspedes</p>
                <p class="mb-2"><i class="fas fa-check text-yellow-600 mr-2"></i><strong>Pets:</strong> No se permiten mascotas</p>
                <p><i class="fas fa-check text-yellow-600 mr-2"></i><strong>WiFi:</strong> Internet de alta velocidad gratis</p>
            </div>
        </div>
    </div>
    <div class="flex justify-between items-center pt-6 border-t border-gray-200">
        <a href="{{ route('reservas.index') }}" 
           class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center">
            <i class="fas fa-times mr-2"></i>
            Cancelar
        </a>
        
        <button type="submit" 
                id="btn-crear"
                class="px-8 py-3 bg-hotel-gold hover:bg-yellow-600 text-white font-semibold rounded-lg transition-colors duration-200 flex items-center">
            <i class="fas fa-save mr-2"></i>
            Crear Reserva
        </button>
    </div>
</form>

<style>
.room-type-card.selected {
    border-color: #D4AF37 !important;
    background-color: #FFF8DC !important;
    transform: scale(1.02);
}

.room-type-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
</style>

<script>
function selectRoomType(tipo, precio, radioId) {
    document.getElementById('tipo_' + tipo).checked = true;
    document.getElementById('tipo').value = tipo;
    document.getElementById('precio_base').value = precio;
    document.querySelectorAll('.room-type-card').forEach(card => {
        card.classList.remove('selected');
    });
    event.currentTarget.classList.add('selected');
    const tipoLabels = {
        'estandar': 'Habitación Estándar',
        'premium': 'Habitación Premium', 
        'suite': 'Suite',
        'presidencial': 'Suite Presidencial'
    };
    
    document.getElementById('tipo-seleccionado').textContent = tipoLabels[tipo];
    document.getElementById('precio-por-noche').textContent = 'S/ ' + precio;
    document.getElementById('precio-info').classList.remove('hidden');
    calcularPrecio();
}

function calcularPrecio() {
    const fechaEntrada = document.getElementById('fecha_entrada').value;
    const fechaSalida = document.getElementById('fecha_salida').value;
    const precioBase = document.getElementById('precio_base').value;
    
    if (fechaEntrada && fechaSalida && precioBase) {
        const entrada = new Date(fechaEntrada);
        const salida = new Date(fechaSalida);
        const diffTime = salida - entrada;
        const noches = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (noches > 0) {
            const subtotal = noches * parseFloat(precioBase);
            const total = subtotal;
            document.getElementById('noches').textContent = noches;
            document.getElementById('precio-por-noche-calc').textContent = 'S/ ' + precioBase;
            document.getElementById('subtotal').textContent = 'S/ ' + subtotal.toFixed(2);
            document.getElementById('total').textContent = 'S/ ' + total.toFixed(2);
            document.getElementById('precio').value = total.toFixed(2);
            document.getElementById('calculadora-precio').classList.remove('hidden');
            verificarFormularioCompleto();
        }
    }
}

function verificarFormularioCompleto() {
    const clienteId = document.getElementById('cliente_id').value;
    const tipo = document.getElementById('tipo').value;
    const habitacion = document.getElementById('habitacion').value;
    const fechaEntrada = document.getElementById('fecha_entrada').value;
    const fechaSalida = document.getElementById('fecha_salida').value;
    const estado = document.getElementById('estado').value;
    const precio = document.getElementById('precio').value;
    
    const completo = clienteId && tipo && habitacion && fechaEntrada && fechaSalida && estado && precio > 0;
    
    const btnCrear = document.getElementById('btn-crear');
    if (completo) {
        btnCrear.disabled = false;
        btnCrear.classList.remove('opacity-50');
    } else {
        btnCrear.disabled = true;
        btnCrear.classList.add('opacity-50');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    ['cliente_id', 'habitacion', 'fecha_entrada', 'fecha_salida', 'estado'].forEach(id => {
        document.getElementById(id).addEventListener('change', verificarFormularioCompleto);
    });
    
    document.getElementById('fecha_salida').addEventListener('change', function() {
        const entrada = new Date(document.getElementById('fecha_entrada').value);
        const salida = new Date(this.value);
        
        if (salida <= entrada) {
            alert('La fecha de salida debe ser posterior a la fecha de entrada');
            this.value = '';
            calcularPrecio();
        }
    });
    
    verificarFormularioCompleto();
});
</script>

@endsection
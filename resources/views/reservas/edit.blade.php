@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-yellow-600 to-yellow-500 rounded-lg p-6 mb-8 shadow-lg">
    <div class="flex items-center">
        <div class="flex-1">
            <h2 class="text-3xl font-bold text-white font-['Playfair_Display']">Editar Reserva</h2>
            <p class="text-yellow-100 mt-1">Modifica la información de la reserva #{{ $reserva->id }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('reservas.show', $reserva) }}" 
               class="bg-white text-yellow-700 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-50 transition-colors duration-200 flex items-center gap-2">
                <i class="fas fa-eye"></i>
                Ver Detalles
            </a>
            <a href="{{ route('reservas.index') }}" 
               class="bg-white text-yellow-700 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-50 transition-colors duration-200 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Volver
            </a>
        </div>
    </div>
</div>

<!-- Reservation Info Card -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
            <i class="fas fa-info-circle text-yellow-600"></i>
            Información Actual de la Reserva
        </h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-full mr-4">
                    <i class="fas fa-bed text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Habitación</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $reserva->habitacion }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full mr-4">
                    <i class="fas fa-user text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Cliente</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $reserva->cliente->nombre ?? '—' }} {{ $reserva->cliente->apellido ?? '' }}
                    </p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full mr-4">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Precio Actual</p>
                    <p class="text-lg font-semibold text-gray-900">S/ {{ number_format($reserva->precio, 2) }}</p>
                </div>
            </div>
        </div>
        
        <!-- Timestamps -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                <div class="flex items-center">
                    <i class="fas fa-clock text-green-600 mr-2"></i>
                    <span>Creado: {{ $reserva->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-edit text-blue-600 mr-2"></i>
                    <span>Última actualización: {{ $reserva->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Form -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
            <i class="fas fa-edit text-yellow-600"></i>
            Modificar Información
        </h3>
    </div>

    <form action="{{ route('reservas.update', $reserva) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <!-- Client Selection -->
        <div class="mb-6">
            <label for="cliente_id" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-user text-yellow-600 mr-1"></i>
                Cliente *
            </label>
            <select name="cliente_id" id="cliente_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200">
                <option value="">Seleccionar cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" 
                            {{ (old('cliente_id', $reserva->cliente_id) == $cliente->id) ? 'selected' : '' }}>
                        {{ $cliente->nombre }} {{ $cliente->apellido }} - {{ $cliente->email }}
                    </option>
                @endforeach
            </select>
            @error('cliente_id')
                <p class="mt-1 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Room Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="habitacion" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-bed text-yellow-600 mr-1"></i>
                    Número de Habitación *
                </label>
                <input type="text" name="habitacion" id="habitacion" required
                       value="{{ old('habitacion', $reserva->habitacion) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200"
                       placeholder="Ej: 101, 201, Suite Presidential">
                @error('habitacion')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-star text-yellow-600 mr-1"></i>
                    Tipo de Habitación *
                </label>
                <select name="tipo" id="tipo" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200">
                    <option value="">Seleccionar tipo</option>
                    <option value="estándar" {{ old('tipo', $reserva->tipo) == 'estándar' ? 'selected' : '' }}>Estándar</option>
                    <option value="premium" {{ old('tipo', $reserva->tipo) == 'premium' ? 'selected' : '' }}>Premium</option>
                    <option value="suite" {{ old('tipo', $reserva->tipo) == 'suite' ? 'selected' : '' }}>Suite</option>
                    <option value="presidencial" {{ old('tipo', $reserva->tipo) == 'presidencial' ? 'selected' : '' }}>Presidencial</option>
                </select>
                @error('tipo')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="fecha_entrada" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-plus text-green-600 mr-1"></i>
                    Fecha de Entrada *
                </label>
                <input type="date" name="fecha_entrada" id="fecha_entrada" required
                       value="{{ old('fecha_entrada', $reserva->fecha_entrada->format('Y-m-d')) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200">
                @error('fecha_entrada')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="fecha_salida" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-minus text-red-600 mr-1"></i>
                    Fecha de Salida *
                </label>
                <input type="date" name="fecha_salida" id="fecha_salida" required
                       value="{{ old('fecha_salida', $reserva->fecha_salida->format('Y-m-d')) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200">
                @error('fecha_salida')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Status and Price -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-info-circle text-blue-600 mr-1"></i>
                    Estado de la Reserva *
                </label>
                <select name="estado" id="estado" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200">
                    <option value="">Seleccionar estado</option>
                    <option value="pendiente" {{ old('estado', $reserva->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="confirmada" {{ old('estado', $reserva->estado) == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                    <option value="cancelada" {{ old('estado', $reserva->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
                @error('estado')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-money-bill-wave text-green-600 mr-1"></i>
                    Precio Total (S/) *
                </label>
                <input type="number" step="0.01" name="precio" id="precio" required
                       value="{{ old('precio', $reserva->precio) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200"
                       placeholder="0.00">
                @error('precio')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Status Change Warning -->
        @if($reserva->estado != 'confirmada' && $reserva->estado != 'cancelada')
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
            <h4 class="text-lg font-semibold text-yellow-900 mb-3 flex items-center">
                <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                Cambios de Estado
            </h4>
            <div class="text-sm text-yellow-800">
                <p class="mb-2">
                    <strong>Estado actual:</strong> 
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>
                        {{ ucfirst($reserva->estado) }}
                    </span>
                </p>
                <ul class="space-y-1">
                    <li>• Confirmar la reserva activará todos los servicios incluidos</li>
                    <li>• Cancelar la reserva liberará la habitación inmediatamente</li>
                    <li>• Se aplicará la política de cancelación correspondiente</li>
                </ul>
            </div>
        </div>
        @endif

        <!-- Form Actions -->
        <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6 border-t border-gray-200">
            <a href="{{ route('reservas.index') }}" 
               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition-colors duration-200 text-center">
                <i class="fas fa-times mr-2"></i>
                Cancelar
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-yellow-600 text-white rounded-lg font-semibold hover:bg-yellow-700 transition-colors duration-200 text-center">
                <i class="fas fa-save mr-2"></i>
                Actualizar Reserva
            </button>
        </div>
    </form>
</div>

<script>
// Date validation
document.getElementById('fecha_entrada').addEventListener('change', function() {
    const fechaEntrada = this.value;
    const fechaSalida = document.getElementById('fecha_salida');
    
    if (fechaEntrada) {
        fechaSalida.min = fechaEntrada;
        
        // If current fecha_salida is before fecha_entrada, update it
        if (fechaSalida.value && fechaSalida.value <= fechaEntrada) {
            fechaSalida.value = fechaEntrada;
        }
    }
});

document.getElementById('fecha_salida').addEventListener('change', function() {
    const fechaEntrada = document.getElementById('fecha_entrada').value;
    const fechaSalida = this.value;
    
    if (fechaEntrada && fechaSalida <= fechaEntrada) {
        alert('La fecha de salida debe ser posterior a la fecha de entrada');
        this.value = fechaEntrada;
    }
});

// Auto-calculate price based on room type and dates
document.getElementById('tipo').addEventListener('change', function() {
    calculatePrice();
});

document.getElementById('fecha_entrada').addEventListener('change', function() {
    calculatePrice();
});

document.getElementById('fecha_salida').addEventListener('change', function() {
    calculatePrice();
});

function calculatePrice() {
    const tipo = document.getElementById('tipo').value;
    const fechaEntrada = document.getElementById('fecha_entrada').value;
    const fechaSalida = document.getElementById('fecha_salida').value;
    
    if (tipo && fechaEntrada && fechaSalida) {
        const startDate = new Date(fechaEntrada);
        const endDate = new Date(fechaSalida);
        const nights = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
        
        // Base prices per night
        const prices = {
            'estándar': 150,
            'premium': 250,
            'suite': 400,
            'presidencial': 600
        };
        
        if (prices[tipo] && nights > 0) {
            const totalPrice = prices[tipo] * nights;
            document.getElementById('precio').value = totalPrice.toFixed(2);
        }
    }
}
</script>
@endsection
@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-yellow-600 to-yellow-500 rounded-lg p-6 mb-8 shadow-lg">
    <div class="flex items-center">
        <div class="flex-1">
            <h2 class="text-3xl font-bold text-white font-['Playfair_Display']">Detalles de Reserva</h2>
            <p class="text-yellow-100 mt-1">Reserva #{{ $reserva->id }} - Hotel Tecsup Resort</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('reservas.edit', $reserva) }}" 
               class="bg-white text-yellow-700 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-50 transition-colors duration-200 flex items-center gap-2">
                <i class="fas fa-edit"></i>
                Editar
            </a>
            <a href="{{ route('reservas.index') }}" 
               class="bg-white text-yellow-700 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-50 transition-colors duration-200 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Volver
            </a>
        </div>
    </div>
</div>

<!-- Status Banner -->
<div class="mb-8">
    @if($reserva->estado == 'confirmada')
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full mr-4">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-green-900">Reserva Confirmada</h3>
                    <p class="text-green-700">Esta reserva está confirmada y lista para el check-in</p>
                </div>
            </div>
        </div>
    @elseif($reserva->estado == 'cancelada')
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-3 bg-red-100 rounded-full mr-4">
                    <i class="fas fa-times-circle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-900">Reserva Cancelada</h3>
                    <p class="text-red-700">Esta reserva ha sido cancelada</p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-full mr-4">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-yellow-900">Reserva Pendiente</h3>
                    <p class="text-yellow-700">Esta reserva está pendiente de confirmación</p>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Reservation Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Room & Guest Info -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-bed text-yellow-600"></i>
                    Información de la Habitación y Huésped
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Room Details -->
                    <div class="bg-yellow-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-yellow-900 mb-4 flex items-center">
                            <i class="fas fa-bed text-yellow-600 mr-2"></i>
                            Habitación
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-yellow-700">Número</p>
                                <p class="text-xl font-bold text-yellow-900">{{ $reserva->habitacion }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-yellow-700">Tipo</p>
                                <div class="flex items-center mt-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-star mr-1"></i>
                                        {{ ucfirst($reserva->tipo) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Guest Details -->
                    <div class="bg-blue-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-blue-900 mb-4 flex items-center">
                            <i class="fas fa-user text-blue-600 mr-2"></i>
                            Huésped
                        </h4>
                        @if($reserva->cliente)
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-blue-700">Nombre Completo</p>
                                <p class="text-xl font-bold text-blue-900">{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-blue-700">Email</p>
                                <p class="text-blue-900">{{ $reserva->cliente->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-blue-700">Teléfono</p>
                                <p class="text-blue-900">{{ $reserva->cliente->telefono }}</p>
                            </div>
                        </div>
                        @else
                        <p class="text-gray-500 italic">Cliente no encontrado</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Dates & Stay Info -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-calendar-alt text-yellow-600"></i>
                    Fechas de Estadía
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Check-in -->
                    <div class="text-center">
                        <div class="p-4 bg-green-100 rounded-full w-16 h-16 mx-auto mb-3 flex items-center justify-center">
                            <i class="fas fa-calendar-plus text-green-600 text-2xl"></i>
                        </div>
                        <h4 class="text-sm font-medium text-gray-600 uppercase tracking-wider mb-1">Entrada</h4>
                        <p class="text-2xl font-bold text-gray-900">{{ $reserva->fecha_entrada->format('d') }}</p>
                        <p class="text-sm text-gray-600">{{ $reserva->fecha_entrada->format('M Y') }}</p>
                        <p class="text-xs text-gray-500 mt-1">Desde las 9:00 AM</p>
                    </div>

                    <!-- Duration -->
                    <div class="text-center">
                        <div class="p-4 bg-yellow-100 rounded-full w-16 h-16 mx-auto mb-3 flex items-center justify-center">
                            <i class="fas fa-moon text-yellow-600 text-2xl"></i>
                        </div>
                        <h4 class="text-sm font-medium text-gray-600 uppercase tracking-wider mb-1">Duración</h4>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $reserva->fecha_entrada->diffInDays($reserva->fecha_salida) }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ $reserva->fecha_entrada->diffInDays($reserva->fecha_salida) == 1 ? 'noche' : 'noches' }}
                        </p>
                    </div>

                  
                    <div class="text-center">
                        <div class="p-4 bg-red-100 rounded-full w-16 h-16 mx-auto mb-3 flex items-center justify-center">
                            <i class="fas fa-calendar-minus text-red-600 text-2xl"></i>
                        </div>
                        <h4 class="text-sm font-medium text-gray-600 uppercase tracking-wider mb-1">Salida</h4>
                        <p class="text-2xl font-bold text-gray-900">{{ $reserva->fecha_salida->format('d') }}</p>
                        <p class="text-sm text-gray-600">{{ $reserva->fecha_salida->format('M Y') }}</p>
                        <p class="text-xs text-gray-500 mt-1">Hasta las 5:00 PM</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotel Services -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-concierge-bell text-yellow-600"></i>
                    Servicios Incluidos
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="flex items-center p-3 bg-green-50 rounded-lg">
                        <i class="fas fa-utensils text-green-600 mr-3"></i>
                        <span class="text-sm font-medium text-gray-900">Desayuno Buffet</span>
                    </div>
                    <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                        <i class="fas fa-wifi text-blue-600 mr-3"></i>
                        <span class="text-sm font-medium text-gray-900">WiFi Gratis</span>
                    </div>
                    <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                        <i class="fas fa-swimming-pool text-purple-600 mr-3"></i>
                        <span class="text-sm font-medium text-gray-900">Piscina</span>
                    </div>
                    <div class="flex items-center p-3 bg-orange-50 rounded-lg">
                        <i class="fas fa-dumbbell text-orange-600 mr-3"></i>
                        <span class="text-sm font-medium text-gray-900">Gimnasio</span>
                    </div>
                    <div class="flex items-center p-3 bg-pink-50 rounded-lg">
                        <i class="fas fa-car text-pink-600 mr-3"></i>
                        <span class="text-sm font-medium text-gray-900">Parking</span>
                    </div>
                    <div class="flex items-center p-3 bg-teal-50 rounded-lg">
                        <i class="fas fa-spa text-teal-600 mr-3"></i>
                        <span class="text-sm font-medium text-gray-900">Spa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Price & Status -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-money-bill-wave text-yellow-600"></i>
                    Información de Pago
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center mb-6">
                    <p class="text-sm font-medium text-gray-600 uppercase tracking-wider mb-2">Precio Total</p>
                    <p class="text-3xl font-bold text-gray-900">S/ {{ number_format($reserva->precio, 2) }}</p>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-600">Estado actual</span>
                        @if($reserva->estado == 'confirmada')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Confirmada
                            </span>
                        @elseif($reserva->estado == 'cancelada')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>
                                Cancelada
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>
                                Pendiente
                            </span>
                        @endif
                    </div>
                    
                    @if($reserva->estado != 'cancelada')
                    <div class="text-center">
                        <button type="button" 
                                onclick="openDeleteModal({{ $reserva->id }}, '{{ $reserva->habitacion }}', '{{ $reserva->cliente->nombre ?? "Cliente" }} {{ $reserva->cliente->apellido ?? "" }}')"
                                class="w-full px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 transition-colors duration-200">
                            <i class="fas fa-trash mr-2"></i>
                            Cancelar Reserva
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-bolt text-yellow-600"></i>
                    Acciones Rápidas
                </h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('reservas.edit', $reserva) }}" 
                   class="w-full flex items-center justify-center px-4 py-3 border border-yellow-300 rounded-lg text-sm font-medium text-yellow-700 bg-yellow-50 hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fas fa-edit mr-2"></i>
                    Editar Reserva
                </a>
                
                <button onclick="window.print()" 
                        class="w-full flex items-center justify-center px-4 py-3 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors duration-200">
                    <i class="fas fa-print mr-2"></i>
                    Imprimir Detalles
                </button>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-clock text-yellow-600"></i>
                    Información del Sistema
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">Creado</span>
                    <span class="text-sm text-gray-900">{{ $reserva->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">Última actualización</span>
                    <span class="text-sm text-gray-900">{{ $reserva->updated_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">ID de reserva</span>
                    <span class="text-sm font-bold text-gray-900">#{{ $reserva->id }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    Confirmar Cancelación
                </h3>
            </div>
            <div class="px-6 py-4">
                <p class="text-gray-600 mb-4">
                    ¿Estás seguro de que deseas cancelar esta reserva?
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-bed text-yellow-600 mr-2"></i>
                        <span class="font-medium" id="modalHabitacion"></span>
                    </div>
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user text-yellow-600 mr-2"></i>
                        <span class="text-gray-700" id="modalCliente"></span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt text-yellow-600 mr-2"></i>
                        <span class="text-gray-700" id="modalFechas"></span>
                    </div>
                </div>
                <p class="text-sm text-red-600">
                    <i class="fas fa-info-circle mr-1"></i>
                    Esta acción cambiará el estado a "Cancelada" y liberará la habitación.
                </p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                    No, Mantener
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="estado" value="cancelada">
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors duration-150">
                        <i class="fas fa-times mr-1"></i>
                        Sí, Cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openDeleteModal(id, habitacion, cliente) {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('modalHabitacion').textContent = `Habitación: ${habitacion}`;
    document.getElementById('modalCliente').textContent = `Cliente: ${cliente}`;
    document.getElementById('modalFechas').textContent = `Fechas: {{ $reserva->fecha_entrada->format('d/m/Y') }} - {{ $reserva->fecha_salida->format('d/m/Y') }}`;
    document.getElementById('deleteForm').action = `/reservas/${id}`;
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
window.addEventListener('beforeprint', function() {
    document.querySelectorAll('.bg-white').forEach(function(el) {
        el.style.pageBreakInside = 'avoid';
    });
});
</script>
@endsection
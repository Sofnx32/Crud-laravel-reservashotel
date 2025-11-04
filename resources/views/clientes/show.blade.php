@extends('layouts.app')

@section('title', 'Ver Cliente')

@section('content')
<!-- Header de la sección -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-display font-bold text-hotel-navy mb-1">
            <i class="fas fa-user-circle mr-2 text-blue-500"></i>
            Detalles del Huésped
        </h2>
        <p class="text-gray-600 mb-0">Información completa de {{ $cliente->nombre }} {{ $cliente->apellido }}</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('clientes.edit', $cliente) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
            <i class="fas fa-edit mr-2"></i>
            Editar
        </a>
        <a href="{{ route('clientes.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Volver a Lista
        </a>
    </div>
</div>

<!-- Foto del Huésped -->
<div class="max-w-5xl mx-auto mb-6">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 text-center">
        <div class="p-8">
            @if($cliente->foto && Storage::disk('public')->exists($cliente->foto))
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $cliente->foto) }}" 
                         alt="Foto de {{ $cliente->nombre }} {{ $cliente->apellido }}" 
                         class="w-32 h-32 object-cover rounded-full mx-auto border-4 border-hotel-gold shadow-lg">
                </div>
                <h3 class="text-2xl font-bold text-hotel-navy mb-2">
                    {{ $cliente->nombre }} {{ $cliente->apellido }}
                </h3>
                <div class="flex justify-center">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-2"></i>
                        Foto cargada
                    </span>
                </div>
            @else
                <div class="mb-4">
                    <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto flex items-center justify-center border-4 border-gray-300">
                        <i class="fas fa-user text-6xl text-gray-400"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-hotel-navy mb-2">
                    {{ $cliente->nombre }} {{ $cliente->apellido }}
                </h3>
                <div class="flex justify-center">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-camera-slash mr-2"></i>
                        Sin foto
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Información del huésped -->
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Card principal con información personal -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
            <h3 class="text-xl font-semibold mb-1">
                <i class="fas fa-id-card mr-2"></i>
                Información Personal
            </h3>
            <p class="text-blue-100 text-sm">Datos del huésped registrado</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- ID del Cliente -->
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">
                        <i class="fas fa-hashtag mr-2"></i>ID del Huésped
                    </label>
                    <div class="text-2xl font-bold text-hotel-navy">
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full">#{{ $cliente->id }}</span>
                    </div>
                </div>
                
                <!-- Nombre Completo -->
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">
                        <i class="fas fa-user mr-2"></i>Nombre Completo
                    </label>
                    <div class="text-2xl font-bold text-hotel-navy">{{ $cliente->nombre }} {{ $cliente->apellido }}</div>
                </div>
                
                <!-- Correo Electrónico -->
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Correo Electrónico
                    </label>
                    @if($cliente->email)
                        <div class="text-lg">
                            <a href="mailto:{{ $cliente->email }}" class="text-blue-600 hover:text-blue-800 transition-colors flex items-center">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ $cliente->email }}
                            </a>
                        </div>
                    @else
                        <div class="text-gray-400 flex items-center">
                            <i class="fas fa-minus-circle mr-2"></i>
                            No especificado
                        </div>
                    @endif
                </div>
                
                <!-- Teléfono -->
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">
                        <i class="fas fa-phone mr-2"></i>Teléfono
                    </label>
                    @if($cliente->telefono)
                        <div class="text-lg">
                            <a href="tel:{{ $cliente->telefono }}" class="text-green-600 hover:text-green-800 transition-colors flex items-center">
                                <i class="fas fa-phone mr-2"></i>
                                {{ $cliente->telefono }}
                            </a>
                        </div>
                    @else
                        <div class="text-gray-400 flex items-center">
                            <i class="fas fa-minus-circle mr-2"></i>
                            No especificado
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Información del sistema -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-gray-600 to-gray-700 text-white p-6">
            <h3 class="text-xl font-semibold mb-1">
                <i class="fas fa-history mr-2"></i>
                Información del Sistema
            </h3>
            <p class="text-gray-100 text-sm">Timestamps y datos de registro</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Fecha de Registro -->
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">
                        <i class="fas fa-calendar-plus mr-2"></i>Fecha de Registro
                    </label>
                    <div class="text-lg font-semibold text-blue-600 flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $cliente->created_at->format('d/m/Y H:i:s') }}
                    </div>
                    <small class="text-gray-500">{{ $cliente->created_at->diffForHumans() }}</small>
                </div>
                
                <!-- Última Actualización -->
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">
                        <i class="fas fa-calendar-check mr-2"></i>Última Actualización
                    </label>
                    <div class="text-lg font-semibold text-green-600 flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $cliente->updated_at->format('d/m/Y H:i:s') }}
                    </div>
                    <small class="text-gray-500">{{ $cliente->updated_at->diffForHumans() }}</small>
                </div>
            </div>

            @if($cliente->created_at != $cliente->updated_at)
                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <i class="fas fa-info-circle text-blue-600 mr-3 mt-0.5"></i>
                        <div>
                            <h4 class="text-blue-800 font-medium text-sm">Información Adicional</h4>
                            <p class="text-blue-700 text-sm mt-1">
                                Este huésped ha sido modificado <strong>{{ $cliente->updated_at->diffForHumans() }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Estadísticas del huésped -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-6">
            <h3 class="text-xl font-semibold mb-1">
                <i class="fas fa-chart-bar mr-2"></i>
                Estadísticas del Huésped
            </h3>
            <p class="text-green-100 text-sm">Resumen de actividad y completitud de datos</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <!-- Reservas -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="text-3xl font-bold text-blue-600 mb-2">{{ $cliente->reservas->count() ?? 0 }}</div>
                    <div class="text-sm text-gray-600 flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i>
                        {{ $cliente->reservas->count() == 1 ? 'Reserva' : 'Reservas' }}
                    </div>
                </div>
                
                <!-- Email Status -->
                <div class="bg-green-50 rounded-lg p-4">
                    <div class="text-3xl mb-2">
                        @if($cliente->email)
                            <i class="fas fa-check-circle text-green-500"></i>
                        @else
                            <i class="fas fa-times-circle text-red-500"></i>
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 flex items-center justify-center">
                        <i class="fas fa-envelope mr-2"></i>
                        Email {{ $cliente->email ? 'Completo' : 'Faltante' }}
                    </div>
                </div>
                
                <!-- Teléfono Status -->
                <div class="bg-yellow-50 rounded-lg p-4">
                    <div class="text-3xl mb-2">
                        @if($cliente->telefono)
                            <i class="fas fa-check-circle text-green-500"></i>
                        @else
                            <i class="fas fa-times-circle text-red-500"></i>
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 flex items-center justify-center">
                        <i class="fas fa-phone mr-2"></i>
                        Teléfono {{ $cliente->telefono ? 'Completo' : 'Faltante' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="flex justify-center space-x-4">
        <a href="{{ route('clientes.edit', $cliente) }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center">
            <i class="fas fa-edit mr-2"></i>
            Editar Huésped
        </a>
        <button type="button" 
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center"
                onclick="openDeleteModal()">
            <i class="fas fa-trash mr-2"></i>
            Eliminar Huésped
        </button>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-red-100 p-3 rounded-full mr-4">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Confirmar Eliminación</h3>
                </div>
                
                <p class="text-gray-600 mb-4">
                    ¿Estás seguro de que deseas eliminar al huésped 
                    <strong class="text-hotel-navy">{{ $cliente->nombre }} {{ $cliente->apellido }}</strong>?
                </p>
                
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-triangle text-red-600 mr-3 mt-0.5"></i>
                        <div>
                            <h4 class="text-red-800 font-medium text-sm">Advertencia Importante</h4>
                            <p class="text-red-700 text-sm mt-1">
                                Esta acción eliminará también todas las reservas asociadas a este huésped y no se puede deshacer.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeDeleteModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-2"></i>
                            Eliminar Huésped
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Cerrar modal al hacer clic fuera
document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
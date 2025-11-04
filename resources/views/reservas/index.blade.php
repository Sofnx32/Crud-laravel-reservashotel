@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-yellow-600 to-yellow-500 rounded-lg p-6 mb-8 shadow-lg">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div class="mb-4 md:mb-0">
            <h2 class="text-3xl font-bold text-white font-['Playfair_Display']">Lista de Reservas</h2>
            <p class="text-yellow-100 mt-1">Gestiona todas las reservas del Hotel Tecsup Resort</p>
        </div>
        <a href="{{ route('reservas.create') }}" 
           class="bg-white text-yellow-700 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-50 transition-colors duration-200 flex items-center gap-2">
            <i class="fas fa-plus-circle"></i>
            Nueva Reserva
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-600">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 mr-4">
                <i class="fas fa-calendar-check text-yellow-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Total Reservas</p>
                <p class="text-2xl font-bold text-gray-900">{{ $reservas->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-600">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 mr-4">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Confirmadas</p>
                <p class="text-2xl font-bold text-gray-900">{{ $reservas->where('estado', 'confirmada')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-600">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 mr-4">
                <i class="fas fa-clock text-blue-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Pendientes</p>
                <p class="text-2xl font-bold text-gray-900">{{ $reservas->where('estado', 'pendiente')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-600">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 mr-4">
                <i class="fas fa-times-circle text-red-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Canceladas</p>
                <p class="text-2xl font-bold text-gray-900">{{ $reservas->where('estado', 'cancelada')->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Reservations Table -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
            <i class="fas fa-table text-yellow-600"></i>
            Reservas Registradas
        </h3>
    </div>

    @if($reservas->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Habitación</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entrada</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salida</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($reservas as $reserva)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $reserva->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="p-2 bg-yellow-100 rounded-lg mr-3">
                                <i class="fas fa-bed text-yellow-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $reserva->habitacion }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-star mr-1"></i>
                            {{ ucfirst($reserva->tipo) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-yellow-600 text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $reserva->cliente->nombre ?? '—' }} {{ $reserva->cliente->apellido ?? '' }}
                                </div>
                                @if($reserva->cliente)
                                <div class="text-sm text-gray-500">{{ $reserva->cliente->email }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-plus text-green-500 mr-2"></i>
                            {{ $reserva->fecha_entrada->format('d/m/Y') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-minus text-red-500 mr-2"></i>
                            {{ $reserva->fecha_salida->format('d/m/Y') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($reserva->estado == 'confirmada')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Confirmada
                            </span>
                        @elseif($reserva->estado == 'cancelada')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>
                                Cancelada
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>
                                Pendiente
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <div class="flex items-center">
                            <i class="fas fa-money-bill-wave text-green-600 mr-1"></i>
                            S/ {{ number_format($reserva->precio, 2) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('reservas.edit', $reserva) }}" 
                               class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors duration-150">
                                <i class="fas fa-edit mr-1"></i>
                                Editar
                            </a>
                            <button type="button" 
                                    class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 transition-colors duration-150"
                                    onclick="openDeleteModal({{ $reserva->id }}, '{{ $reserva->habitacion }}', '{{ $reserva->cliente->nombre ?? "Cliente" }} {{ $reserva->cliente->apellido ?? "" }}')">
                                <i class="fas fa-trash mr-1"></i>
                                Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-12">
        <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
            <i class="fas fa-calendar-times text-6xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay reservas registradas</h3>
        <p class="text-gray-500 mb-6">Comienza creando tu primera reserva para el hotel.</p>
        <a href="{{ route('reservas.create') }}" 
           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 transition-colors duration-200">
            <i class="fas fa-plus-circle mr-2"></i>
            Crear Primera Reserva
        </a>
    </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    Confirmar Eliminación
                </h3>
            </div>
            <div class="px-6 py-4">
                <p class="text-gray-600 mb-4">
                    ¿Estás seguro de que deseas eliminar esta reserva?
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-bed text-yellow-600 mr-2"></i>
                        <span class="font-medium" id="modalHabitacion"></span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-user text-yellow-600 mr-2"></i>
                        <span class="text-gray-700" id="modalCliente"></span>
                    </div>
                </div>
                <p class="text-sm text-red-600">
                    <i class="fas fa-info-circle mr-1"></i>
                    Esta acción no se puede deshacer.
                </p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors duration-150">
                        <i class="fas fa-trash mr-1"></i>
                        Eliminar Reserva
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
    document.getElementById('deleteForm').action = `/reservas/${id}`;
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
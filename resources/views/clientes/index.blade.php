@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<!-- Header de la sección -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-display font-bold text-hotel-navy mb-1">
            <i class="fas fa-users mr-2 text-hotel-gold"></i>
            Lista de Clientes
        </h2>
        <p class="text-gray-600 mb-0">Gestiona la información de todos los huéspedes registrados</p>
    </div>
    <a href="{{ route('clientes.create') }}" class="bg-hotel-gold hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center">
        <i class="fas fa-user-plus mr-2"></i>
        Nuevo Cliente
    </a>
</div>

<!-- Card contenedor -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
    <!-- Header de la card -->
    <div class="bg-gradient-to-r from-hotel-navy to-blue-800 text-white p-6">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-xl font-semibold mb-1">
                    <i class="fas fa-list-ul mr-2"></i>
                    Huéspedes Registrados
                </h3>
                <p class="text-blue-100 text-sm">Base de datos de clientes del hotel</p>
            </div>
            <div class="bg-hotel-gold text-hotel-navy px-4 py-2 rounded-full font-bold">
                {{ $clientes->count() }} {{ $clientes->count() == 1 ? 'huésped' : 'huéspedes' }}
            </div>
        </div>
    </div>
    
    <div class="p-0">
        @if($clientes->count() > 0)
            <!-- Tabla de clientes -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-hashtag mr-2"></i>ID
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-user mr-2"></i>Huésped
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-envelope mr-2"></i>Email
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-phone mr-2"></i>Teléfono
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-cog mr-2"></i>Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($clientes as $cliente)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    #{{ $cliente->id }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($cliente->foto && Storage::disk('public')->exists($cliente->foto))
                                            <img class="h-10 w-10 rounded-full object-cover border-2 border-hotel-gold" 
                                                src="{{ asset('storage/' . $cliente->foto) }}" 
                                                alt="Foto de {{ $cliente->nombre }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-hotel-navy text-white flex items-center justify-center">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $cliente->nombre }} {{ $cliente->apellido }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            ID Cliente: {{ $cliente->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($cliente->email)
                                    <a href="mailto:{{ $cliente->email }}" class="text-hotel-navy hover:text-hotel-gold transition-colors text-sm flex items-center">
                                        <i class="fas fa-envelope mr-2 text-gray-400"></i>
                                        {{ $cliente->email }}
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm flex items-center">
                                        <i class="fas fa-minus-circle mr-2"></i>
                                        No especificado
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($cliente->telefono)
                                    <a href="tel:{{ $cliente->telefono }}" class="text-hotel-navy hover:text-hotel-gold transition-colors text-sm flex items-center">
                                        <i class="fas fa-phone mr-2 text-gray-400"></i>
                                        {{ $cliente->telefono }}
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm flex items-center">
                                        <i class="fas fa-minus-circle mr-2"></i>
                                        No especificado
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('clientes.show', $cliente) }}" 
                                       class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors"
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clientes.edit', $cliente) }}" 
                                       class="text-yellow-600 hover:text-yellow-800 bg-yellow-50 hover:bg-yellow-100 p-2 rounded-lg transition-colors"
                                       title="Editar cliente">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors"
                                            title="Eliminar cliente"
                                            onclick="confirmDelete({{ $cliente->id }}, '{{ $cliente->nombre }} {{ $cliente->apellido }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Estado vacío -->
            <div class="text-center py-16">
                <div class="mb-6">
                    <i class="fas fa-users text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-3">No hay huéspedes registrados</h3>
                <p class="text-gray-500 mb-6">Comienza agregando tu primer cliente al sistema hotelero</p>
                <a href="{{ route('clientes.create') }}" class="bg-hotel-gold hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Agregar Primer Huésped
                </a>
            </div>
        @endif
    </div>
    
    <!-- Footer con estadísticas -->
    @if($clientes->count() > 0)
        <div class="bg-gray-50 px-6 py-4 border-t">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                <div class="flex flex-col">
                    <div class="text-2xl font-bold text-hotel-navy">{{ $clientes->count() }}</div>
                    <div class="text-sm text-gray-600">Total Huéspedes</div>
                </div>
                <div class="flex flex-col">
                    <div class="text-2xl font-bold text-green-600">{{ $clientes->where('email', '!=', null)->count() }}</div>
                    <div class="text-sm text-gray-600">Con Email</div>
                </div>
                <div class="flex flex-col">
                    <div class="text-2xl font-bold text-blue-600">{{ $clientes->where('telefono', '!=', null)->count() }}</div>
                    <div class="text-sm text-gray-600">Con Teléfono</div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Modal de confirmación -->
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
                    <strong id="clienteName" class="text-hotel-navy"></strong>?
                </p>
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-info-circle text-yellow-600 mr-3 mt-0.5"></i>
                        <div>
                            <h4 class="text-yellow-800 font-medium text-sm">Advertencia</h4>
                            <p class="text-yellow-700 text-sm mt-1">
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
                    <form id="deleteForm" method="POST">
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
function confirmDelete(clienteId, clienteName) {
    document.getElementById('clienteName').textContent = clienteName;
    document.getElementById('deleteForm').action = `/clientes/${clienteId}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Cerrar modal al hacer clic fuera
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
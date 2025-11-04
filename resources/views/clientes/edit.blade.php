@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
<!-- Header de la sección -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-display font-bold text-hotel-navy mb-1">
            <i class="fas fa-edit mr-2 text-yellow-500"></i>
            Editar Huésped
        </h2>
        <p class="text-gray-600 mb-0">Modifica la información de {{ $cliente->nombre }} {{ $cliente->apellido }}</p>
    </div>
    <a href="{{ route('clientes.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i>
        Volver a Lista
    </a>
</div>

<!-- Formulario -->
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Header del formulario -->
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6">
            <h3 class="text-xl font-semibold mb-1">
                <i class="fas fa-user mr-2"></i>
                Información del Huésped - {{ $cliente->nombre }} {{ $cliente->apellido }}
            </h3>
            <p class="text-yellow-100 text-sm">Actualiza los datos del huésped</p>
        </div>
        
        <div class="p-8">
            <form action="{{ route('clientes.update', $cliente) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Fila 1: Nombre y Apellido -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-hotel-gold"></i>
                            Nombre *
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-colors @error('nombre') border-red-500 @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre', $cliente->nombre) }}" 
                               required
                               placeholder="Ingresa el nombre">
                        @error('nombre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Apellido -->
                    <div>
                        <label for="apellido" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-hotel-gold"></i>
                            Apellido *
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-colors @error('apellido') border-red-500 @enderror" 
                               id="apellido" 
                               name="apellido" 
                               value="{{ old('apellido', $cliente->apellido) }}" 
                               required
                               placeholder="Ingresa el apellido">
                        @error('apellido')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Fila 2: Email y Teléfono -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-hotel-gold"></i>
                            Correo Electrónico
                        </label>
                        <input type="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-colors @error('email') border-red-500 @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $cliente->email) }}" 
                               placeholder="ejemplo@correo.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-phone mr-2 text-hotel-gold"></i>
                            Teléfono *
                        </label>
                        <input type="tel" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-colors @error('telefono') border-red-500 @enderror" 
                               id="telefono" 
                               name="telefono" 
                               value="{{ old('telefono', $cliente->telefono) }}" 
                               required
                               placeholder="+51 999 888 777">
                        @error('telefono')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Campo de Foto -->
                <div class="mb-8">
                    <label for="foto" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-camera mr-2 text-hotel-gold"></i>
                        Fotografía del Huésped
                    </label>
                    
                    <!-- Foto actual -->
                    @if($cliente->foto && Storage::disk('public')->exists($cliente->foto))
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $cliente->foto) }}" 
                                     alt="Foto actual de {{ $cliente->nombre }}" 
                                     class="w-20 h-20 object-cover rounded-full border-4 border-green-200 mr-4">
                                <div>
                                    <p class="text-green-800 font-medium">Foto actual del huésped</p>
                                    <p class="text-green-600 text-sm">La foto actual será reemplazada si subes una nueva</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-4 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-20 h-20 bg-hotel-navy text-white rounded-full border-4 border-gray-300 mr-4 flex items-center justify-center">
                                    <i class="fas fa-user text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-medium">Sin foto actual</p>
                                    <p class="text-gray-600 text-sm">Este huésped no tiene foto registrada</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Área de subida -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-hotel-gold transition-colors duration-200" 
                         onclick="document.getElementById('foto').click()">
                        <div id="photo-preview" class="hidden mb-4">
                            <img id="preview-image" src="" alt="Vista previa" class="w-32 h-32 object-cover rounded-full mx-auto border-4 border-gray-200">
                        </div>
                        
                        <div id="upload-area">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 mb-2">
                                <span class="font-medium text-hotel-gold">Haz clic para cambiar</span> o arrastra una nueva imagen
                            </p>
                            <p class="text-xs text-gray-500">
                                JPG, PNG, GIF, WEBP (máx. 2MB)
                            </p>
                        </div>
                    </div>
                    
                    <input type="file" 
                           id="foto" 
                           name="foto" 
                           accept="image/*"
                           class="hidden"
                           onchange="previewPhoto(this)">
                    
                    @error('foto')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Información del sistema -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h4 class="text-blue-800 font-medium text-sm mb-3">
                        <i class="fas fa-info-circle mr-2"></i>
                        Información del Sistema
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <small class="text-blue-600 font-medium">Fecha de registro:</small>
                            <div class="text-blue-800 font-semibold">{{ $cliente->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <div>
                            <small class="text-blue-600 font-medium">Última actualización:</small>
                            <div class="text-blue-800 font-semibold">{{ $cliente->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('clientes.show', $cliente) }}" 
                       class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                        <i class="fas fa-eye mr-2"></i>
                        Ver Detalles
                    </a>
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('clientes.index') }}" 
                           class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors duration-200 flex items-center">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium transition-colors duration-200 flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Actualizar Huésped
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Función para mostrar vista previa de la foto
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('photo-preview').classList.remove('hidden');
            document.getElementById('upload-area').classList.add('hidden');
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Drag and drop functionality
const uploadArea = document.querySelector('.border-dashed');
const fileInput = document.getElementById('foto');

uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    uploadArea.classList.add('border-hotel-gold', 'bg-yellow-50');
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    uploadArea.classList.remove('border-hotel-gold', 'bg-yellow-50');
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    uploadArea.classList.remove('border-hotel-gold', 'bg-yellow-50');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        previewPhoto(fileInput);
    }
});
</script>
@endsection
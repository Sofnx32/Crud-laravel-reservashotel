@extends('layouts.app')

@section('title', 'Nuevo Cliente')

@section('content')
<!-- Header de la sección -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-display font-bold text-hotel-navy mb-1">
            <i class="fas fa-user-plus mr-2 text-hotel-gold"></i>
            Nuevo Huésped
        </h2>
        <p class="text-gray-600 mb-0">Registra un nuevo huésped en el sistema hotelero</p>
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
        <div class="bg-gradient-to-r from-hotel-navy to-blue-800 text-white p-6">
            <h3 class="text-xl font-semibold mb-1">
                <i class="fas fa-user mr-2"></i>
                Información del Huésped
            </h3>
            <p class="text-blue-100 text-sm">Completa todos los campos requeridos para el registro</p>
        </div>
        
        <div class="p-8">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                
                <!-- Fila 1: Nombre y Apellido -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-hotel-gold"></i>
                            Nombre *
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hotel-gold focus:border-transparent transition-colors @error('nombre') border-red-500 @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre') }}" 
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
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hotel-gold focus:border-transparent transition-colors @error('apellido') border-red-500 @enderror" 
                               id="apellido" 
                               name="apellido" 
                               value="{{ old('apellido') }}" 
                               required
                               placeholder="Ingresa el apellido">
                        @error('apellido')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Fila 2: Email y Teléfono -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-hotel-gold"></i>
                            Correo Electrónico
                        </label>
                        <input type="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hotel-gold focus:border-transparent transition-colors @error('email') border-red-500 @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
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
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hotel-gold focus:border-transparent transition-colors @error('telefono') border-red-500 @enderror" 
                               id="telefono" 
                               name="telefono" 
                               value="{{ old('telefono') }}" 
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
                    
                    <!-- Área de subida -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-hotel-gold transition-colors duration-200" 
                         onclick="document.getElementById('foto').click()">
                        <div id="photo-preview" class="hidden mb-4">
                            <img id="preview-image" src="" alt="Vista previa" class="w-32 h-32 object-cover rounded-full mx-auto border-4 border-gray-200">
                        </div>
                        
                        <div id="upload-area">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 mb-2">
                                <span class="font-medium text-hotel-gold">Haz clic para subir</span> o arrastra una imagen
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

                <!-- Información adicional -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-info-circle text-blue-600 mr-3 mt-0.5"></i>
                        <div>
                            <h4 class="text-blue-800 font-medium text-sm">Información del Hotel</h4>
                            <p class="text-blue-700 text-sm mt-1">
                                Los datos proporcionados serán utilizados para gestionar las reservas y brindar un mejor servicio durante la estadía.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('clientes.index') }}" 
                       class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors duration-200 flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Registrar Huésped
                    </button>
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
@extends('admin.layouts.app')

@section('title', 'Yangi Kategoriya')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Yangi Kategoriya</h1>
    <p class="text-gray-600 mt-2">Yangi kategoriya yaratish</p>
</div>

<!-- Form Card -->
<div class="bg-white rounded-lg shadow-md max-w-2xl">
    <div class="p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Kategoriya Nomi <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    required
                    class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                    placeholder="Masalan: Elektronika"
                    oninput="generateSlug(this.value)"
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug Field -->
            <div class="mb-6">
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                    Slug (URL uchun)
                </label>
                <div class="relative">
                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        value="{{ old('slug') }}"
                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors bg-gray-50"
                        placeholder="elektronika"
                    >
                    <button type="button" onclick="generateSlug(document.getElementById('name').value)" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-indigo-600 hover:text-indigo-800 text-sm">
                        Yangilash
                    </button>
                </div>
                <p class="mt-2 text-sm text-gray-500">Agar bo'sh qoldirsangiz, avtomatik yaratiladi.</p>
                @error('slug')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Bekor qilish
                </a>
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>

    function generateSlug(title) {
        document.getElementById('slug').value = title
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
</script>
@endsection

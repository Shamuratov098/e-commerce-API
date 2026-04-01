@extends('admin.layouts.app')

@section('title', 'Kategoriyani Tahrirlash')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Kategoriyani Tahrirlash</h1>
    <p class="text-gray-600 mt-2">"{{ $category->name }}" kategoriyasini tahrirlash</p>
</div>

<!-- Form Card -->
<div class="bg-white rounded-lg shadow-md max-w-2xl">
    <div class="p-6">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Kategoriya Nomi <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $category->name) }}"
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
                        value="{{ old('slug', $category->slug) }}"
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

            <!-- Info Box -->
            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm text-blue-800">
                        <p class="font-medium">Ma'lumot:</p>
                        <p>Bu kategoriyada {{ $category->products()->count() }} ta mahsulot mavjud.</p>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Rostdan ham bu kategoriyani o\'chirmoqchimisiz? Bu amalni qaytarib bo\'lmaydi.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        O'chirish
                    </button>
                </form>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        Bekor qilish
                    </a>
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                        Saqlash
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function generateSlug(name) {
        const slug = name
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');

        document.getElementById('slug').value = slug;
    }
</script>
@endsection

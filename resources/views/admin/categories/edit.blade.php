@extends('admin.layouts.app')

@section('title', 'Kategoriyani Tahrirlash')

@section('content')

<!-- Breadcrumb -->
<div style="display:flex; align-items:center; gap:8px; margin-bottom:20px; font-size:13px;">
    <a href="{{ route('admin.categories.index') }}" style="color:#5750F1; text-decoration:none; font-weight:500;">Kategoriyalar</a>
    <svg width="14" height="14" fill="none" stroke="#8899A8" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
    <span style="color:#8899A8;">{{ $category->title }}</span>
    <svg width="14" height="14" fill="none" stroke="#8899A8" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
    <span style="color:#8899A8;">Tahrirlash</span>
</div>

<!-- Form Card -->
<div style="max-width:600px;">
    <div style="background:#fff; border-radius:12px; border:1px solid #F3F4F6; box-shadow:0 1px 4px rgba(0,0,0,.06); overflow:hidden;">

        <!-- Card Header -->
        <div style="padding:20px 24px; border-bottom:1px solid #F3F4F6;">
            <h2 style="font-size:15px; font-weight:700; color:#1C2434; margin:0 0 2px;">Kategoriya ma'lumotlari</h2>
            <p style="font-size:12px; color:#8899A8; margin:0;">Kategoriya ma'lumotlarini tahrirlang</p>
        </div>

        <!-- Info Box -->
        <div style="margin:16px 24px 0; padding:12px 16px; background:#EEF2FF; border-radius:8px; display:flex; align-items:center; gap:10px;">
            <svg width="16" height="16" fill="none" stroke="#5750F1" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span style="font-size:12px; color:#5750F1; font-weight:500;">
                Bu kategoriyada <strong>{{ $category->products()->count() }}</strong> ta mahsulot mavjud.
            </span>
        </div>

        <!-- Card Body -->
        <div style="padding:24px;">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" id="updateForm">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div style="margin-bottom:20px;">
                    <label for="title" style="display:block; font-size:13px; font-weight:600; color:#1C2434; margin-bottom:8px;">
                        Kategoriya Nomi <span style="color:#EF4444;">*</span>
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $category->title) }}"
                        required
                        oninput="generateSlug(this.value)"
                        placeholder="Masalan: Elektronika"
                        style="width:100%; padding:10px 14px; border:1.5px solid #E8E8E8; border-radius:8px; font-size:13px; color:#1C2434; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#5750F1'" onblur="this.style.borderColor='#E8E8E8'"
                    >
                    @error('title')
                        <p style="margin:6px 0 0; font-size:12px; color:#EF4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug Field -->
                <div style="margin-bottom:24px;">
                    <label for="slug" style="display:block; font-size:13px; font-weight:600; color:#1C2434; margin-bottom:8px;">
                        Slug <span style="font-size:12px; color:#8899A8; font-weight:400;">(URL uchun)</span>
                    </label>
                    <div style="position:relative;">
                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            value="{{ old('slug', $category->slug) }}"
                            placeholder="elektronika"
                            style="width:100%; padding:10px 100px 10px 14px; border:1.5px solid #E8E8E8; border-radius:8px; font-size:13px; color:#1C2434; outline:none; box-sizing:border-box; background:#F7F9FC;"
                            onfocus="this.style.borderColor='#5750F1'" onblur="this.style.borderColor='#E8E8E8'"
                        >
                        <button type="button" onclick="generateSlug(document.getElementById('title').value)"
                                style="position:absolute; right:8px; top:50%; transform:translateY(-50%); padding:4px 10px; background:#EEF2FF; color:#5750F1; border:none; border-radius:6px; font-size:12px; font-weight:600; cursor:pointer;">
                            Yangilash
                        </button>
                    </div>
                    <p style="margin:6px 0 0; font-size:12px; color:#8899A8;">Bo'sh qoldirsangiz, nomdan avtomatik yaratiladi.</p>
                    @error('slug')
                        <p style="margin:6px 0 0; font-size:12px; color:#EF4444;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div style="display:flex; align-items:center; justify-content:space-between; padding-top:20px; border-top:1px solid #F3F4F6;">

                    <!-- Delete Button -->
                    <button type="button" onclick="confirmDelete()"
                            style="display:inline-flex; align-items:center; gap:6px; padding:9px 16px; background:#FEF2F2; color:#DC2626; border:1.5px solid #FEE2E2; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; transition:all .2s;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        O'chirish
                    </button>

                    <div style="display:flex; align-items:center; gap:12px;">
                        <a href="{{ route('admin.categories.index') }}"
                           style="padding:9px 20px; border:1.5px solid #E8E8E8; color:#637381; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;">
                            Bekor qilish
                        </a>
                        <button type="submit"
                                style="padding:9px 20px; background:#5750F1; color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer;">
                            Saqlash
                        </button>
                    </div>
                </div>
            </form>

            <!-- Delete Form (alohida) -->
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function generateSlug(value) {
        document.getElementById('slug').value = value
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    function confirmDelete() {
        if (confirm('Rostdan ham bu kategoriyani o\'chirmoqchimisiz? Bu amalni qaytarib bo\'lmaydi.')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endsection

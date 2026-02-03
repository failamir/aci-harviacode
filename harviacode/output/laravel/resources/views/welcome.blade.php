@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="hero min-h-[60vh]">
        <div class="hero-content text-center">
            <div class="max-w-2xl">
                <h1 class="text-5xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    Laravel + FlyonUI
                </h1>
                <p class="py-6 text-lg text-base-content/70">
                    CRUD Generator dengan tampilan modern menggunakan FlyonUI,
                    Tailwind CSS 4, dan Tabler Icons. Siap untuk membangun aplikasi yang luar biasa!
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://flyonui.com/docs" target="_blank" class="btn btn-primary">
                        <span class="icon-[tabler--book] size-5"></span>
                        FlyonUI Docs
                    </a>
                    <a href="https://laravel.com/docs" target="_blank" class="btn btn-outline btn-primary">
                        <span class="icon-[tabler--brand-laravel] size-5"></span>
                        Laravel Docs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
            <div class="card-body items-center text-center">
                <span class="icon-[tabler--palette] size-12 text-primary mb-4"></span>
                <h2 class="card-title">FlyonUI Components</h2>
                <p class="text-base-content/60">
                    280+ komponen UI yang indah dan siap pakai untuk membangun interface modern.
                </p>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
            <div class="card-body items-center text-center">
                <span class="icon-[tabler--bolt] size-12 text-secondary mb-4"></span>
                <h2 class="card-title">Tailwind CSS 4</h2>
                <p class="text-base-content/60">
                    Framework utility-first CSS terbaru dengan performa tinggi dan fitur lengkap.
                </p>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
            <div class="card-body items-center text-center">
                <span class="icon-[tabler--database] size-12 text-accent mb-4"></span>
                <h2 class="card-title">CRUD Generator</h2>
                <p class="text-base-content/60">
                    Generate Model, Controller, Views, dan Routes secara otomatis dari database.
                </p>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats stats-vertical lg:stats-horizontal shadow mt-12 w-full">
        <div class="stat">
            <div class="stat-figure text-primary">
                <span class="icon-[tabler--components] size-10"></span>
            </div>
            <div class="stat-title">Components</div>
            <div class="stat-value text-primary">280+</div>
            <div class="stat-desc">FlyonUI Components</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <span class="icon-[tabler--icons] size-10"></span>
            </div>
            <div class="stat-title">Icons</div>
            <div class="stat-value text-secondary">5000+</div>
            <div class="stat-desc">Tabler Icons</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-accent">
                <span class="icon-[tabler--color-swatch] size-10"></span>
            </div>
            <div class="stat-title">Themes</div>
            <div class="stat-value text-accent">30+</div>
            <div class="stat-desc">Built-in Themes</div>
        </div>
    </div>

    <!-- Theme Toggle Demo -->
    <div class="card bg-base-100 shadow-lg mt-12">
        <div class="card-body">
            <h2 class="card-title">
                <span class="icon-[tabler--paint] size-6"></span>
                Coba Theme Toggle
            </h2>
            <p class="text-base-content/60">
                Klik icon 🌙/☀️ di navbar untuk beralih antara mode terang dan gelap.
            </p>
            <div class="flex flex-wrap gap-2 mt-4">
                <span class="badge badge-primary">Primary</span>
                <span class="badge badge-secondary">Secondary</span>
                <span class="badge badge-accent">Accent</span>
                <span class="badge badge-info">Info</span>
                <span class="badge badge-success">Success</span>
                <span class="badge badge-warning">Warning</span>
                <span class="badge badge-error">Error</span>
            </div>
        </div>
    </div>
@endsection
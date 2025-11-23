<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-bold" wire:navigate>
                    <span class="flex h-9 w-9 mb-1 items-center justify-center rounded-md bg-gradient-to-br from-blue-600 to-blue-700 text-white shadow-lg shadow-blue-500/30">
                        <x-app-logo-icon class="h-6 w-6 stroke-current" />
                    </span>
                    <div class="grid text-center text-xs leading-tight text-neutral-900 dark:text-neutral-100">
                        <span>Library</span>
                        <span>Management</span>
                        <span>System</span>
                    </div>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>

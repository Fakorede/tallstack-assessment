<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session()->has("message"))
                    <div class="flex items-center text-green-100 bg-green-500 font-bold text-lg px-4 py-3 text-center">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="flex justify-end mt-8 mr-6 text-2xl"
                    @can('add-staff')
                        <div>
                            <a class="px-3 py-2 text-sm text-white bg-gray-900 rounded" href="{{ route('add-staff') }}">
                                Add Staff
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    @livewire('staff-table')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

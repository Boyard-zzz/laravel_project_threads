<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nieuwe thread</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('threads.store') }}" class="bg-white p-6 rounded shadow space-y-3">
                @csrf
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Titel" class="w-full border-gray-300 rounded" required>
                <x-input-error :messages="$errors->get('title')" />
                <textarea name="description" rows="4" placeholder="Beschrijving" class="w-full border-gray-300 rounded" required>{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" />
                <button class="bg-indigo-600 text-white px-4 py-2 rounded">Toevoegen</button>
            </form>
        </div>
    </div>
</x-app-layout>
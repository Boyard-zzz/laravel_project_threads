<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nieuw topic in {{ $thread->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('topics.store', $thread) }}" class="bg-white p-6 rounded shadow space-y-3">
                @csrf
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Titel" class="w-full border-gray-300 rounded" required>
                <x-input-error :messages="$errors->get('title')" />
                <textarea name="body" rows="6" placeholder="Tekst" class="w-full border-gray-300 rounded" required>{{ old('body') }}</textarea>
                <x-input-error :messages="$errors->get('body')" />
                <button class="bg-indigo-600 text-white px-4 py-2 rounded">Plaatsen</button>
            </form>
        </div>
    </div>
</x-app-layout>
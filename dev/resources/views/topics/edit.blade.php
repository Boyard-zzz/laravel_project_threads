<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topic aanpassen</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('topics.update', $topic) }}" class="bg-white p-6 rounded shadow space-y-3">
                @csrf
                @method('PUT')
                <input type="text" name="title" value="{{ old('title', $topic->title) }}" class="w-full border-gray-300 rounded" required>
                <x-input-error :messages="$errors->get('title')" />
                <textarea name="body" rows="6" class="w-full border-gray-300 rounded" required>{{ old('body', $topic->body) }}</textarea>
                <x-input-error :messages="$errors->get('body')" />
                <x-primary-button>Opslaan</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
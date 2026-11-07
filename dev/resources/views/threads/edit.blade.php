<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Thread aanpassen</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('threads.update', $thread) }}" class="bg-white p-6 rounded shadow space-y-3">
                @csrf
                @method('PUT')
                <input type="text" name="title" value="{{ old('title', $thread->title) }}" class="w-full border-gray-300 rounded" required>
                <x-input-error :messages="$errors->get('title')" />
                <textarea name="description" rows="4" class="w-full border-gray-300 rounded" required>{{ old('description', $thread->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" />
                <x-primary-button>Opslaan</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
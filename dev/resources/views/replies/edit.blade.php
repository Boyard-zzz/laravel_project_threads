<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reactie aanpassen</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('replies.update', $reply) }}" class="bg-white p-6 rounded shadow space-y-3">
                @csrf
                @method('PUT')
                <textarea name="body" rows="5" class="w-full border-gray-300 rounded" required>{{ old('body', $reply->body) }}</textarea>
                <x-input-error :messages="$errors->get('body')" />
                <x-primary-button>Opslaan</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
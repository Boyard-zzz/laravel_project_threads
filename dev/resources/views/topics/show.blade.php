<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $topic->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white p-6 rounded shadow">
                <p class="text-sm text-gray-500 mb-2">door {{ $topic->user->username }} · {{ $topic->created_at->format('d-m-Y H:i') }}</p>
                @auth
                  @if (auth()->id() === $topic->user_id || auth()->user()->isAdmin())
                    <a href="{{ route('topics.edit', $topic) }}" class="text-sm text-indigo-600">Aanpassen</a>
                  @endif
                @endauth
                <p class="text-gray-700 whitespace-pre-line">{{ $topic->body }}</p>
            </div>

            <h3 class="font-bold text-lg">Reacties</h3>

            @forelse ($topic->replies as $reply)
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500 mb-1">{{ $reply->user->username }} · {{ $reply->created_at->format('d-m-Y H:i') }}</p>
                       @auth
                         @if (auth()->id() === $reply->user_id || auth()->user()->isAdmin())
                           <a href="{{ route('replies.edit', $reply) }}" class="text-sm text-indigo-600">Aanpassen</a>
                          @endif
                        @endauth
                    <p class="text-gray-700 whitespace-pre-line">{{ $reply->body }}</p>
                </div>
            @empty
                <p class="text-gray-500">Nog geen reacties.</p>
            @endforelse

            @auth
                <form method="POST" action="{{ route('replies.store', $topic) }}" class="bg-white p-6 rounded shadow space-y-3">
                    @csrf
                    <textarea name="body" rows="4" class="w-full border-gray-300 rounded" required>{{ old('body') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" />
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded">Reactie plaatsen</button>
                </form>
            @endauth
        </div>
    </div>
</x-app-layout>
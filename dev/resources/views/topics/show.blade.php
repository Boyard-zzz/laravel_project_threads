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
                        <a href="{{ route('topics.edit', $topic) }}" class="text-sm text-indigo-600 inline-block mb-2">Aanpassen</a>
                    @endif
                @endauth

                <p class="text-gray-700 whitespace-pre-line">{{ $topic->body }}</p>
            </div>

            <h3 class="font-semibold text-lg text-slate-900">
                Reacties <span class="text-slate-400 text-base">({{ $topic->replies->count() }})</span>
            </h3>

             @forelse ($topic->replies as $reply)
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between gap-4 mb-2">
                        <p class="text-sm text-slate-500">
                            <span class="font-medium text-slate-700">{{ $reply->user->username }}</span>
                            · {{ $reply->created_at->format('d-m-Y H:i') }}
                        </p>

                        @auth
                            <div class="flex items-center gap-3 text-sm">
                                @if (auth()->id() === $reply->user_id || auth()->user()->isAdmin())
                                    <a href="{{ route('replies.edit', $reply) }}" class="text-indigo-600 hover:underline">Aanpassen</a>
                                @endif

                                @if (auth()->user()->isAdmin())
                                    <form method="POST" action="{{ route('replies.destroy', $reply) }}" onsubmit="return confirm('Reactie verwijderen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">Verwijderen</button>
                                    </form>
                                @endif
                            </div>
                        @endauth
                    </div>

                    <p class="text-slate-700 whitespace-pre-line">{{ $reply->body }}</p>
                </div>
            @empty
                <p class="text-slate-500">Nog geen reacties.</p>
            @endforelse

            @auth
                <form method="POST" action="{{ route('replies.store', $topic) }}" class="bg-white p-4 rounded-lg shadow-sm border border-slate-200 space-y-3">
                    @csrf
                    <label for="body" class="block text-sm font-medium text-slate-700">Jouw reactie</label>
                    <textarea id="body" name="body" rows="4" class="w-full border-slate-300 rounded-md" required>{{ old('body') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" />
                    <x-primary-button>Reactie plaatsen</x-primary-button>
                </form>
            @endauth
        </div>
    </div>
</x-app-layout>
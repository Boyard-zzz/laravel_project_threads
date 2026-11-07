<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $thread->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white p-6 rounded shadow">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('threads.edit', $thread) }}" class="text-sm text-indigo-600 hover:underline inline-block mb-2">Aanpassen</a>
                    @endif
                @endauth

                <p class="text-gray-700 whitespace-pre-line">{{ $thread->description }}</p>
            </div>

            @auth
                <a href="{{ route('topics.create', $thread) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded">Nieuw topic</a>
            @endauth

            @forelse ($thread->topics as $topic)
                <div class="flex items-center gap-4 bg-white p-6 rounded shadow hover:bg-gray-50">
                    <a href="{{ route('topics.show', $topic) }}" class="block flex-1 min-w-0">
                        <h3 class="font-bold text-lg">{{ $topic->title }}</h3>
                        <p class="text-sm text-gray-500">door {{ $topic->user->username }}</p>
                    </a>

                    @auth
                        <div class="flex items-center gap-3">
                            @if (auth()->id() === $topic->user_id || auth()->user()->isAdmin())
                                <a href="{{ route('topics.edit', $topic) }}" class="text-sm text-indigo-600 hover:underline">Aanpassen</a>
                            @endif

                            @if (auth()->user()->isAdmin())
                                <form method="POST" action="{{ route('topics.destroy', $topic) }}" onsubmit="return confirm('Topic verwijderen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm text-red-600 hover:underline">Verwijderen</button>
                                </form>
                            @endif
                        </div>
                    @endauth
                </div>
            @empty
                <p class="text-gray-500">Nog geen topics in deze thread.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
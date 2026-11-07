<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Forum</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('threads.create') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded">Nieuwe thread</a>
                @endif
            @endauth

            @forelse ($threads as $thread)
                <div class="flex items-center gap-4 bg-white p-6 rounded shadow hover:bg-gray-50">
                    <a href="{{ route('threads.show', $thread) }}" class="block flex-1 min-w-0">
                        <h3 class="font-bold text-lg">{{ $thread->title }}</h3>
                        <p class="text-gray-600 truncate">{{ $thread->description }}</p>
                    </a>

                    @auth
                        @if (auth()->user()->isAdmin())
                            <form method="POST" action="{{ route('threads.destroy', $thread) }}" onsubmit="return confirm('Thread en alles erin verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm text-red-600">Verwijderen</button>
                            </form>
                        @endif
                    @endauth
                </div>
            @empty
                <p class="text-gray-500">Er zijn nog geen threads.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
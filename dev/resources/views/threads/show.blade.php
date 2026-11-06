<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $thread->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-700 whitespace-pre-line">{{ $thread->description }}</p>
            </div>

            @auth
                <a href="{{ route('topics.create', $thread) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded">Nieuw topic</a>
            @endauth

            @forelse ($thread->topics as $topic)
                <a href="{{ route('topics.show', $topic) }}" class="block bg-white p-6 rounded shadow hover:bg-gray-50">

                    @auth
                       @if (auth()->user()->isAdmin())
                          <form method="POST" action="{{ route('threads.destroy', $thread) }}" onsubmit="return confirm('Thread en alles erin verwijderen?')">
                             @csrf
                             @method('DELETE')
                             <button class="text-sm text-red-600">Thread verwijderen</button>
                           </form>
                        @endif
                    @endauth

                    <h3 class="font-bold text-lg">{{ $topic->title }}</h3>
                    <p class="text-sm text-gray-500">door {{ $topic->user->username }}</p>
                </a>
            @empty
                <p class="text-gray-500">Nog geen topics in deze thread.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
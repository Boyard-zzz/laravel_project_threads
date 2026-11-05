<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Forum</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @forelse ($threads as $thread)
                <a href="{{ route('threads.show', $thread) }}" class="block bg-white p-6 rounded shadow hover:bg-gray-50">
                    <h3 class="font-bold text-lg">{{ $thread->title }}</h3>
                    <p class="text-gray-600 truncate">{{ $thread->description }}</p>
                </a>
            @empty
                <p class="text-gray-500">Er zijn nog geen threads.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
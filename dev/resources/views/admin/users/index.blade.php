<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b">
                        <tr>
                            <th class="p-3">Naam</th>
                            <th class="p-3">Gebruikersnaam</th>
                            <th class="p-3">Rol</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="p-3">
                                    <a href="{{ route('admin.users.show', $user) }}" class="text-indigo-600">{{ $user->name }}</a>
                                </td>
                                <td class="p-3">{{ $user->username }}</td>
                                <td class="p-3">{{ $user->role }}</td>
                                <td class="p-3">
                                    @if ($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('User verwijderen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-sm text-red-600">Verwijderen</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
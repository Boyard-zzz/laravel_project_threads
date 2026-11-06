<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User: {{ $user->username }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <p class="text-green-600">{{ session('status') }}</p>
            @endif

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white p-6 rounded shadow space-y-3">
                @csrf
                @method('PUT')

                <label class="block text-sm">Naam</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded" required>
                <x-input-error :messages="$errors->get('name')" />

                <label class="block text-sm">Gebruikersnaam</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border-gray-300 rounded" required>
                <x-input-error :messages="$errors->get('username')" />

                <label class="block text-sm">E-mail</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded" required>
                <x-input-error :messages="$errors->get('email')" />

                <label class="block text-sm">Rol</label>
                <select name="role" class="w-full border-gray-300 rounded">
                    <option value="user" @selected($user->role === 'user')>user</option>
                    <option value="admin" @selected($user->role === 'admin')>admin</option>
                </select>
                <x-input-error :messages="$errors->get('role')" />

                <p class="text-sm text-gray-500">Aangemaakt: {{ $user->created_at }} · Laatst aangepast: {{ $user->updated_at }}</p>

                <x-primary-button>Opslaan</x-primary-button>
            </form>

            <a href="{{ route('admin.users.index') }}" class="text-indigo-600">← Terug naar overzicht</a>
        </div>
    </div>
</x-app-layout>
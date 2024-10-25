<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="p-4 bg-light rounded shadow">
        @csrf

        <!-- Nom -->
        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="text-danger mt-2" />
        </div>

        <!-- Adresse Email -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
        </div>

        <!-- Profil -->
        <div class="mb-3">
            <x-input-label for="profil" :value="__('Profil')" />
            <x-text-input id="profil" class="form-control" type="text" name="profil" :value="old('profil')" required autocomplete="userprofil" />
            <x-input-error :messages="$errors->get('profil')" class="text-danger mt-2" />
        </div>

        <!-- Mot de Passe -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
        </div>

        <!-- Confirmer le Mot de Passe -->
        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a class="btn btn-link p-0" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="btn btn-primary">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

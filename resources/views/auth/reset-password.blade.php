<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="p-4 bg-light rounded shadow-sm">
        @csrf

        <!-- Jeton de réinitialisation de mot de passe -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Adresse e-mail -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
        </div>

        <!-- Mot de passe -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
        </div>

        <div class="d-flex justify-content-end mt-4">
            <x-primary-button class="btn btn-primary">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

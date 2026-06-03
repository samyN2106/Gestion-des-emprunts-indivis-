@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
    <!-- Titre -->
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Connexion</h2>

    <!-- Formulaire -->
    <form action="/login" method="POST" class="space-y-4">
      @csrf

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
        <input type="email" name="email" id="email"
               class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300 focus:outline-none"
               required>
        @error('email')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Mot de passe -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-600">Mot de passe</label>
        <input type="password" name="password" id="password"
               class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300 focus:outline-none"
               required>
        @error('password')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Se souvenir de moi -->
      <div class="flex items-center">
        <input type="checkbox" name="remember" id="remember"
               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
        <label for="remember" class="ml-2 block text-sm text-gray-600">Se souvenir de moi</label>
      </div>

      <!-- Bouton -->
      <div>
        <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition">
          Connexion
        </button>
      </div>
    </form>

    <!-- Liens -->
    <p class="text-sm text-center text-gray-500 mt-4">
      Mot de passe oublié ?
      <a href="/password/reset" class="text-indigo-600 hover:underline">Réinitialiser</a>
    </p>
  </div>
</div>
@endsection

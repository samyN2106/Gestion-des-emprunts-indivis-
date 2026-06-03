@extends('layout.app')

@section('content')


<main  class="flex h-screen ">
  <x-sidebar></x-sidebar>
<div class="w-full h-full p-6">
  <x-header></x-header>

  @if(@session('success'))
      <div class="alert alert-success bg-green-300 w-full font-bold text-xl p-4 ">
        {{ session('success') }}
      </div>
  @endif


  <section class="mb-8">
  <!-- Titre -->
  <h1 class="text-2xl font-bold text-gray-800 mb-6">Enregistrer un client</h1>

  <!-- Formulaire -->
  <section class="bg-white shadow rounded p-6">
    <form action="{{route('add-client')}}" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      @csrf
      <!-- Nom -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Nom complet</label>
        <input type="text" name="name" placeholder="Ex: Jean Dupont" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>

      <!-- Email -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Email</label>
        <input type="email" name="email" placeholder="Ex: jean.dupont@email.com" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>
      @error('email')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <!-- Téléphone -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Téléphone</label>
        <input type="text" name="phone" placeholder="Ex: +225 07 00 00 00" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>
         @error('phone')
          <div class="alert alert-danger">{{ $message }}</div>
         @enderror

      <!-- Nationalité -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Nationalité</label>
        <input type="text" name="nationality" placeholder="Ex: Ivoirienne" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>
         @error('nationality')
          <div class="alert alert-danger">{{ $message }}</div>
         @enderror

      <!-- Numéro de pièce d’identité -->
      <div class="md:col-span-2">
        <label class="block text-gray-700 font-medium mb-2">N° pièce d'identité</label>
        <input type="text" name="identify_document" placeholder="Ex: CI-987-654" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>
      @error('identify_document')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <!-- Bouton -->
      <div class="md:col-span-2 flex justify-end">
        <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
          Enregistrer le client
        </button>
      </div>
    </form>
  </section>

  
  </section>

</div>
</main>

@endsection
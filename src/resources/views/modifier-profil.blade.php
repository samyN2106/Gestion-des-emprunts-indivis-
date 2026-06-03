@extends('layout.app')

@section('content')


<main  class="flex h-screen ">
  <x-sidebar></x-sidebar>
<div class="w-full h-full p-6">
   <x-header></x-header>
     <section class="mb-8">
  <!-- Titre -->
  <h1 class="text-2xl font-bold text-gray-800 mb-6">Modifier le profil utilisateur</h1>

  <!-- Formulaire -->
  <section class="bg-white shadow rounded p-6">
    <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Nom -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Nom complet</label>
        <input type="text" value="Jean Dupont"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>

      <!-- Email -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Email</label>
        <input type="email" value="jean.dupont@email.com"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>

      <!-- Téléphone -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Téléphone</label>
        <input type="text" value="+225 07 00 00 00"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>

      <!-- Nationalité -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Nationalité</label>
        <input type="text" value="Ivoirienne"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>

      <!-- Numéro de pièce d’identité -->
      <div class="md:col-span-2">
        <label class="block text-gray-700 font-medium mb-2">N° pièce d'identité</label>
        <input type="text" value="CI-987-654"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>

      <!-- Boutons -->
      <div class="md:col-span-2 flex justify-between">
        <button type="button" 
                class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded shadow">
          Annuler
        </button>
        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
          Enregistrer les modifications
        </button>
      </div>
    </form>
  </section>
</section>
</div>

</main> 

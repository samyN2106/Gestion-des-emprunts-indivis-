@extends('layout.app')

@section('content')

<main  class="flex h-screen ">
  <x-sidebar.sidebar></x-sidebar.sidebar>
<div class="w-full h-full p-6">
    <x-header.header></x-header.header>

  <section class="mb-8">
  <!-- Titre -->
  <h1 class="text-2xl font-bold text-gray-800 mb-6">Attribuer un prêt</h1>

  <!-- Formulaire d’attribution -->
  <section class="bg-white shadow rounded p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4">Informations du prêt</h2>
    <form action="{{route('attribution-pret')}}" method="post" class="grid 
    grid-cols-1 md:grid-cols-2 gap-6">
    @csrf
      <!-- Sélection du client -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Client</label>
        <input disabled value="{{$user->name}}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
      </div>
      <input type="hidden" name="user_id" value="{{$user->id}}">
      <!-- Montant -->
      <div>
        <label class="block  text-gray-700 font-medium mb-2">Montant</label>
        <input  name="amount" type="number" placeholder="Ex: 50000" 
               class="w-full border border-gray-300 rounded px-3 py-2  focus:border-none">
                  @error('amount')
              <p class="text-red-400">{{$message}}</p>
            @enderror
      </div>
         

      <!-- Durée -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Durée</label>
        <div class="flex gap-4">
          <input  name='duration' type="number" placeholder="Ex: 5" 
                class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">

          <select name="period_duration" class="w-[30%] border border-gray-400 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
            <option>--Periode--</option>
            <option value="ans">ans</option>
            <option value="mois">mois</option>
          </select>
           @error('period_duration')
              <p class="text-red-400">{{$message}}</p>
            @enderror
             @error('duration')
              <p class="text-red-400">{{$message}}</p>
            @enderror
        </div>
        
      </div>

      <!-- interval remboursement -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">periode de remboursement</label>
        <div class="flex gap-4">
          <select name="period_repay" class="w-full border border-gray-400 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
            <option>--Periode--</option>
            <option value="Annuites">Annuités</option>
            <option value="Mensualites">Mensualites</option>
            <option value="semestrialites">semestrialites</option>
            <option value="trimestrialite">trimestrialites</option>
          </select>
        </div>
             @error('period_repay')
              <p class="text-red-400">{{$message}}</p>
            @enderror

      </div>
  
      <!-- Taux d’intérêt -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Taux d’intérêt (%)</label>
        <input name="interest_rate" type="number" step="0.01" placeholder="Ex: 6" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
               @error('interest_rate')
                     <p class="text-red-400">{{$message}}</p>
               @enderror
      </div>

      <!-- Modalité -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Modalité</label>
        <select name="modality_id" class="w-full border border-gray-400 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
          <option>--Modalite--</option>
          @foreach($modalities as $id => $modality)
            <option value="{{$id}}">{{$modality}}</optio  n>
          @endforeach
        </select>
        @error('modality_id')
              <p class="text-red-400">{{$message}}</p>
            @enderror
      </div>

      <!-- Bouton -->
      <div class="md:col-span-2 flex justify-end">
        <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
          Attribuer le prêt
        </button>
      </div>
    </form>
  </section>


</section>
</div>
</main>  
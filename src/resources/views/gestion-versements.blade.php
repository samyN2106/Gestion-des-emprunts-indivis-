@extends('layout.app')

@section('content')

<main  class="flex h-screen ">
  <x-sidebar.sidebar></x-sidebar.sidebar>
<div class="w-full h-full p-6">
    <x-header.header></x-header.header>
  <section class="mb-8">
  <!-- Titre -->
  <h1 class="text-2xl font-bold text-gray-800 mb-6">Gestion des versements</h1>

  
  <!-- Formulaire d’attribution -->
  <section class="bg-white shadow rounded p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4">
          
        @switch ($modality) 
          @case('1')
            Amortissement variable
            @break
          @case('2')
            Amortissement constant
            @break
          @case('3')
            Annuité constante
            @break
          
          @default
            Type inconnu
            @break

          
        @endswitch
    
    </h2>
    
  <form action="{{route('gestionVersements',['loan'=> $loan, 'modality'=>$modality])}}" method="POST">
    @csrf
    {{-- <input type="hidden" name="loan" value="{{$loan}}"> --}}
    @switch($modality)
      @case('1')
        @for($i=1; $i<=$periode; $i++)
           <div class="mb-2">
                <label for="amortissement_{{ $i }}">versement {{ $i }}</label>
                <input type="number" name="versement[]" id="amortissement_{{ $i }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
            </div>
        @endfor
        @break

      @case('2')
          <div class="mb-2">
            <label for="amortissement_constant">Entrez le montant de l'amortissement</label>
            <input type="number" name="versement" id="amortissement_constant" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
          </div>
          @break

      
      @case('3')
          <div class="mb-2">
            <label for="annuite_constante">Entrez le montant de l'annuite constante</label>
            <input type="number" name="versement" id="annuite_constante" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
          </div>
          @break
    @endswitch



      <div class="md:col-span-2 mt-2 flex justify-end">
        <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
          Valider les versements
        </button>
      </div>
   
</form>

  </section>


</section>
</div>
</main>  
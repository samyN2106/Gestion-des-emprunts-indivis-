@extends('layout.app')

@section('content')

<main  class="flex h-screen ">
  <x-sidebar></x-sidebar>
<section class="w-full h-full p-6">
  <x-header></x-header>
  <section class="mb-8">
  <h2 class="text-xl font-semibold mb-4">Pret en cours</h2>

        @if(@session('success'))
      <div class="alert alert-success bg-green-300 w-full font-bold text-xl p-4 ">
        {{ session('success') }}
      </div>
  @endif
  <!-- Conteneur scrollable -->
  <div class="overflow-y-auto max-h-[600px] border rounded">
    <table class="w-full border-collapse">
      <thead class="bg-gray-200 sticky top-0">
        <tr>
          <th class="p-3 text-left">Nom du client</th>
          <th class="p-3 text-left">N° pièce d'identité</th>
          <th class="p-3 text-left">Modalité</th>
          <th class="p-3 text-left">Taux d'interet</th>
          <th class="p-3 text-left">Montant</th>
          <th class="p-3 text-left">Durée</th>
          <th class="p-3 text-left">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white">
        @foreach($loans as $loan)
        <tr class="border-b hover:bg-gray-50">
          <td class="p-3">{{$loan->user->name}} </td>
          <td class="p-3">{{$loan->user->identify_document}}</td>
          <td class="p-3">{{$loan->modality->modality_label}}</td>
          <td class="p-3">{{$loan->interest_rate}}%</td>
          <td class="p-3">{{$loan->amount}} FCFA</td>
          <td class="p-3">{{$loan->duration}}</td>
          <td class="p-3">
             <button class="text-indigo-600 hover:underline" ><a href="{{route('details',['loan' => $loan->id])}}">Voir détails</a></button>
          </td>
        </tr>
        @endforeach
   
         <div class="pagination-container">
              {{ $loans->links() }}
          </div>
  
        <!-- autres emprunts -->
      </tbody>
    </table>
  </div>
  </section>
</section>


{{-- <!-- Section détails -->
<div id="details" class="mt-8 hidden bg-white shadow rounded p-6">
  <h2 class="text-xl font-semibold mb-4">Détails de l’emprunt</h2>
  <p><span class="font-semibold">Client :</span> <span id="detail-client"></span></p>
  <p><span class="font-semibold">Montant :</span> <span id="detail-montant"></span></p>
  <p><span class="font-semibold">Durée :</span> <span id="detail-duree"></span></p>
  <p><span class="font-semibold">Taux d’intérêt :</span> <span id="detail-taux"></span></p>
  <p><span class="font-semibold">Modalité :</span> <span id="detail-modalite"></span></p>
</div> --}}

</main>
{{-- <script>
  function showDetails(id) {
    // Exemple simple : afficher la section détails
    document.getElementById('details').classList.remove('hidden');
    // Ici tu peux charger dynamiquement les infos du prêt via JS/Ajax
  }
</script> --}}


@endsection 
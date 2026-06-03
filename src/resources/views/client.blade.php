@extends('layout.app')

@section('content')
{{-- @dd($users) --}}
<main class="h-screen flex">
  <x-sidebar></x-sidebar>
  <!-- Actions -->
  <aside class="w-full h-full p-6">
    <x-header></x-header>

          @if(@session('success'))
      <div class="alert alert-success bg-green-300 w-full font-bold text-xl p-4 ">
        {{ session('success') }}
      </div>
  @endif
    <div class="flex justify-end flex-wrap gap-4 mb-6">
      <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
        <a href="{{route('add-client')}}">
        Ajouter client
        </a>
      </button>
    </div>

    <!-- Liste des clients -->
<section class="bg-white shadow rounded p-6">
  <!-- En-tête avec titre + recherche -->
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Liste des clients</h2>
    <div class="flex items-center space-x-2">
      <form action="{{route('client')}}" method="get">
        @csrf
        <input type="text" name="search" value="{{request('search')}}" placeholder="Rechercher un client..." 
              class="border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1 rounded">
          Rechercher
        </button>
      </form>
    </div>
  </div>

  <!-- Conteneur scrollable -->
  <div class="overflow-y-auto max-h-[500px] border rounded">
    <table class="w-full border-collapse">
      <thead class="bg-gray-200 sticky top-0">
        <tr>
          <th class="p-3 text-left">Nom</th>
          <th class="p-3 text-left">Email</th>
          <th class="p-3 text-left">Téléphone</th>
          <th class="p-3 text-left">Nationalité</th>
          <th class="p-3 text-left">N° pièce d'identité</th>
          <th class="p-3 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr class="border-b hover:bg-gray-50">
          <td class="p-3">{{$user->name}}</td>
          <td class="p-3">{{$user->email}}</td>
          <td class="p-3">{{$user->phone}}</td>
          <td class="p-3">{{$user->nationality}}</td>
          <td class="p-3">{{$user->identify_document}}</td>
          <td class="p-3">
              <button class="text-blue-600 hover:underline"><a href="{{route('attribution-pret',['client' => $user->id])}}">Attribuer un pret</a></button>
             <button class="text-blue-600 hover:underline ml-2"><a href="{{route('modifier-profil')}}">Modifier</a></button>
            <button class="text-red-600 hover:underline ml-2">Supprimer</button>
          </td>
        </tr> 
        @endforeach

          <div class="pagination-container">
              {{ $users->links() }}
          </div>

      </tbody>
    </table>
  </div>
</section>


  </aside>
</main>

@endsection
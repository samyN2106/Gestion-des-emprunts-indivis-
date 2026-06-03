@extends('layout.app')

@section('content')

<main  class="flex h-screen ">
    <x-sidebar></x-sidebar>
    <aside class="w-full h-full p-6">
       <x-header></x-header>
      <section class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Liste des clients</h2>
                <table class="w-full border-collapse bg-white shadow rounded">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 text-left">Nom</th>
                            <th class="p-3 text-left">Montant</th>
                            <th class="p-3 text-left">Modalité</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="p-3">Jean Dupont</td>
                            <td class="p-3">50 000 €</td>
                            <td class="p-3">Annuités constantes</td>
                            <td class="p-3">
                                <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                    Voir détails
                                </button>
                            </td>
                        </tr>
                        <!-- autres clients -->
                    </tbody>
                </table>
            </section>

            <!-- Tableau d’amortissement -->
            <section class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Tableau d’amortissement</h2>
                <table class="w-full border-collapse bg-white shadow rounded">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3">Année</th>
                            <th class="p-3">Annuité</th>
                            <th class="p-3">Intérêts</th>
                            <th class="p-3">Amortissement</th>
                            <th class="p-3">Capital restant dû</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="p-3">1</td>
                            <td class="p-3">5 000 €</td>
                            <td class="p-3">2 000 €</td>
                            <td class="p-3">3 000 €</td>
                            <td class="p-3">47 000 €</td>
                        </tr>
                        <!-- autres lignes -->
                    </tbody>
                </table>
            </section>

            <!-- Graphiques -->
            <section>
                <h2 class="text-xl font-semibold mb-4">Analyse des emprunts</h2>
                <div class="bg-white shadow rounded p-6">
                    <!-- Ici tu intègres Chart.js ou ApexCharts -->
                    <canvas id="empruntsChart"></canvas>
                </div>
            </section>
        </aside>

</main>

@endsection
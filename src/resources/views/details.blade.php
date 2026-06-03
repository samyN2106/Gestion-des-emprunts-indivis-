@extends('layout.app')
@section('content')
<main  class="flex h-screen ">
    <x-sidebar></x-sidebar>
<div class="w-full h-full p-6">
   <x-header></x-header>
  <!-- Informations du client -->
  <section class="bg-white shadow rounded p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4">Informations du client</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <p><span class="font-semibold">Nom :</span> {{$loan_details->user->name}}</p>
      <p><span class="font-semibold">N° pièce d'identité :</span>  {{$loan_details->user->identify_document}}</p>
      <p><span class="font-semibold">Montant emprunté :</span> {{$loan_details->amount}} FCFA</p>
      <p><span class="font-semibold">Durée :</span> {{$loan_details->duration}} {{$loan_details->period_duration}}</p>
      <p><span class="font-semibold">Date d'emprunt :</span> {{$date_sans_heure}}</p>
      <p><span class="font-semibold">Taux d’intérêt :</span> {{$loan_details->interest_rate}}%</p>
      <p><span class="font-semibold">Periode remboursement :</span> {{$loan_details->period_repay}}</p>
      <p><span class="font-semibold">Modalité :</span>  {{$loan_details->modality->modality_label}}</p>
      <p><span class="font-semibold">Nombre de versements :</span> {{ $loan_details->versements->count() }}</p>
    </div>
  </section>

  <!-- Tableau d’amortissement -->
  <section class="bg-[#c8c8c8] shadow rounded p-6">
    <h2 class="text-xl font-semibold mb-4">Tableau d’amortissement</h2>
    <div class="overflow-y-auto max-h-[370px] border rounded">
      <table class="w-full border-collapse">
        <thead class="bg-gray-200 sticky top-0">
          <tr>
            <th class="p-3 text-left">Periode</th>
            <th class="p-3 text-left">Dette en debut de periode</th>
            <th class="p-3 text-left">Intérêts</th>
            <th class="p-3 text-left">Amortissement</th>
            <th class="p-3 text-left">Annuité</th>
            <th class="p-3 text-left">Capital restant dû</th>
            <th class="p-3 text-left"></th>
          </tr>
        </thead>
        <tbody>
   
            @if($loan_details->modality->modality_label == 'Amortissement variable' || $loan_details->modality->modality_label == 'Amortissement constant')
              @php
                  // On initialise le capital de départ avec le montant total initial du prêt
                  $capitalRestant = $loan_details->amount;
                  $taux = $loan_details->interest_rate / 100;
              @endphp

              @foreach ($loan_details->versements as $i => $versement)
                  @php
                      // 1. La dette en début de période est le capital restant dû au tour précédent
                      $detteDebut = $capitalRestant;

                      // 2. L'intérêt se calcule toujours sur le capital restant dû en début de période
                      $interet = $detteDebut * $taux;

                      // 3. L'amortissement correspond à la part de capital remboursée par ce versement
                      $amortissement = $versement->amount;

                      // 4. L'annuité totale est la somme de l'amortissement (capital) et de l'intérêt
                      $annuite = $amortissement + $interet;

                      // 5. La dette en fin de période est la dette de début moins le capital amorti
                      $detteFin = $detteDebut - $amortissement;

                      // Crucial : On met à jour la variable pour le prochain tour de la boucle
                      $capitalRestant = $detteFin;
                  @endphp

                  <tr class="border-b hover:bg-[#b9b9b9]">
                      <!-- Date du versement -->
                      <td class="p-3">{{ $versement->date_versement }}</td>
                      
                      <!-- Dette en début de période -->
                      <td class="p-3">{{ number_format($detteDebut, 0, ',', ' ') }} FCFA</td>
                      
                      <!-- Intérêt payé (Dégressif) -->
                      <td class="p-3 text-red-600">-{{ number_format($interet, 0, ',', ' ') }} FCFA</td>
                      
                      <!-- Amortissement (Montant versé) -->
                      <td class="p-3 text-green-600">+{{ number_format($amortissement, 0, ',', ' ') }} FCFA</td>
                      
                      <!-- Annuité (Total payé avec les intérêts) -->
                      <td class="p-3 font-semibold text-indigo-700">{{ number_format($annuite, 0, ',', ' ') }} FCFA</td>
                      
                      <!-- Dette en fin de période -->
                      <td class="p-3 text-gray-600">{{ number_format(max(0, $detteFin), 0, ',', ' ') }} FCFA</td>
                      
                      <!-- Bouton d'action -->
                      <td class="p-3">
                          <button class="text-red-700 hover:underline">Hachurer</button>
                      </td>
                  </tr>
              @endforeach
            @else
              @if($loan_details->modality->modality_label == 'annuite constante')
                @php
                    // 1. Nombre total d'échéances basées sur le nombre de versements
                    $n = $loan_details->versements->count();
                    
                    // 2. Le taux d'intérêt sous forme décimale (ex: 0.05 pour 5%)
                    $r = $loan_details->interest_rate / 100;
                    
                    // 3. Montant initial du prêt
                    $capitalInitial = $loan_details->amount;

                    // 4. Formule du PREMIER amortissement (théorique)
                    // V1 = (Capital * r) / ((1 + r)^n - 1)
                    $premierAmortissement = ($capitalInitial * $r) / (((1 + $r) ** $n) - 1);
                @endphp

                @foreach ($loan_details->versements as $i => $versement)
                    @php
                        // ---- LOGIQUE DE CALCULS ACTUARIELS PAR LIGNE ----

                        // 1. Calcul de l'amortissement de la période (Progression géométrique)
                        // Vi = V1 * (1 + r)^i
                        $amortissement = $premierAmortissement * ((1 + $r) ** $i);

                        // 2. Calcul de la dette de FIN de période (Formule actuarielle que vous avez commencée)
                        // Capital restant dû = CapitalInitial * [((1+r)^n - (1+r)^(i+1)) / ((1+r)^n - 1)]
                        $detteFin = $capitalInitial * (((1 + $r) ** $n - (1 + $r) ** ($i + 1)) / (((1 + $r) ** $n) - 1));

                        // 3. La dette de DEBUT de période est égale à la dette de fin + l'amortissement actuel
                        $detteDebut = $detteFin + $amortissement;

                        // 4. L'intérêt de la période (se calcule sur la dette de début)
                        $interet = $detteDebut * $r;

                        // Sécurité pour la toute dernière ligne afin d'éviter les arrondis de centimes de PHP
                        if ($i == ($n - 1)) {
                            $detteFin = 0;
                        }
                    @endphp

                    <tr class="border-b hover:bg-[#b9b9b9]">
                        <!-- 1. Date du versement -->
                        <td class="p-3">{{ $versement->date_versement }}</td>

                        <!-- 2. Dette en début de période -->
                        <td class="p-3">{{ number_format($detteDebut, 0, ',', ' ') }} FCFA</td>

                        <!-- 3. Intérêt payé (Dégressif) -->
                        <td class="p-3 text-red-600">{{ number_format($interet, 0, ',', ' ') }} FCFA</td>

                        <!-- 4. Amortissement (Part du capital remboursé, Progressif) -->
                        <td class="p-3 text-green-600">{{ number_format($amortissement, 0, ',', ' ') }} FCFA</td>

                        <!-- 5. Annuité (Le montant versé, Constant) -->
                        <td class="p-3 font-semibold text-indigo-700">{{ number_format($versement->amount, 0, ',', ' ') }} FCFA</td>

                        <!-- 6. Dette en fin de période -->
                        <td class="p-3 text-gray-600">{{ number_format(max(0, $detteFin), 0, ',', ' ') }} FCFA</td>

                        <!-- 7. Action -->
                        <td class="p-3">
                            <button class="text-red-700 hover:underline">Hachurer</button>
                        </td>
                    </tr>
                @endforeach
              @endif
            @endif
        </tbody>
      </table>
    </div>
  </section>
</div>
</main>
@endsection


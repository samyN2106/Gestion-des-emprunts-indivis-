<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Modality;
use Illuminate\Http\RedirectResponse;
use App\Models\Loan;
use App\Models\Versement;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Break_;

class LoanController extends Controller
{

    public function index(): View{
        $loans=Loan::with('user','modality')->latest()->paginate(15);
        return view('emprunt',compact('loans'));
    }

    public function AssignLoan(Request $request): View {
        $clientId=$request->input('client');
        $user=User::findOrFail($clientId); 
        $modalities=Modality::all()->pluck('modality_label','id');
        return view('attribution-pret',compact('user','modalities'));
    }


    public function LoanStorage(Request $request): RedirectResponse{
            $validated=$request->validate([
                'user_id' => ['required'],
                'amount' => ['required'],
                'duration' => ['required'],
                'period_duration' => ['required'],
                'period_repay' => ['required'],
                'interest_rate' => ['required'],
                'modality_id' => ['required'],
            ]);
            $duration=$validated['duration'];
            $period_duration=$validated['period_duration'];
            $period_repay=$validated['period_repay'];
            $periode = 0;
            $interval = '';

            switch ($period_repay) {
                case "Annuites":
                    $periode = ($period_duration === 'ans') ? $duration : $duration * 12;
                    $interval = 'year';
                    break;

                case "Mensualites":
                    $periode = ($period_duration === 'ans') ? $duration * 12 : $duration;
                    $interval = 'month';
                    break;

                case "Semestrialites":
                    $periode = ($period_duration === 'ans') ? $duration * 2 : ($duration / 6);
                    $interval = '6 months';
                    break;

                case "Trimestrialites":
                    $periode = ($period_duration === 'ans') ? $duration * 4 : ($duration / 3);
                    $interval = '3 months';
                    break;
            }

            $loan = Loan::create($validated);
            $startDate = Carbon::now();

            for ($i = 1; $i <= $periode; $i++) {
                switch ($period_repay) {
                    case "Annuites":
                        $dateVersement = $startDate->copy()->addYears($i);
                        break;

                    case "Mensualites":
                        $dateVersement = $startDate->copy()->addMonths($i);
                        break;

                    case "Semestrialites":
                        $dateVersement = $startDate->copy()->addMonths($i * 6);
                        break;

                    case "Trimestrialites":
                        $dateVersement = $startDate->copy()->addMonths($i * 3);
                        break;
                    
                    default:
                        $dateVersement = $startDate->copy(); // valeur par défaut pour éviter l’erreur
                        break;
                }

                Versement::create([
                    'loan_id' => $loan->id,
                    'periode' => $i,
                    'date_versement' => $dateVersement->toDateString(), // YYYY-MM-DD
                    'statut' => 'en_attente'
                ]);
            }
            return redirect()->route('gestionVersements',['loan'=>$loan->id,'modality'=>$validated['modality_id'],'periode'=>$periode]);
    }

    public function gestionVersements(Request $request): View{
            $loan=$request->input('loan');
            $modality=$request->input('modality');
            $periode=$request->input('periode');
            return view('gestion-versements',compact('loan','modality','periode'));
    }
                        
    public function versementStorage(Request $request): RedirectResponse{
        $loan_id=$request->input('loan');
        $modality=$request->input('modality');

            if($modality==1){
                $validated=$request->validate([
                'versement.*' => 'required|numeric|min:0',
                ]);
                $versements=Versement::where('loan_id',$loan_id)->orderBy('periode')->get();            
                foreach ($versements as $i => $versement) {
                    $versement->update([
                        'amount'=> $validated['versement'][$i]
                    ]);
                };
            }else{
                $validated=$request->validate([
                'versement' => 'required|numeric|min:0',
                ]);
                $versements=Versement::where('loan_id',$loan_id)->orderBy('periode')->get();            
                foreach ($versements as $versement) {
                    $versement->update([
                        'amount'=> $validated['versement']
                    ]);
                };
            }

        return redirect('emprunts')->with('success','pret attribue avec succes');

    }




    public function LoanDetails(Request $request): View{
        $loan_id=$request->input('loan');
        $loan_details = Loan::findOrFail($loan_id);
        $loan_details->load(['user', 'modality', 'versements'=>function($query){
            $query->orderBy('date_versement', 'asc');
        }]);
        $date_sans_heure = $loan_details->created_at->toDateString();
        return view('details',compact('loan_details','date_sans_heure'));
    }
    
}

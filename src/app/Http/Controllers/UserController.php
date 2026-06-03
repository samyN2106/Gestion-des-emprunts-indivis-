<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
    public function ClientsList(Request $request):View {
        $query=$request->input('search')??null;
        if($query){
            $users = User::where('name', 'LIKE', "%{$query}%")
            ->latest()
            ->paginate(15);
        }else{
            $users=User::latest()->paginate(15);
        };
        return view('client',compact('users'));
    }

    public function form_add_client():View{
        return view('add-client');
    }

    public function store_client(Request $request): RedirectResponse{

        $valideted=$request->validate([
            'name' => ['required'],
            'email' => ['email'],
            'nationality' => ['required'],
            'identify_document' => ['required'],
            'phone' => ['required', 'integer']
        ]);

        User::create($valideted);
        
        return redirect()->route('add-client')->with('success','Le client a bien ete cree');
    }
}

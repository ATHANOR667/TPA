<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\TPA_Auth_Pro_Request;
use App\Http\Requests\Auth\TPA_Auth_Request;
use App\Models\particulier;
use App\Models\professionnel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TPA_Auth_Controller extends Controller
{
    public function inscription()
    {
        return view('TPA.Auth.part');
    }

    public function inscription_process(TPA_Auth_Request $request)
    {
        $part = $request->validated();
        particulier::create([
            'name'=>$part['name'],
            'prenom'=>$part['prenom'],
            'date_naiss'=>$part['date_naiss'],
            'num_cni'=>$part['num_cni'],
            'num_tel'=> $part['num_tel'],
            'password'=>bcrypt($part['password']),
            'email'=>$part['email']
        ]) ;
        return redirect('TPA\login')->with('message' ,'Inscription reussie , veuillez voous connecter');

    }

    public function login()
    {
        return view('TPA.Auth.login');
    }

    public function login_process(LoginRequest $request)
    {
        try {
            $user = particulier::where('email',$request->validated(['email']))->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $user = false;
            return redirect()->route('TPA.login')->withErrors([
                'email' => 'Vérifiez votre email ',
            ]);
        }
        //dd($user);
        if ($user && Hash::check($request->validated(['password']),$user->password))
        {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended(route('TPA.acceuil_part',['part'=>$user->id]));
        }
        return redirect()->route('TPA.login')->withErrors([
            'password' => 'Vérifiez votre mot de passe'
        ]);

        /*$credentials = $request->validated();
        $credentials =Auth::guard('particulier')->attempt($credentials);
        //dd($request->validated());
        dd($credentials);

        if ($credentials) {
            $request->session()->regenerate();
            return redirect()->intended(route('TPA.acceuil'));
        }
        return redirect()->route('TPA.login')->withErrors([
            'email' => 'Vérifiez votre email ',
            'password' => 'Vérifiez votre mot de passe'
        ]);*/


    }

    public function logout()
    {
        Auth::logout();
        return to_route('TPA.acceuil');
    }

    public function inscription_pro()
    {
        return view('TPA.Auth.pro');
    }

    public function inscription_pro_process(TPA_Auth_Pro_Request $request,particulier $part)
    {
        try {
            $user = particulier::where('email',$request->validated(['email']))->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $user = false;
            return redirect()->route('TPA.inscription_pro',['part'=>$part])->withErrors([
                'email' => 'Vérifiez que l`email est bien celle de votre compte particulier ',
            ]);
        }
        $pro = $request->validated();
        professionnel::create([
            'name'=>$part->name,
            'prenom'=>$part->prenom,
            'date_naiss'=>$part->date_naiss,
            'num_cni'=>$part->num_cni,
            'num_tel'=> $part->num_tel,
            'password'=>bcrypt($pro['password']),
            'email'=>$pro['email']
        ]);
        return to_route('TPA.login_pro',['part'=>$part])->with('message' ,'Inscription reussie , veuillez voous connecter');

    }

    public function login_pro(particulier $part)
    {
        return view('TPA.Auth.login_pro')->with('part',$part);
    }

    public function login_pro_process(LoginRequest $request, particulier $part)
    {
        try {
            $pro = professionnel::where('email',$request->validated(['email']))->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $pro = false;
            return redirect()->route('TPA.login_pro',['part'=>$part])->withErrors([
                'email' => 'Vérifiez que l`email est bien celle de votre compte professionel ',
            ]);
        }
        //dd($user);
        if ($pro && Hash::check($request->validated(['password']),$pro->password))
        {
            Auth::login($pro);
            $request->session()->regenerate();
            return redirect()->intended(route('TPA.acceuil_pro',['pro'=>$pro,'part'=>$part]));
        }
        return redirect()->route('TPA.login')->withErrors([
            'password' => 'Vérifiez votre mot de passe'
        ]);

        /*$credentials = $request->validated();
        $credentials =Auth::guard('particulier')->attempt($credentials);
        //dd($request->validated());
        dd($credentials);

        if ($credentials) {
            $request->session()->regenerate();
            return redirect()->intended(route('TPA.acceuil'));
        }
        return redirect()->route('TPA.login')->withErrors([
            'email' => 'Vérifiez votre email ',
            'password' => 'Vérifiez votre mot de passe'
        ]);*/


    }








}

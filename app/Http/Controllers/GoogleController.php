<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function googlepage()
    {
        return socialite::driver('google')->redirect();
    }
    public function googlecallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser)

            {
       
                Auth::login($finduser);
      
                return redirect()->intended('redirect');
       
            }

            else

            {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make('12345678'),
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('redirect');
            }
      
        } 
        catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

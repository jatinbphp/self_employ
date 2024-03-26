<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
  
class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {

        return Socialite::driver('facebook')->redirect();
    }
           
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        // try {

            try {
                $user = Socialite::driver('facebook')->user();
            } catch (InvalidStateException $e) {
                $user = Socialite::driver('facebook')->stateless()->user();
            }

            $finduser = User::where('facebook_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
       
                return redirect()->to('/');
         
            }else{
                $username=explode(" ",$user->name);
                if (count($username) < 2) {
                    $first = $username[0];
                    $second = "";
                } else {
                    $first = $username[0];
                    $second = $username[1];
                }

                $newUser = User::updateOrCreate(['email' => $user->email],[
                    'first_name' => $first,
                    'last_name' => $second,
                    'username' => str_replace(' ', '', $user->name),
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456dummy'),
                    'language_id' => '1',
                    'category_id' => '1',
                    'role_id' => 2
                ]);
        
                Auth::login($newUser);
        
                return redirect()->to('/');
            }
       
        // } catch (Exception $e) {
        //     dd($e->getMessage());
        // }
    }
}
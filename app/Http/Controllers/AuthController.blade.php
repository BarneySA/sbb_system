<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Validator;
use Auth;
use Mail;

use Carbon\Carbon;

use App\Attribue;
use App\Category;
use App\Configuration;
use App\Feedback;
use App\Product;
use App\SecurityToken;
use App\Tracking;
use App\Transaction;
use App\User;

class AuthController extends Controller 
{
    public function auth_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:60',
            'password' => 'required|max:60'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'input' => true,
                'response' => $validator->errors()
            ]);
        } else {
            if(!Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                return response()->json([
                    'error' => true,
                    'response' => 'We did not find a user with these credentials.'
                ]);
            } else {
                $user = Auth::user();
                
                $request->session()->flush();

                $code = substr(md5(date('Y-m-d H:m:i')), 0, 30);
                
                // Eliminamos todos los tokens viejos
                $SecurityToken = SecurityToken::where('user_id', $user->id)->where('identifier', 'LOGIN')->delete();
                
                // Creamos uno nuevo
                $SecurityToken = new SecurityToken;
                $SecurityToken->user_id = $user->id;
                $SecurityToken->token = $code;
                $SecurityToken->identifier = 'LOGIN';
                $SecurityToken->save();

                Mail::send('emails.send_token', ['user' => $user, 'code' => $code], function ($m) use ($user) {
                    $m->from(config('mail.username'), 'Administration');
                    $m->to($user->email)->subject('Verification code to authorize login');
                });

                return response()->json([
                    'error' => false,
                    'response' => 'We send a verification code to your email, please verify and enter it.'
                ]);
            }
        }
    }
    
    public function auth_token (Request $request) {

        $SecurityToken = SecurityToken::where('token', $request->input('token'));
        if ($SecurityToken->count()==0) {
            return response()->json([
                'error' => true,
                'response' => 'The entered token does not exist, please verify and try again.'
            ]);
        } else {
            $SecurityToken = $SecurityToken->get()->first();
            $user = User::find($SecurityToken->user_id);

            SecurityToken::where('user_id', $user->id)->where('identifier', 'LOGIN')->delete();
            Auth::loginUsingId($user->id, true);

            $traking = new Tracking;
            $traking->description = 'The user: ['.$user->id.'] '.$user->name.', Start session in the system successfully.';
            $traking->user_id = $user->id;
            $traking->save();

            return response()->json([
                'error' => false,
                'response' => 'Thank you for validating your login, you will be redirected to your account!',
                'redirect' => url('/cp')
            ]);
        }

        
    }
}

?>
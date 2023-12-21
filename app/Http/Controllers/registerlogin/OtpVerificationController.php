<?php

namespace App\Http\Controllers\registerlogin;

use App\Http\Controllers\Controller;
use App\Mail\Otpverification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class OtpVerificationController extends Controller
{
    public function SendOtpPage()
    {
        return view('forms.verification.Otp_verification');
    }

    public function SendOtp(Request $req)
    {
        try {
            $req->validate(['Otp_verify' => 'required']);
            $value = $req->input('Otp_verify');

            if (is_numeric($value)) {
                $url = $this->NumberVerification($value);
                return redirect($url);
            } elseif (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $url = $this->EmailVerification($value);
                return redirect($url);
            } else {
                return back();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function NumberVerification($value)
    {
        // twilio API //
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_PHONE_NUMBER');

        $user = User::where('number', $value)->first();
        try {
            if ($user !== null) {
                $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
                $expiresAt = now()->addMinutes(5);
                $cacheKey = 'otp:' . $user->id;
                Cache::put($cacheKey, $otp, $expiresAt);

                $client = new Client($sid, $token);
                $to = '+91' . $value;
                $message = $client->messages->create(
                    $to,
                    [
                        'from' => $from,
                        'body' => "your verification otp is " . $otp . " please don't share with anyone.",
                    ]
                );
                $sid = $message->sid;
                $token = str::random(60) . '_' . $user->id.'_'.$value;
                $url = url('/otp-verification/' . $token  );
                return $url;

            } else {
                throw new \Exception('mobile number is not registered.');
            }
        } catch (\Exception $e) {
            throw $e;
        }

    }

    private function EmailVerification($value)
    {
        try {
            $user = User::where('email', $value)->first();
            if ($user !== null) {
                $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
                $expiresAt = now()->addMinutes(1);
                $cacheKey = 'otp:' . $user->id;
                Cache::put($cacheKey, $otp, $expiresAt);

                $otpdata = [
                    'title' => 'Otp Verification',
                    'name' => $user->name,
                    'message' => "your verification otp is " . $otp . " please don't share with anyone.",
                ];
                Mail::to($user->email)->send(new Otpverification($otpdata));
                $token = str::random(60) . '_' . $user->id.'_'.$value;
                $url = url('/otp-verification/' . $token );
                return $url;
            } else {
                throw new \Exception('email is not registered.');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function OtpVerification(Request $request, $token)
    {
        $tokenParts = explode('_', $request->token);
        if (count($tokenParts) !== 3) {
            abort(400);
        } else {
            list($token, $id,$value) = $tokenParts;
        return view('forms.verification.verification_page', compact('id','value'));
        }
    }

    public function VerifyOtp(Request $request)
    {
        $request->validate(['otp_num'=>'required|numeric','user_id'=>'required']);
        $user = User::find($request->user_id);
       
        $cacheKey = 'otp:' . $request->user_id;
        $cachedOtp = Cache::get($cacheKey);
        
        if ($cachedOtp && $request->otp_num == $cachedOtp) {
            Cache::forget($cacheKey);
                Auth::login($user);
                if (Auth::user()->role === 'admin') {

                    return redirect('/admin-dashboard')->with('success', 'welcome hitesh');

                } elseif (Auth::user()->role === 'designer') {

                    return redirect('/designer-dashboard');

                } else {

                    return redirect('/');
                }
            } else {
                return redirect()->back()->with('error', 'otp expired');
            }
        

    }
}

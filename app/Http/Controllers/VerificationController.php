<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Verification;
use App\Mail\OtpEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class VerificationController extends Controller
{
    public function index() {
        return view('verification.index');
    }

    public function show($unique_id) {
        $verify = Verification::whereUserId(Auth::user()->id)->whereUniqueId($unique_id)
        ->wherestatus('active')->count();
        if(!$verify) abort(404);
        return view('verification.show', compact('unique_id'));
    }

    public function update(Request $request, $unique_id) {
        $verify = Verification::whereUserId(Auth::user()->id)->whereUniqueId($unique_id)
        ->wherestatus('active')->first();
        if(!$verify) abort(404);
        if(md5($request->otp) == $verify->otp) {
            $verify->update(['status' => 'invalid']);
            return redirect('/staff')->with('success', 'Verifikasi berhasil! Akun anda sudah aktif.');
        }
        $verify->update(['status' => 'valid']);
        User::find($verify->user_id)->update(['status' => 'active']);
        return redirect('/staff');
        // $request->validate([
        //     'otp' => 'required|numeric'
        // ]);
        // $verify = Verification::whereUserId(Auth::user()->id)
        //     ->whereUniqueId($unique_id)
        //     ->whereStatus('active')
        //     ->first();

        // if (!$verify) {
        //     return back()->with('error', 'OTP tidak ditemukan atau sudah tidak aktif.');
        // }

        // if ($verify->otp != $request->otp) {
        //     return back()->with('error', 'OTP salah.');
        // }

        // // Set verification as used/invalid
        // $verify->status = 'invalid';
        // $verify->save();

        // // Set user status to active
        // $user = Auth::user();
        // $user->status = 'active';
        // $user->save();

        // // Redirect to staff with success message
        // return redirect('/staff')->with('success', 'Verifikasi berhasil! Akun anda sudah aktif.');
    }   

    public function store(Request $request) {
        $user = null;
        if($request->type == 'register') {
            $user = User::find($request->user()->id);
        }else{
            // $user = User::where('email', $request->email)->first();
        }
        if(!$user) 
            return back()->with('error', 'Email tidak ditemukan');
            $otp = rand(100000, 999999);
            $verify = Verification::create([
                'user_id' => $user->id,
                'unique_id' => uniqid(),
                'otp' => $otp,
                'type' => $request->type,
                'send_via' => 'email',
            ]);
            Mail::to($user->email)->queue(new OtpEmail($otp));
            if($request->type == 'register') {
                return redirect('/verify/'. $verify->unique_id)->with('success', 'OTP telah dikirim ke email anda');
            }
            // return redirect('/reset-password/'. $verify->unique_id)->with('success', 'OTP telah dikirim ke email anda');
        }
    }
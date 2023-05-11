<?php

namespace App\Http\Controllers;

use App\Traits\WablasTrait;
use Illuminate\Http\Request;

class OTPController extends Controller
{
    public function store()
    {
        try {
            $kumpulan_data = [];
            $six_digit_random_number = random_int(100000, 999999);
            $data['phone'] = request('no_wa');
            $data['message'] = "Untuk melakukan aktivasi silakan masukan kode OTP sebagai berikut : " . $six_digit_random_number . "<br>kode OTP ini hanya berlaku selama 60 detik.";
            $data['secret'] = false;
            $data['retry'] = false;
            $data['isGroup'] = false;
            array_push($kumpulan_data, $data);
            WablasTrait::sendText($kumpulan_data);
            return response()->json("Success Mengirimkan Data");
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Something went wrong.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

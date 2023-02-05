<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }    
    
    public function update(Request $request)
    {
        $request->validate([
            'personal_phone' => [ 'numeric', 'digits:10','unique:'.User::class],
            'address' => [ 'nullable','string', 'min:5', 'max:300'],
            'email' => [ 'nullable','string', 'email', 'max:255','unique:'.User::class]
        ]);

        $user = $request->user();
        $user->address = $request['address'];

        if($request->personal_phone!=null && $request->email!=null ){
            $user->personal_phone = $request['personal_phone'];
            $user->email = $request['email'];
        }
        else if($request->email!=null ){
            $user->personal_phone = Auth::user()->personal_phone;
            $user->email = $request['email'];
        }
        else if($request->personal_phone!=null ){
            $user->email = Auth::user()->email;
            $user->personal_phone = $request['personal_phone'];
        }

        $user->save(); 
        return with(
            ['msg' => 'Profile_information_updated']);            
    }

    private function verifyDateFormat(?string $date): ?string
    {
        return isset($date)
            ? $this->changeDateFormat($date, 'd/m/Y')
            : null;
    }


    public static function changeDateFormat(
        string $date,
        string $date_format,
        string $expected_format = 'Y-m-d'
    ): string
    {
        return Carbon::createFromFormat($date_format, $date)->format($expected_format);
    }

}

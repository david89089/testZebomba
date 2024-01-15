<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = collect($request->all())->sort()->toArray();
        $sig = $data['sig'];
        unset($data['sig']);

        $str = md5(mb_strtolower(mapped_implode('', $data, '=').config('secret.key'), 'UTF-8'));

        //dd('Sig: '. $sig. ' Str: '. $str);

        if($str === $sig) {
            $userInfo = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'country' => $data['country'],
                'city' => $data['city'],
            ];
            $user = User::query()->updateOrCreate($userInfo, $userInfo);

            $sessionInfo = ['access_token' => $data['access_token']];
            $session = $user->session()->firstOrCreate(['user_id' => $user->id], $sessionInfo);
            if(!empty($session)) {
                $session->update($sessionInfo);
            }

            return new UserResource($user);
        }

        return response()->json([
            'error' => 'Ошибка авторизации в приложении',
            'error_key' => 'signature error',
        ], 403);
    }
}

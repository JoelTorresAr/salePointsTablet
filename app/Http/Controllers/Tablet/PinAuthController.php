<?php

namespace App\Http\Controllers\Tablet;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use App\Jobs\CreateBinnacle;
use App\Models\CashBox;
use App\Models\MenuFamily;
use App\Models\Opening;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class PinAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $pin     = $request->input('pin');
        $shop_id = $request->input('shop_id');

        if (!$user = User::select('id', 'name')->where([['pin', $pin], ['state', 'A']])->first()) {
            return  response()->json(['msg' => 'Acceso no autorizado(user)'], 401);
        }

        dispatch(new CreateBinnacle('A', 'USER', $user['id'],  'LOGEO'));

        if (!$shop = $user->shops()->where([['shops.id', $shop_id], ['state', 'A']])->first()) {
            return  response()->json(['msg' => 'Acceso no autorizado(tienda)'], 401);
        }

        $cash_box = CashBox::select('id', 'name', 'state')->where([['shop_id', $shop['id']], ['state', 'A']])->first();

        if (!$opening = Opening::where([['cash_box_id', $cash_box['id']], ['state', 'A']])->value('id')) {
            return  response()->json(['msg' => 'No se aperturo caja'], 401);
        }

        if (!$user->hasRole('mozo')) {
            return  response()->json(['msg' => 'Acceso no autorizado'], 401);
        }

        try {
            /* if($mozo = auth('api')->user()) {
                //JWTAuth::manager()->invalidate(new \Tymon\JWTAuth\Token($tokenString), $forceForever = false);
                JWTAuth::invalidate($token);
            }*/
            if (!$userToken = auth('api')->login($user)) {
                return response()->json(['msg' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['msg' => 'could_not_create_token'], 500);
        }

        return $this->respondWithToken($userToken, $user, $shop, $cash_box, $opening);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user, $shop, $cash_box, $opening)
    {
        $families = MenuFamily::with(['menus' => function ($query) use ($shop) {
            $query->where([['shop_id', $shop['id']], ['menus.state', 'A']])->orderBy('menus.orden');
        }])
        ->orderBy('menu_families.orden')
        ->get();

        foreach ($families as $key => $family) {
            if (count($family['menus']) == 0) {
                unset($families[$key]);
            }
        }

        //$time = auth('api')->factory()->getTTL();

        return response()->json([
            'status'       => 1,
            'access_token' => $token,
            'token_type'   => 'bearer',
            'msg'          => 'OK',
            'id_usr'       => $user['id'],
            'nombre'       => $user['name'],
            'id_tienda'    => $shop['id'],
            'pisos'        => $shop->floors()->select('floors.id', 'floors.name')->where('floors.state', 'A')->get(),
            'fam'          => $families,
            'id_caja'      => $cash_box['id'],
            'id_apertura'  => $opening
        ]);
        //->withCookie('token', $token, $time);
    }
}

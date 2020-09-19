<?php

namespace App\Http\Controllers\Tablet;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use App\Models\MenuFamily;
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
        $this->middleware('auth:api', ['except' => ['login']]);
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
            return  response()->json(['error' => 'Unauthorized pin'], 401);
        }

        /*if (!$user->shops()->where('shops.id', $shop_id)->exists()) {
            return  response()->json(['error' => 'Unauthorized in this store'], 401);
        }*/

        if (!$shop = $user->shops()->where([['shops.id', $shop_id], ['state', 'A']])->first()) {
            return  response()->json(['error' => 'Unauthorized in this shop'], 401);
        }

        if (!$user->hasRole('mozo')) {
            return  response()->json(['error' => 'Unauthorized in this rol'], 401);
        }

        try {
            if (!$userToken = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return $this->respondWithToken($userToken, $user, $shop);
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
    protected function respondWithToken($token, $user, $shop)
    {
        $families = MenuFamily::with(['menus' => function ($query) use ($shop) {
            $query->where([['shop_id', $shop['id']], ['menus.state', 'A']]);
        }])->get();

        foreach ($families as $key => $family) {
            if (count($family['menus']) == 0) {
                unset($families[$key]);
            }
        }

        // $menus = $families->menus()->where(['shop_id', $shop['id'],'state','A'])->get();

        return response()->json([
            'status'       => 1,
            'access_token' => $token,
            'token_type'   => 'bearer',
            /*'expires_in' => auth()->factory()->getTTL() * 60,*/
            'msg'          => 'OK',
            'id_usr'       => $user['id'],
            'nombre'       => $user['name'],
            'id_tienda'    => $shop['id'],
            'pisos'        => $shop->floors()->select('floors.id', 'floors.name')->where('floors.state', 'A')->get(),
            'fam'          => $families

        ]);
    }
}

<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\Driver;
use App\Models\Customer;
use App\Models\Supervisor;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Laravel\Passport\TokenRepository;
// use Lcobucci\JWT\Parser as JwtParser;
// use Psr\Http\Message\ServerRequestInterface;
// use League\OAuth2\Server\AuthorizationServer;
// use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class PassportProviderTokenAuthController extends Controller
{

    //  /**
    //   * The authorization server.
    //   *
    //   * @var \League\OAuth2\Server\AuthorizationServer
    //   */
    //  protected $server;
    
    //  /**
    //   * The token repository instance.
    //   *
    //   * @var \Laravel\Passport\TokenRepository
    //   */
    //  protected $tokens;
    
    //  /**
    //   * The JWT parser instance.
    //   *
    //   * @var \Lcobucci\JWT\Parser
    //   */
    //  protected $jwt;
    
    //  /**
    //   * Create a new controller instance.
    //   *
    //   * @param  \League\OAuth2\Server\AuthorizationServer  $server
    //   * @param  \Laravel\Passport\TokenRepository  $tokens
    //   * @param  \Lcobucci\JWT\Parser  $jwt
    //   */
    //  public function __construct(AuthorizationServer $server,
    //                              TokenRepository $tokens,
    //                              JwtParser $jwt)
    //  {
    //      parent::__construct($server, $tokens, $jwt);
    //  }

    //  /**
    //   * Override the default Laravel Passport token generation
    //   *
    //   * @param ServerRequestInterface $request
    //   * @return array
    //   * @throws UserNotFoundException
    //   */
     public function issueToken(Request $request)
     {
         
           
        switch ($request->provider) {

            case 'customers_api';
                $authenticateUser = Customer::where('email',$request->username)->firstOrFail();

                if (Hash::check($request->password, $authenticateUser->password)) {
                $user = $authenticateUser;
                $token = $user->createToken('customer')->accessToken;

                }

                else{
                return response()->json([
                    'error' => 'User not Found',
                    'status_code' => 401
                ], 401)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
            }
       
            
                break;

            case 'drivers_api';
                
                
                 $authenticateUser = Driver::where('email',$request->username)->firstOrFail();

                 if (Hash::check($request->password, $authenticateUser->password)) {
                    $user = $authenticateUser;
                    $token = $user->createToken('driver')->accessToken;

                 }

                 else{
                  return response()->json([
                      'error' => 'User not Found',
                      'status_code' => 401
                  ], 401)->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
                }
            
                break;

            case 'supervisors_api';
                
               $authenticateUser = Supervisor::where('email',$request->username)->firstOrFail();

                 if (Hash::check($request->password, $authenticateUser->password)) {
                    $user = $authenticateUser;
                    $token = $user->createToken('supervisor')->accessToken;

                 }

                 else{
                  return response()->json([
                      'error' => 'User not Found',
                      'status_code' => 401
                  ], 401)->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
                }
            
            
                break;
            
            default :
            
            $authenticateUser = User::where('email',$request->username)->firstOrFail();

            if (Hash::check($request->password, $authenticateUser->password)) {
               $user = $authenticateUser;
               $token = $user->createToken('users')->accessToken;
            }

            else{
             return response()->json([
                 'error' => 'User not Found',
                 'status_code' => 401
             ], 401)->withHeaders([
               'Content-Type' => 'application/json',
           ]);
           }
        }
        
        return response()->json(['data' => [
            'token' => $token, 'user' => $user
        ]], 200);
    }
}


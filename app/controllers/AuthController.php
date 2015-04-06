<?php

class AuthController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function __construct(){
        if (Sentry::getUser()){
            echo 'zaten giriş yaptınız.';
            exit;
        }
    }

    public function getLogin()
    {
        return View::make('login');
    }

    static function postLogin()
    {
        $input = Input::all();

        $rules = array(
            'email'            => 'required|email',
            'password'         => 'required|min:8',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails())
        {
            return View::make('login')->with('message', 'Gerekli alanları doldurunuz!');
        }else{

            try
            {
                $credentials = array(
                    'email'    => $input['email'],
                    'password' => $input['password'],
                );
                // Find the user using the user id
                $user = Sentry::authenticate($credentials, false);

                return Redirect::to('/');
            }
            catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                return View::make('login')->with('message', 'Gerekli alanları doldurunuz');
            }
            catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                return View::make('login')->with('message', 'Gerekli alanları doldurunuz');
            }
            catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
            {
                return View::make('login')->with('message', 'Şifre Yanlış');
            }
            catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                return View::make('login')->with('message', 'Kullanıcı bulunamadı');
            }
            catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
            {
                return View::make('login')->with('message', 'Kullanıcı aktif değil');
            }
            catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
            {
                return View::make('login')->with('message', 'Kullanıcı süresi dolmuş');
            }
            catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
            {
                return View::make('login')->with('message', 'Kullanıcı engellenmiş');
            }




        }

        return View::make('login');
    }

}

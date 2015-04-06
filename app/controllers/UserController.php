<?php

class UserController extends BaseController {

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
        $user = Sentry::getUser();

        if($user && !$user->hasAccess('admin')){
            echo 'Giriş İzniniz yok';
            exit;
        }
    }

    public function index()
    {

        $users = Sentry::findAllUsers();

        return View::make('user.list',array('users'=>$users));
    }

    static function create()
    {
        $input = Input::all();

        if($input) {

            $rules = array(
                'first_name'       => 'required',
                'last_name'        => 'required',
                'code'             => 'required',
                'email'            => 'required|email',
                'password'         => 'required',
                'password_confirm' => 'required|same:password',
                'group'            => 'required',
            );

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return View::make('user.create')->with('message', 'Gerekli alanları doldurunuz!');
            } else {

                try
                {

                    $user = Sentry::createUser(array(
                        'email'       => $input['email'],
                        'password'    => $input['password'],
                        'first_name'  => $input['first_name'],
                        'last_name'   => $input['last_name'],
                        'code'        => $input['code'],
                        'activated'   => true,
                    ));
                    $id = $user->id;
                    // Kullanıcı getir
                    $user = Sentry::findUserById($id);

                    // Grup getir
                    $adminGroup = Sentry::findGroupById($input['group']);

                    // Kullanıcı gruba eklenir
                    if($user->addGroup($adminGroup)){
                        return View::make('user.create')->with('message', 'Form başarı ile gönderildi');
                    }

                }
                catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
                {
                    return View::make('user.create')->with('message', 'Gerekli alanları doldurunuz');
                }
                catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
                {
                    return View::make('user.create')->with('message', 'Şifre Zorunludur');
                }


            }
        }

        return View::make('user.create');
    }

    static function update($id)
    {
        $input = Input::all();

        $user = Sentry::findUserById($id);

        if(isset($user)) {

            if($input) {

                $rules = array(
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'code' => 'required',
                    'email' => 'required|email',
                );

                $validator = Validator::make($input, $rules);

                if ($validator->fails()) {
                    return View::make('user.create')->with('message', 'Gerekli alanları doldurunuz!');
                } else {
                    $user->code = $input['code'];
                    $user->first_name = $input['first_name'];
                    $user->last_name = $input['last_name'];
                    $user->email = $input['email'];
                    if($input['password']) {$user->password = $input['password'];}

                    if($user->save()) {

                        return View::make('user.update',array('user'=>$user))->with('message', 'Form başarı ile gönderildi');
                    }


                }
            }

            return View::make('user.update', array('user'=>$user));
        }
    }

}

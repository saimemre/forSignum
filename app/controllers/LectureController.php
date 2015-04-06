<?php

use Illuminate\Database\Eloquent;

class LectureController extends BaseController {

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
        $lectures = Lecture::all();

        return View::make('lecture.list',array('lectures'=>$lectures));
    }

    static function create()
    {
        $input = Input::all();

        if($input) {

            $rules = array(
                'name'             => 'required',
                'code'             => 'required|unique:lecture',
                'day'              => 'required',
                'hour'             => 'required',
            );

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return View::make('lecture.create')->with('message', 'Gerekli alanları doldurunuz!');
            } else {

                $lecture = new \Lecture;
                $lecture->code = $input['code'];
                $lecture->name = $input['name'];
                $lecture->day = $input['day'];
                $lecture->hour = $input['hour'];
                isset($input['ismandatory']) ? $lecture->ismandatory = $input['ismandatory'] : 0;

                if($lecture->save()){
                    return View::make('lecture.create')->with('message', 'Form başarı ile gönderildi');
                }else{
                    return View::make('lecture.create')->with('message', 'Kayıt başarılı olmadı');
                }



            }
        }

        return View::make('lecture.create');
    }

    static function update($id)
    {
        $input = Input::all();

        $lecture = Lecture::find($id);

        if(isset($lecture)) {

            if($input) {

                $rules = array(
                    'name'             => 'required',
                    'day'              => 'required',
                    'hour'             => 'required',
                );


                $validator = Validator::make($input, $rules);

                if ($validator->fails()) {
                    return View::make('lecture.create')->with('message', 'Gerekli alanları doldurunuz!');
                } else {
                    $lecture->code = $input['code'];
                    $lecture->name = $input['name'];
                    $lecture->day = $input['day'];
                    $lecture->hour = $input['hour'];
                    isset($input['ismandatory']) ? $lecture->ismandatory = $input['ismandatory'] : 0;

                    if($lecture->save()) {

                        return View::make('lecture.update',array('lecture'=>$lecture))->with('message', 'Form başarı ile gönderildi');
                    }


                }
            }

            return View::make('lecture.update', array('lecture'=>$lecture));
        }
    }

}

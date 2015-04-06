<?php

use Illuminate\Database\Eloquent;

class ClassRoomController extends BaseController {

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
        $classrooms = Classroom::all();

        return View::make('classroom.list',array('classrooms'=>$classrooms));
    }

    static function create()
    {
        $input = Input::all();

        if($input) {

            $rules = array(
                'name'             => 'required',
                'code'             => 'required|unique:classroom',
                'parentid'         => 'required',
                'type'             => 'required',
            );

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return View::make('classroom.create')->with('message', 'Gerekli alanları doldurunuz!');
            } else {

                $classroom = new \Classroom;
                $classroom->code = $input['code'];
                $classroom->name = $input['name'];
                $classroom->parentid = $input['parentid'];
                $classroom->type = $input['type'];

                if($classroom->save()){
                    return View::make('classroom.create')->with('message', 'Form başarı ile gönderildi');
                }else{
                    return View::make('classroom.create')->with('message', 'Kayıt başarılı olmadı');
                }



            }
        }

        return View::make('classroom.create');
    }

    static function update($id)
    {
        $input = Input::all();

        $classroom = Classroom::find($id);

        if(isset($classroom)) {

            if($input) {

                $rules = array(
                    'name'             => 'required',
                    'code'             => 'required',
                    'parentid'         => 'required',
                    'type'             => 'required',
                );


                $validator = Validator::make($input, $rules);

                if ($validator->fails()) {
                    return View::make('classroom.create')->with('message', 'Gerekli alanları doldurunuz!');
                } else {
                    $classroom->code = $input['code'];
                    $classroom->name = $input['name'];
                    $classroom->parentid = $input['parentid'];
                    $classroom->type = $input['type'];

                    if($classroom->save()) {

                        return View::make('classroom.update',array('classroom'=>$classroom))->with('message', 'Form başarı ile gönderildi');
                    }


                }
            }

            return View::make('classroom.update', array('classroom'=>$classroom));
        }
    }

}

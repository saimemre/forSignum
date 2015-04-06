<?php

class HomeController extends BaseController {

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

	public function index()
	{
        $user = Sentry::getUser();
        if($user){
            if($user->hasAccess('users')){
                return Redirect::to('/lecture-select');
            }else if($user->hasAccess('admin')){
                return View::make('signum');
            }
        }else{
            return Redirect::to('login');
        }
	}

    static function select()
    {
        $user = Sentry::getUser();
        if($user->hasAccess('admin')){
            echo 'yetkiniz yok';
            exit;
        }

        $input = Input::all();

        $lecture_log = Lecture_log::where('studentid',$user->id)->select('lectureid')->get()->toArray();

        if($input && $user) {

            $rules = array(
                'ismandatory'        => 'required',
                'ismandatoryNot'     => 'required',
            );

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return View::make('lecture.select')->with('message', 'Gerekli alanları doldurunuz!');
            } else {

                //Burda eski verilerini siliyoruz, kontrol vs eklenebilir.
                Lecture_log::where('studentid',$user->id)->delete();

                //zorunlu dersler ekleniyor
                foreach($input['ismandatory'] as $val){
                    $lecture = new \Lecture_log;
                    $lecture->studentid = $user->id;
                    $lecture->lectureid = $val;
                    $lecture->save();
                }
                //seçmeli dersler ekleniyor
                foreach($input['ismandatoryNot'] as $val){
                    $lecture = new \Lecture_log;
                    $lecture->studentid = $user->id;
                    $lecture->lectureid = $val;
                    $lecture->save();
                }

                return View::make('lecture.select',array('log'=>$lecture_log))->with('message', 'Form başarı ile gönderildi');



            }
        }


        return View::make('lecture.select',array('log'=>$lecture_log));
    }

}

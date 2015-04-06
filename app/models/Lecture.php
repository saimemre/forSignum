<?php

class Lecture extends Eloquent {

    protected $table = 'lecture';


    public function getDay(){
        return Config::get('variable.days.'.$this->day);
    }

    public function getIsmandatory(){
        return ($this->ismandatory == 1) ? 'Zorunlu' : 'Zorunlu Değil';
    }

    public function getLog(){
        $user = Sentry::getUser();

        $log  = Lecture_log::where(array('studentid'=>$user->id,'lectureid'=>$this->id))->first();
        if($log){
            return true;
        }
        return false;
    }

}
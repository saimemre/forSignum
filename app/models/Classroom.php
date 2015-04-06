<?php


class Classroom extends Eloquent {

    protected $table = 'classroom';


    public function getType(){
        return ($this->type==0) ? 'Kat' : 'Sınıf';
    }


}
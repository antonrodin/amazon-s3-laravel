<?php

class Photo extends Eloquent {

    protected $fillable = array('title', 'file');
    
    public function get_photo($res = 'high') {
        if ($res == 'high') {
            return "http://images.jacksonlive.es/test/high/{$this->file}";
        } else {
            return "http://images.jacksonlive.es/test/high/{$this->file}";
        }
    }

}
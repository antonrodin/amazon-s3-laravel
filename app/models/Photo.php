<?php

class Photo extends Eloquent {

    protected $fillable = array('title', 'file');
    
    public function get_photo($res = 'high') {
        return "http://images.jacksonlive.es/test/{$res}/{$this->file}";
    }

}
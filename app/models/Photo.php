<?php

class Photo extends Eloquent {

    protected $fillable = array('title', 'file');
    
    public function get_photo($res = 'high') {
        return "http://images.jacksonlive.es/test/{$res}/{$this->file}";
    }
    
    public function isValid($input) {
        $rules = array(
                'title' => 'required|min:2',
                'file' => 'required|image|max:1024'
        );            
        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                return true;
        }
        $this->messages = $validation->messages();
        return false;
    }

}
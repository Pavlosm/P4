<?php


class Recipe extends Eloquent {

    public function users() {
        # recipes belong to many users
        return $this->belongsToMany('User');
    }

}




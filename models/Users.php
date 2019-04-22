<?php 

class Users extends Eloquent {
	    
	protected $guarded = [];
	
	protected $table = 'users';

    protected $primaryKey = 'users_id';


    public function articles()
    {
        return $this->hasMany('Articles');
    }

		
}

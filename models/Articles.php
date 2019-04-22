<?php 

class Articles extends Eloquent {
	    
	protected $guarded = [];
	
	protected $table = 'articles';

    protected $primaryKey = 'article_id';

	public function users()
    {
        return $this->belongsTo('users');
    }

    public static function uploaded_images($article_id){

    	return DB::table('articles')->where('article_pom', $article_id)
                                    ->get();

    }

   
}

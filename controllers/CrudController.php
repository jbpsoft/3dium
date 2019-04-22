<?php

class CrudController extends \BaseController {

	public function create_article()
	{
		return View::make('create_article');
	}

	public function create_ajax()
	{	
		$clanak = new Articles;
		if (Input::file('file')) {
			
	        $image = Input::file('file');
	        $max_image_size = 10000;
	        $max_images = 10;
	        $success = false;
	 
	        $validator = Validator::make(
	            array('file' => 'mimes:jpg,png,jpeg|max:'.strval($max_image_size)),
	            array(
	                'mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su jpg, png i jpeg.',
	                'max' => 'Maksimalna veličina slike je '.strval($max_image_size / 1000).' MB.',
	                )
	            );
	        if($validator->fails()){
	            $success = false;
	            $error_message = $validator->messages()->first();
	            break;
	        }else{
	            $success = true;
	        }
	            
	        if($success){
		      	$fileName = Input::file('file')->getClientOriginalName(); // getting image name
		      	$path = __DIR__.'../../images/'; // upload path
				$clanak->picture_path = Links::base_url().'app/images/'.$fileName; 
		      	Input::file('file')->move($path, $fileName); // uploading file to given path
		    }
	    }
			$clanak->users_id = $_POST['korisnik'];
	      	$clanak->article_title = $_POST['naslovClanka'];	
			$clanak->article_post = $_POST['tekstClanka'];
	      	$clanak->save();
			$clanak->article_pom = $clanak->article_id;
			$clanak->update();	      	
			Session::flash('success', 'Uspešno ste kreirali članak!'); 

	      	return Response::json(array('success'=>true)); // sending back with message
      	
	}

	public function update($id){
		$data = Articles::find($id);

		$data->article_title = $_POST['naslov'];
		$data->article_post = $_POST['post'];
		$data->update();

		if (Input::file('file')) {

			$fileName = Input::file('file')->getClientOriginalName(); // getting image name
			$path = __DIR__.'../../images/'; // upload path
			$data->picture_path = Links::base_url().'app/images/'.$fileName;
			Input::file('file')->move($path, $fileName); // uploading file to given path

			if($data->picture_path && Input::file('file')){	
				$data0 = DB::table('articles')->max('article_id');			
				$data1 = DB::table('articles')->insert(array(
					'article_id' => $data0 + 1,
					'article_pom' => $data->article_id,
					'users_id' => base64_decode(Session::get('user_id')), 
					'picture_path' => $data->picture_path
				));
			}
			elseif(Input::file('file') || $data->picture_path){
				$data->save();
			}
		}

		return Redirect::to('/single-article/'.$data->article_id);
	}


	public function delete_article_ajax($id){
		$image = DB::table('articles')->where('article_id', $id)->first();
		$images = DB::table('articles')->where('article_pom', $id)->get();
		if(!empty($images)){
			$images = DB::table('articles')->where('article_pom', $id)->delete();			
		}
		if ($image->picture_path) {
	        $file= $image->picture_path;
	        $filename =__DIR__.'../../images/'.$file;
	        File::delete($filename);
		}

	   	Session::flash('success', 'Uspešno ste obrisali članak!'); 
	  	return Response::json($image);
	}

	public function delete_image($id, $pom){

		$image = DB::table('articles')->where('article_id', $id)
									  ->where('article_pom', $pom)
									  ->delete();
		//$image->delete();
		return Redirect::back();
	}

}

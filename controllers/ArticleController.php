<?php

class ArticleController extends \BaseController {



	public function single_article($id=0)
	{
		if ($id == 0) {
			$id = DB::table('articles')->where('users_id', base64_decode(Session::get('user_id')))->
											orderBy('article_id', 'desc')->first()->article_id;
			Session::flash('success', 'Uspešno ste kreirali članak!');
		}

		$data = Articles::find($id);

		return View::make('single_article', array('data' => $data));
	}


	public function user_list($id)
	{
		$data = Articles::where('users_id', $id)->orderBy('created_at', 'desc')->get();
		$cnt = count($data);
		return View::make('single_article', array('datt'=>$data, 'cnt'=>$cnt));
	

	}

	public function list_articles_ajax(){
		$data = Articles::with('users')->orderBy('article_id', 'asc')->get();
		return Response::json($data);
	}


	public function delete_article_view(){

		$data = Articles::where('users_id', base64_decode(Session::get('user_id')))->orderBy('article_id', 'asc')->get();
		return View::make('delete_article', array('data' => $data));
	}


	public function list_article_user(){
		$data = Articles::where('users_id', base64_decode(Session::get('user_id')))->orderBy('created_at', 'asc')->get();

		return Response::json($data);
	}


	public function update_article()
	{
			$clanci = DB::table('articles')->where('users_id', base64_decode(Session::get('user_id')))
											->get();

		return View::make('update_article', array('clanci' => $clanci));
	}


	public function update($id)
	{
		$data = Articles::find($id);
		$data->article_title = $_POST['naslov'];
		$data->article_post = $_POST['post'];
		$data->update();
		return View::make('list_article');
	}


	public function destroy($id)
	{
		$data = Articles::find($id);
		$data->delete();
		return View::make('list_article');
	}

	public function findArticle($id)
	{
		$data = Articles::findOrFail($id);
		return View::make('update_article', array('data' => $data));
	}

	public function finding($id)
	{
		$data = Articles::findOrFail($id);
		return View::make('delete_article', array('data' => $data));
	}

}

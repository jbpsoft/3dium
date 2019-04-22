@extends('partials/header')
<div id="content">
	<?php if(empty($clanci)){
       $clanci = Articles::select('article_id', 'article_title', 'article_post', 'article_img', 'article_more_img', 'users_id', 'created_at', 'updated_at', 'picture_path')
      		->orderBy('article_id', 'asc')->get();} ?>
      @foreach($clanci as $clanak)
	      @if($clanak->article_title)
	        <a href="/single-article/{{ $clanak->article_id }}">{{ $clanak->article_title }}</a>	        
	        <a href="/list-users/{{ $clanak->users_id }}" style="float:right;">{{ Users::find($clanak->users_id)->name }}</a>
	        <hr>
	      @endif
      @endforeach      
</div>
@extends('partials/footer')
@include('partials/header')
<div id="content">
	@if (Session::has('success'))
		<center><div class="alert alert-danger">{{ Session::get('success') }}</div></center>
	@endif	

	@if(!empty($data))
<!-- Pregled clanka ukoliko je jedini napisan od pisca  -->
		@if($data->article_title)
			<h3>{{ $data->article_title }}</h3><br>
			{{ $data->article_post }}<br><br>
			@foreach(Articles::uploaded_images($data->article_id) as $dtaa)
				@if($dtaa->picture_path)
					<div id="pictureFrame">
						<img src="{{ $dtaa->picture_path }}" title="{{ $dtaa->picture_path }}">
					</div>
				@endif
			@endforeach
			<span style="float: right;"><i>Kreirano:</i> {{ $data->created_at->format('d.m.Y. H:m') }}h
			<br>
			<i>Pisac:</i><b> {{ Users::find($data->users_id)->name }}</b></span>
		@endif
	@elseif(!empty($datt))		
<!-- Pregled po piscima clanaka  -->
		@foreach($datt as $daat)
			@if($daat->article_title)
				<h3>{{ $daat->article_title }}</h3><br>
				{{ $daat->article_post }}<br><br>
				@foreach(Articles::uploaded_images($daat->article_id) as $dtaa)
                    @if($dtaa->picture_path)
						<div id="pictureFrame">
							<img src="{{ $dtaa->picture_path }}" title="{{ $dtaa->picture_path }}">
						</div>
					@endif
				@endforeach
				<span style="float: right;"><i>Kreirano:</i> {{ $daat->created_at->format('d.m.Y. H:m') }}h
				<br>
				<i>Pisac:</i><b> {{ Users::find($daat->users_id)->name }}</b></span><br><br>
			@endif	
		@endforeach		
	@endif
</div>
@include('partials/footer')
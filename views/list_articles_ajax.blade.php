@include('partials/header')
<?php
  require_once '/vendor/autoload.php';

  // Populate items
  $items = array_map(function ($value) {
      return [
          'name' => 'Stranica #' . $value,
          'url' => '/post/' . $value,
      ];
  }, range(1,1000));

  // Get current page from query string
  $currentPage  = isset($_GET['page']) ? (int) $_GET['page'] : 1;

  // Items per page
  $perPage      = 3;

  // Get current items calculated with per page and current page
  $currentItems = array_slice($items, $perPage * ($currentPage - 1), $perPage);

  // Create paginator
  $paginator = new Illuminate\Pagination\Paginator($items, 5, $currentPage);
?>
<script type="text/javascript">
	$(document).ready(function() {
	    $.get('/list-articles-ajax', function(articles){
		//console.log(articles);
	    var render = '';
		for (var i = 0; i < articles.length; i++) {
		  if(articles[i].article_title){
		    render += '<a href="/single-article/'+ articles[i].article_id +'">'+ articles[i].article_title +'</a><a href="/list-users/'+ articles[i].users_id +'" style="float:right;">'+ articles[i].users.name +'</a><hr>';
		  }
		}

	      $('#content').html(render);
	    });
	});		
</script>

<div id="side">
	<h2>Članci - stranica <?=$paginator->currentPage()?></h2>
</div>	

	<div id="content">
	</div>
<div id="arrows">
	<?=$paginator->render()?>
</div>
@include('partials/footer')
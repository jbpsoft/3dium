@include('partials/header')
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  
<div id="content">
  @if (Session::has('success'))
    <center><div class="alert alert-danger">{{ Session::get('success') }}</div></center> 
  @endif  
    @foreach($data as $datt)
      @if($datt->article_title)
        <a href="/single-article/{{ $datt->article_id }}"><strong>{{ $datt->article_title }}</strong></a>
        <button class="btn-danger deleteRecord" data-id="{{ $datt->article_id }}" style="float: right;">&nbsp;Obriši &#269;lanak&nbsp;</button><br><hr>
      @endif
    @endforeach
</div>

<script type="text/javascript">
  $(".deleteRecord").click(function(){
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");
      $.ajax({
          url: "delete-article-ajaxx/"+id,
          type: 'DELETE',
          data: {
              "id": id,
              "_token": token,
          },
          success: function (response) {
                location.href = '/delete-article';
              }
      });
  });
</script>
@include('partials/footer')
@include('partials/header')

<div id="content">
  <?php if (!empty($data)) {?>
    <div id="UpdateForm" class="modal fade" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <a class="bg-danger close" href="{{ Links::base_url() }}update-article" style="color:#000"; >&nbsp;×&nbsp;</a>
              <h4 class="modal-title text-xs-center" style="color:#fff"; >A&#382;uriranje &#269;lanka</h4>
          </div>
          <form method="POST" action="{{ Links::base_url() }}update-custom-article/{{ $data->article_id }}" files='true' enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label">Naslov:</label>
                <div>
                    <input type="text" class="form-control input-lg" name="naslov" value="{{ $data->article_title }}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Tekst &#269;lanka:</label>
                <div>
                    <textarea rows="8" cols="50" class="form-control input-lg" name="post">{{ $data->article_post }}</textarea>
                </div>
                <br>
                  @foreach(Articles::uploaded_images($data->article_id) as $dataa)
                    @if($dataa->picture_path)
                      <div id="pictureFrame">
                        <a href="{{ Links::base_url() }}delete-image/{{ $dataa->article_id }}/{{ $dataa->article_pom }}" ><i class="fa fa-close" aria-hidden="true" style='float:right;' title='Obriši' ></i></a>
                        <img src="{{ $dataa->picture_path }}" title="{{ $dataa->picture_path }}"><br><br>
                      </div>
                    @endif
                  @endforeach
                <br>
                  <label for="file">Izaberite sliku</label>
                  <input type="file" id="file" name="file" >
                <br> 
                <button type="reset" style="color:#fff" class="btn btn-danger">{{ Form::label('Reset') }}</button>

                <input type="hidden" name="korisnik" value="{{ base64_decode(Session::get('user_id')) }}">
              </div>
            </div>    
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger confirm-btn" style="color:#fff";>A&#382;urirajte &#269;lanak</button>
            </div>
          </form>         
        </div>
      </div>
    </div>
    <script type="text/javascript"> 
        $(document).ready(function(){
          $(window).on('load', function()
            {
              $('#UpdateForm').modal('show');
            });   
        });   
    </script>
	<?php } else{?> 
    <div id="pom">  
      @foreach($clanci as $clanak)
        @if($clanak->article_title)
	      	<div style="border: 1px solid gray; padding: 0px 15px 0px 25px; border-radius: 6px;">
          <a class="btn btn-danger" href="{{ Links::base_url() }}find-article/{{ $clanak->article_id }}" style="color:black; float:right;"><i class="fa fa-edit" aria-hidden="true" >&nbsp;Uredi</i></a>  	
		      	<h3 style="float: left;" >{{ $clanak->article_title }}</h3>		    
		        <br>
		        {{ $clanak->article_post }}
            <span style="float:right;">{{ Users::find($clanak->users_id)->name }}</span> 		        
	    	  </div>
	    	  <br>
        @endif
  	  @endforeach
    </div>
  <?php };?>
</div>
@include('partials/footer')

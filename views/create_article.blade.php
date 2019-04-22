@include('partials/header')
<div id="content">  
  <div id="CreateForm" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <a class="bg-danger close" href="{{ Links::base_url() }}" style="color:#000"; >&nbsp;×&nbsp;</a>
            <h4 class="modal-title text-xs-center" style="color:#fff"; >Kreiranje &#269;lanka</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">Naslov:</label>
            <div>
                <input type="text" class="form-control input-lg" id="naslovClanka" name="naslovClanka">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Tekst &#269;lanka:</label>
            <div>
                <textarea rows="8" cols="50" class="form-control input-lg" id="tekstClanka" name="tekstClanka" ></textarea>
            </div>
            <br>
              <label for="file">Izaberite sliku</label>
              <input type="file" id="file" name="file" value="">
            <br>
            <button type="reset" style="color:#fff" class="btn btn-danger">{{ Form::label('Reset') }}</button>
            <input type="hidden" name="korisnik" id="korisnik" value="{{ base64_decode(Session::get('user_id')) }}">
          </div>
        </div>           
        <div class="modal-footer">
          <button id="submit_button" class="btn btn-danger confirm-btn" style="color:#fff";>Sa&#269;uvajte &#269;lanak</button>            
        </div>         
      </div>
    </div>
  </div>
  <script type="text/javascript"> 
      $(document).ready(function(){
        $(window).on('load', function(){
            $('#CreateForm').modal('show');
        }); 

        $('#submit_button').click(function(){
          var formData = new FormData();
          if ('file') {
            formData.append('file', $('#file')[0].files[0]);
          }
          formData.append('naslovClanka', $('#naslovClanka').val());
          formData.append('tekstClanka', $('#tekstClanka').val());
          formData.append('korisnik', $('#korisnik').val());

          $.ajax({
            url: '/create-article-ajax',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function (response) {
              location.href = '/single-article';
            }
          });
        });
      });   
  </script>	
</div>
@include('partials/footer')

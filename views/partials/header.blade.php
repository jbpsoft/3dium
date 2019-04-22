<!DOCTYPE html>
<html>
<head>
	<title>3dium</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ Links::base_url() }}app/css/style.css">
  <link rel="stylesheet" href="{{ Links::base_url() }}app/js/3dium.js">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body>    
    <nav id="nav">
      <ul>
        <li><a href="{{ Links::base_url() }}" >Home</a></li>
        @if(Session::has('user_id'))
	        <li><a href="{{ Links::base_url() }}create-article">Create</a></li>
	        <li><a href="{{ Links::base_url() }}delete-article">Delete</a></li>
	        <li><a href="{{ Links::base_url() }}update-article">Update</a></li>
	        <a class="btn btn-danger" href="/logout-form" style="position: relative; left: 845px">Logout</a>  
          <span onmouseover="style.color='white';" onmouseout="style.color='#4d0000';" style="position: absolute; font-size: 12pt; top: 7px; left: 575px; color:#4d0000;">&nbsp;&nbsp;Ulogovani ste kao {{ Users::where('users_id', base64_decode(Session::get('user_id')))->first()->name }}&nbsp;&nbsp;</span>        
        @else
        	<button class="btn btn-danger" data-target="#ModalLoginForm" data-toggle="modal" style="position: relative; left: 1100px">Login</button>
        @endif
      </ul>
    </nav> 
    <div id="ModalLoginForm" class="modal fade" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title text-xs-center" style="color:#000"; >Ulogujte se!</h4>
              <a class="close" data-dismiss="modal" style="color:#000 ">&nbsp;×&nbsp;</a>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ Links::base_url() }}login-form">
              <div class="form-group">
                  <label class="control-label">E-mail adresa</label>
                  <div>
                      <input type="email" class="form-control input-lg" name="email" value="">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label">Lozinka</label>
                  <div>
                      <input type="password" class="form-control input-lg" name="password">
                  </div>
              </div>
              
              <div class="form-group">
                  <button type="submit" class="btn btn-danger btn-block" style="color:#000";>Login</button>
              </div>
            </form>
            <div class="form-group">
              <center>
                <h3 style="color: red;">
                    <?php 
                      if($errors->first('email')){ 
                          echo $errors->first('email');?>
                        <script type="text/javascript">
                            $(window).on('load',function(){
                                $('#ModalLoginForm').modal('show');
                            });
                        </script>    
                      <?php                      
                      }elseif($errors->first('password')){
                          echo $errors->first('password');?>
                          <script type="text/javascript">
                              $(window).on('load',function(){
                                  $('#ModalLoginForm').modal('show');
                              });
                          </script>
                      <?php         
                      } 
                    ?>                          
                </h3>
              </center>
            </div>
          </div>           
        </div>
      </div>
    </div>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Notifaction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <br/><br/>
    <div class="container">
        <br/>
        <h2 align="center">Realtime Comment Web Socket</h2>
        <br/>

        <!--template-->
          <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a href="#" class="navbar-brand">Home</a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="label label-pill label-danger count"></span>
                    Notification
                  </a>
                  <ul class="dropdown-menu">
                    <!--nanti diakses dengan ajax javascript-->
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        <!--template-->
        <br/>
        <!--form-->
        <form class="form-horizontal" id="comment_form" method="post">
          <div class="form-group">
            <label class="col-lg-3 control-label">Subject:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Description Text :</label>
            <div class="col-lg-6">
              <textarea class="form-control" name="comment" id="comment"></textarea>
              <input type="hidden" name="status" id="status" value="0">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label"></label>
            <div class="col-lg-6">
            <input type="submit" name="post" id="post" class="btn btn-info" value="Post Comment">
          </div>
          </div>
        </form>
        <!--form-->

    </div>

<!--javascript ajx-->
<script type="text/javascript">
  $(document).ready(function(){

      function load_unseen_notification(view = ''){
        $.ajax({
          url:"fetch.php",
          method:"POST",
          data:{view:view},
          dataType:"json",
          success:function(data){
            $('.dropdown-menu').html(data.notification);
            if(data.unseen_notification > 0){
              $('.count').html(data.unseen_notification);
            }
          }
        });
      }

      load_unseen_notification();

      $('#comment_form').on('submit', function(event){
        event.preventDefault();
        if($('#subject').val()!='' && $('#comment').val()!=''){
          var form_data = $(this).serialize();
          $.ajax({
            url:"insert.php",
            method: "POST",
            data:form_data,
            success:function(data){
              $("#comment_form")[0].reset();
              load_unseen_notification();
            }
          })
        }else{
          alert('data still null please correct again.');
        }
      });

      $(document).on('click', '.dropdown-toggle', function(){
        $('.count').html('');
        load_unseen_notification('yes')
      });

      setInterval(function(){
        load_unseen_notification();
      }, 3000);
  });
</script>

  </body>
</html>

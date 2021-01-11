<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login");
  die();
}

include 'conn.php';
?>
<html>
 <head>
 <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Панель администратора</title>
	<link href="../img/icon.png" rel="icon" sizes="any" type="image/png">
  <link href="./css/style_admin.css" rel="stylesheet" type="text/css">
  <link href="../css/fonts/fonts.css" rel="stylesheet">
  <link href="./summernote/summernote.css" rel="stylesheet">
  <link href="./css/bootstrap.css" rel="stylesheet">
  <script src="./parts/admin.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/mark.js/8.6.0/jquery.mark.min.js"></script>
  <script src="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="./summernote/summernote.js"></script>
 </head>
 <body class="admin_body">
  <?php
    include_once 'navtop.php';
  ?>
  <div class="container box">
   <h1 class="admin_h1">Полезные советы</h1>
   <div align="left">
     <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="button_add">Добавить статью</button>
    </div>
   <div class="table-responsive">
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>&nbsp;&nbsp;&nbsp;&nbsp;Название&nbsp;&nbsp;&nbsp;&nbsp;<br></th>
       <th>Содержание<br></th>
       <th><br><br></th>
      </tr>
     </thead>
     <tbody class="tbody">
     </tbody>
    </table>
    
   </div>
  </div>

  <div id="userModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="user_form">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Добавить статью</h4>
      </div>
      <div class="modal-body">
      <label class="bold">Название</label>
      <input type="text" name="title" id="title" class="form-control inputFile" required/>
      <br />
      <label class="bold">Описание</label>
      <textarea name="content" id="content" class="form-control inputFile" required></textarea>
      <br />
      <br />
      <div class="modal-footer">
      <input type="hidden" name="id" id="id" />
      <input type="hidden" name="operation" id="operation" />
      <input type="submit" name="action" id="action" class="bttn bttn-success" value="Add" />
      <button type="button" class="bttn bttn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
    </form>
  </div>
  </div>

  <script>

  $(document).ready(function(){

    $('#add_button').click(function(){
        
        $("#content").summernote({
        height: 350,
        maxHeight: 350,
        minHeight: 200,
        focus:true,
      });

      $(".panel-body").html("");
      
      $('#user_form')[0].reset();
      $('.modal-title').text("Добавить статью");
      $('#action').val("Сохранить");
      $('#operation').val("Add");
    });

    var dataTable = $('#user_data').DataTable({
      "processing":true,
      "serverSide":true,
      stateSave: true,
      "info": false,
      "autoWidth": false,
      "order":[],
      mark: true,
      "ajax":{
        url:"parts/a_fetch",
        type:"POST"
      },
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Russian.json"
      },
      "columnDefs":[{
        "targets":[0,1,2],
        "orderable":false,
      },],
    });

    dataTable.search('').columns().search('').draw();

    $(document).on('submit', '#user_form', function(event){
    
      event.preventDefault();
      var title = $('#title').val();
      var content = $('#content').val();

      if(title != '' && content != ''){
    
        $.ajax({
          url:"parts/a_insert",
          method:'POST',
          data:new FormData(this),
          contentType:false,
          processData:false,
        
          success:function(data){
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Успех!',
              showConfirmButton: false,
              timer: 1500
            })
      
            $('#user_form')[0].reset();
            $('#userModal').modal('hide');
            dataTable.ajax.reload();
          },

          error:function(data){
            Swal.fire({
              icon: 'error',
              title: 'Произошла ошибка, попробуйте снова.',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });

        }else{
          Swal.fire({
            icon: 'error',
            title: 'Произошла ошибка, сообщите администратору.',
            showConfirmButton: false,
            timer: 1500
          })
        }
    });
    
    $(document).on('click', '.update', function(){

      $("#content").summernote({
        height: 350,
        maxHeight: 350,
        minHeight: 200,
        focus:true,
      });
      
      var id = $(this).attr("id");

      $.ajax({
        url:"parts/a_fetch_single",
        method:"POST",
        data:{id:id},
        dataType:"json",

          success:function(data){
            $('#userModal').modal('show');
            $('#title').val(data.title);
            $('#content').val(data.content);
            var copyText = $('#content').val();
            $(".panel-body").html(copyText);
            $('.modal-title').text("Редактировать статью");
            $('#id').val(id);
            $('#action').val("Сохранить");
            $('#operation').val("Edit");
          }
      })
    });
    
    $(document).on('click', '.delete', function(){
      
      var id = $(this).attr("id");
      
      Swal.fire({
        title: 'Вы уверены, что хотите удалить эту статью?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да, удалить',
        cancelButtonText: 'Нет'
      
      }).then((result) => {
    
        if (result.isConfirmed) {

          $.ajax({
            url:"parts/a_delete",
            method:"POST",
            data:{id:id},
            
            success:function(data){
              dataTable.ajax.reload();
              Swal.fire({
                icon: 'success',
                title: 'Статья удалена!',
                showConfirmButton: false,
                timer: 1500
              })
            },

            error:function(data){
              Swal.fire({
                icon: 'error',
                title: 'Произошла ошибка, попробуйте снова.',
                showConfirmButton: false,
                timer: 1500
              })
            }
          });
        }
      })
    });
  });

  </script>

  </body>
</html>
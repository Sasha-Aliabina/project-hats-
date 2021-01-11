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
    <h1 class="admin_h1">Шляпный журнал</h1>
    <div align="left">
      <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="button_add">Добавить статью</button>
      </div>
    <div class="table-responsive">
      <table id="user_data" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Дата публикации<br></th>
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
      <div class="modal-content">
        <div class="modal-header">
        <form method="post" id="user_form">
        <h4 class="modal-title">Добавить статью</h4>
        </div>
        <div class="modal-body">
          <label for="user_date" class="bold">Выбрать дату</label>
          <div class="date"><input type="date" id="user_date" name="user_date" value="" min="2020-12-01" max="2030-12-31"></div>
        <label for="content" class="bold">Содержание</label>
        <textarea name="content" id="content" class="form-control inputFile" required></textarea>
        <br />
        <br />
        <div class="modal-footer">
          <input type="hidden" name="id" id="id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="submit" name="action" id="action" class="bttn bttn-success" value="Add" />
          <button type="button" class="bttn bttn-default" data-dismiss="modal">Закрыть</button>
          </form>
          <form method="POST" action="" enctype="multipart/form-data">
            <label for="files" class="file_upload"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="14px" height="14px"><path d="M 16 3.59375 L 15.28125 4.28125 L 8.28125 11.28125 L 9.71875 12.71875 L 15 7.4375 L 15 24 L 17 24 L 17 7.4375 L 22.28125 12.71875 L 23.71875 11.28125 L 16.71875 4.28125 L 16 3.59375 z M 7 26 L 7 28 L 25 28 L 25 26 L 7 26 z" style="fill:none;stroke:#111111;stroke-width:3;stroke-linecap:round;"/></svg><input type="file" id="files" name="files" class="file_upload_input"/></label>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>

  $(document).ready(function(){

    $("#files").change(function(){

    var fd = new FormData();
    var files = $('#files')[0].files;

    if(files.length > 0 ){
      fd.append('file',files[0]);

      $.ajax({
        url: 'parts/upload_file',
        type: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          if(response != 0){
              console.log(response);
              $("#content").summernote('pasteHTML', response);

          }else{
              alert('Ошибка загрузки');
          }
        },
    });
  }else{
    alert("Пожалуйста, выберите файл");
  }
  });

    $('#add_button').click(function(){

      $("#content").summernote({
        
        height: 350,
        maxHeight: 350,
        minHeight: 200,
        focus:true
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
        url:"parts/j_fetch",
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
      var user_date = $('#user_date').val();
      var content = $('#content').val();

      if(user_date != '' && content != ''){
    
        $.ajax({
          url:"parts/j_insert",
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
            title: 'Заполните все поля',
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
        focus:true
      });
      
      var id = $(this).attr("id");

      $.ajax({
        url:"parts/j_fetch_single",
        method:"POST",
        data:{id:id},
        dataType:"json",

          success:function(data){
            $('#userModal').modal('show');
            $('#user_date').val(data.user_date);
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
            url:"parts/j_delete",
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
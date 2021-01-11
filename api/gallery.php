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
  <link href="./css/specific.css" rel="stylesheet" type="text/css">
  <link href="../css/fonts/fonts.css" rel="stylesheet">
  <script src="./parts/admin.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/mark.js/8.6.0/jquery.mark.min.js"></script>
<script src="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 </head>
 <body class="admin_body">
  <?php
    include_once 'navtop.php';
  ?>
  <div class="container box">
   <h1 class="admin_h1">Галерея</h1>
   <div align="left">
     <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="button_add">Добавить фотокарточку</button>
    </div>
   <div class="table-responsive">
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Фотография<br></th>
       <th>Превью<br></th>
       <th>&nbsp;&nbsp;&nbsp;&nbsp;Название&nbsp;&nbsp;&nbsp;&nbsp;<br></th>
       <th">Описание<br></th>
       <th><br><br></th>
      </tr>
     </thead>
     <tbody class="tbody">
      <tr>
       <th class="td1"></th>
       <th class="td2"></th>
       <th class="td3"></th>
       <th class="td4"></th>
       <th></th>
      </tr>
     </tbody>
    </table>
   </div>
  </div>

  <div id="userModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="user_form" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Добавить фотокарточку</h4>
      </div>
      <div class="modal-body">
      <label class="bold">Название</label>
      <input type="text" name="title" id="title" class="form-control inputFile"/>
      <br />
      <label class="bold">Описание</label>
      <textarea name="content" id="content" class="form-control inputFile"></textarea>
      <br />
      <div class="conteiner_upload">
        <label class="labelPhoto" for="photo">Фотография:</label>
        <label class="labelPhoto" for="photo_xs">Превью:</label>
      </div>
      <div class="conteiner_upload">
          <label for="photo" class="labelFile">
            <input type="file" class="updateFile" accept="image/*" id="photo" name="photo" id="photo" onchange="loadFile1(event)">
            <span class="iconFile"><i class="fas fa-file-download"></i></span>
            <span class="buttonFile">Выберите<br>файл</span>
            <span id="user_uploaded_image"></span>
          </label>
          <label for="file-select" class="labelFile">
            <input type="file" class="updateFile" accept="image/*" id="photo_xs" name="photo_xs" id="photo_xs" onchange="loadFile2(event)">
            <span class="iconFile"><i class="fas fa-file-download"></i></span>
            <span class="buttonFile">Выберите<br>файл</span>
            <span id="user_uploaded_image_xs"></span>
        </label>
      </div>
      <div class="conteiner_upload">
        <div><img id="output1"/></div>
        <div><img id="output2"/></div>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="id" id="id" />
      <input type="hidden" name="operation" id="operation" />
      <input type="submit" name="action" id="action" class="bttn bttn-success" value="Add"/>
      <button type="button" class="bttn bttn-default bttn-delete" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
    </form>
  </div>
  </div>

  <script>
  $(document).ready(function(){

    $('#add_button').click(function(){
      $('#user_form')[0].reset();
      $('.modal-title').text("Добавить фотокарточку");
      $('#action').val("Сохранить");
      $('#operation').val("Add");
      $('#user_uploaded_image').html('');
      $('#user_uploaded_image_xs').html('');
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
        url:"parts/g_fetch",
        type:"POST"
      },
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Russian.json"
      },
      "columnDefs":[{
        "targets":[0,1,2,3,4],
        "orderable":false,
      },],
    });

    dataTable.search('').columns().search('').draw();

    $(document).on('submit', '#user_form', function(event){

    event.preventDefault();
    var title = $('#title').val();
    var content = $('#content').val();
    var extension = $('#photo').val().split('.').pop().toLowerCase();
    var extension_xs = $('#photo_xs').val().split('.').pop().toLowerCase();
    
    if(extension != '' && extension_xs != ''){

      if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1){
      
        Swal.fire({
          icon: 'warning',
          title: 'Неверный формат файла.',
          text: 'Допустимые форматы - jpg, jpeg, png.',
          showConfirmButton: false,
          timer: 1500
        })
        $('#photo').val('');
        return false;
      }

      if(jQuery.inArray(extension_xs, ['png','jpg','jpeg']) == -1){

        Swal.fire({
          icon: 'warning',
          title: 'Неверный формат файла.',
          text: 'Допустимые форматы - jpg, jpeg, png.',
          showConfirmButton: false,
          timer: 1500
        })
        $('#photo_xs').val('');
        return false;
      }
    }

    if(title != '' && content != ''){
    
      $.ajax({
        url:"parts/g_insert",
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
          icon: 'warning',
          title: 'Заполните все поля!',
          showConfirmButton: false,
          timer: 1500
        })
      }
    });

    $(document).on('click', '.update', function(){

      var id = $(this).attr("id");
    
      $.ajax({
        url:"parts/g_fetch_single",
        method:"POST",
        data:{id:id},
        dataType:"json",
      
        success:function(data){
          $('#userModal').modal('show');
          $('#title').val(data.title);
          $('#content').val(data.content);
          $('.modal-title').text("Редактировать фотокарточку");
          $('#id').val(id);
          $('#user_uploaded_image').html(data.photo);
          $('#user_uploaded_image_xs').html(data.photo_xs);
          $('#action').val("Сохранить");
          $('#operation').val("Edit");
        }
      })
    });
  
    $(document).on('click', '.delete', function(){
    
      var id = $(this).attr("id");
    
      Swal.fire({
        title: 'Вы уверены, что хотите удалить эту фотокарточку?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да, удалить',
        cancelButtonText: 'Нет'
      
      }).then((result) => {
    
        if (result.isConfirmed) {

          $.ajax({
            url:"parts/g_delete",
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
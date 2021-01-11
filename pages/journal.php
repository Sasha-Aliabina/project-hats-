<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Шляпиум - онлайн-журнал о головных уборах от Павловой Светланы.</title>
  <meta name="description" content="Заметки, статьи, мастер-классы, выкройки шляп.">
  <meta name="author" content="Павлова Светлана" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="../img/icon.png" rel="icon" sizes="any" type="image/png">
  <link href="../css/style.css" rel="stylesheet">
  <link href= "https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=PT+Serif&display=swap" rel="stylesheet">
  <link href="../css/fonts/fonts.css" rel="stylesheet" />
  <link href="../css/fonts/fontsocial.css" rel="stylesheet"/>
  <link href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
</head>
<body>
  <?php
		require_once '../components/header.php';
	?>
  <div class="conteiner_journal">
    <div class="journal_blocks">
      <div class="form-group">
        <label for="search_box" class="search_icon">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="18" height="18" x="0" y="0" viewBox="0 0 136 136.21852" style="enable-background:new 0 0 512 512" xml:space="preserve">
          <g><path d="M 93.148438 80.832031 C 109.5 57.742188 104.03125 25.769531 80.941406 9.421875 C 57.851562 -6.925781 25.878906 -1.460938 9.53125 21.632812 C -6.816406 44.722656 -1.351562 76.691406 21.742188 93.039062 C 38.222656 104.707031 60.011719 105.605469 77.394531 95.339844 L 115.164062 132.882812 C 119.242188 137.175781 126.027344 137.347656 130.320312 133.269531 C 134.613281 129.195312 134.785156 122.410156 130.710938 118.117188 C 130.582031 117.980469 130.457031 117.855469 130.320312 117.726562 Z M 51.308594 84.332031 C 33.0625 84.335938 18.269531 69.554688 18.257812 51.308594 C 18.253906 33.0625 33.035156 18.269531 51.285156 18.261719 C 69.507812 18.253906 84.292969 33.011719 84.328125 51.234375 C 84.359375 69.484375 69.585938 84.300781 51.332031 84.332031 C 51.324219 84.332031 51.320312 84.332031 51.308594 84.332031 Z M 51.308594 84.332031 " fill="#777777" data-original="#000000"></path>
          </g></svg>
        <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Поиск"/>
      </label>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive" id="dynamic_content">
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
		require_once '../components/footer.php';
	?>
  <script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"components/j_fetch",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
          $("html, body").animate({
            scrollTop:0
          },500);
              }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);

    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });
  });
</script>
  </body>
  </html>
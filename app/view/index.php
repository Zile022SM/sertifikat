<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo URLROOT;?>/css/front/style.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
  <head>
    <title>Procoding</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  </head>
  <!-- Coded with love by Mutiullah Samim-->
  <body>
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
          <form class="example" action="<?php echo URLROOT;?>/sertifikati/rezultat" method="post">
              <input type="text" placeholder="Unesite broj sertifikata..." name="broj_sertifikata">
              <button type="submit"><i class="fa fa-search"></i></button>
              <p style="color:white;" class="blinking"><?php echo (!empty($data['greska']))?$data['greska']:""; ?></p>
              <p style="color:white;" class="blinking"><?php echo (!empty($data['greska_eng']))?$data['greska_eng']:""; ?></p>
          </form>
      </div>
      
    </div>
  </body>
</html>
<?php
   $error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
    
   if (! $error) {
       $error = 'Helaas is er een probleem opgetreden. Excuses voor het ongemak..';}
       
   ?>
<!doctype html>
<html lang="nl">
   <head>
      <meta charset="utf-8">
      <title>Readers Online: Error</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">

      <style type="text/css" class="init"> 
         td.details-control {
         background: url('images/details_open.png') no-repeat center center; 
         cursor: pointer;
         } 
         tr.details td.details-control {
         background: url('images/details_close.png') no-repeat center center;
         }
         .left {
         position: absolute;
         left: 10px;
         .dataTables_filter input { width: 350px }
         }
      </style>
      <link rel="stylesheet" type="text/css" href="../DataTables/datatables.css">
      <link rel="stylesheet" type="text/css" href="../Editor/css/editor.dataTables.css">
      <link rel="stylesheet" type="text/css" href="../DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="../DataTables/Buttons-1.5.4/css/buttons.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="../DataTables/Select-1.2.6/css/select.dataTables.min.css">
      <link href="../DataTables/Bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/new.css" type="text/css"/>

      <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> 
      <script type="text/javascript" src="../DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="../DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="../DataTables/Select-1.2.6/js/dataTables.select.min.js"></script>
      <script type="text/javascript" src="../DataTables/datatables.js"></script>
      <script type="text/javascript" src="../Editor/js/dataTables.editor.min.js"></script>
      <script src="../DataTables/Bootstrap-3.3.7/js/bootstrap.min.js"></script>        
      <script src="js/menuscript.js"></script>   
      <script>
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         
         ga('create', 'UA-20266439-2', 'auto');
         ga('send', 'pageview');
         
      </script>        
   </head>
   <body>
      <table id="wrapper" border="0" cellspacing="0">
         <tbody>
            <td id="tekst">
               <div id="advsearch">
                  <h1>Error</h1>
                  <p class="error"> <?php echo $error; ?></p>
                  <p></p>
                  <p>Terug naar de <a href="login.php">login pagina</a>.</p>
                  <p></p>
                  <p style="height: 500px;">
                  </p>
            </td>
            </tr>
            <tr>
            <td id="td_navigatie">
            <div id="MainMenu">
            <a class="btn btn-default" href="lijst.php" role="button">Licentielijst</a>
            <a class="btn btn-default" href="ebooks.php" role="button">E-books-lijst</a>
            <a class="btn btn-default" href="uitgeversplatforms.php" role="button">Uitgevers / platforms</a>
            <?php if ($logged == 'in'){
               // echo "<li><a href=\"admin/adminlijst.php\" class=\"back\">Bewerk SURFlijst</a></li> ";
                ?>
            Bewerken
            <a class="btn btn-default" href="admin/adminlijst.php" role="button">Bewerk Licentielijst</a>
            <a class="btn btn-default" href="admin/adminebooks.php" role="button">Bewerk e-books-lijst</a>
            <a class="btn btn-default" href="admin/adminuitgeversplatforms.php" role="button">Bewerk Uitgevers / platforms</a>
            <a class="btn btn-default" href="register.php" role="button">Registreer</a>
            <a class="btn btn-default" href="include/logout.php" role="button">Log off</a>
            <?php   }
               else
               echo "<a class=\"btn btn-default\" href=\"login.php\" role=\"button\">Bewerken</a>";   
               ?> 
            </div></div>
            </td></tr>
         </tbody>
      </table>
   </body>
</html>
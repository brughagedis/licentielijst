<?php
//Inlogsscript overgenomen van:
//https://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
   include_once 'include/db_connect.php';
   include_once 'include/functions.php';
   
   sec_session_start(); 
   
   if (login_check($mysqli) == true) {
       $logged = 'in';
   } else {
       $logged = 'out';
   }
   
   ?>
<!doctype html>
<html lang="nl">
   <head>
      <meta charset="utf-8">
      <title>Readers Online: Registration Success</title>
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
      <link rel="stylesheet" type="text/css" href="../DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../DataTables/Buttons-1.5.4/css/buttons.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="../DataTables/Select-1.2.6/css/select.dataTables.min.css">      
      <link rel="stylesheet" type="text/css" href="../DataTables/Bootstrap-3.3.7/css/bootstrap.min.css" >
      <link rel="stylesheet" type="text/css" href="../Editor/css/editor.bootstrap.min.css">
      <link rel="stylesheet" href="css/new.css" type="text/css"/>

      <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="../DataTables/Bootstrap-3.3.7/js/bootstrap.min.js"></script> 
      <script type="text/javascript" src="../DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="../DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript" src="../DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="../DataTables/Select-1.2.6/js/dataTables.select.min.js"></script>
      <script type="text/javascript" src="../Editor/js/dataTables.editor.min.js"></script>
      <script type="text/javascript" src="../Editor/js/editor.bootstrap.min.js"></script>    
      <script src="js/menuscript.js"></script>   
      <script type="text/JavaScript" src="js/sha512.js"></script> 
      <script type="text/JavaScript" src="js/forms.js"></script> 
      <script>
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         
         ga('create', 'UA-20266439-2', 'auto');
         ga('send', 'pageview');
         
      </script>   
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
         <TBODY>
            <tr>
               <td id="tekst" >
                  <div id="advsearch">
                     <p></p>
                     <?php if ($logged == 'in') {  ?>
                     <div class="alert alert-success">    
                     <h2>Registratie is gelukt!</h2>
                     <p>U kunt nu terug gaan naar de <a href="login.php">login pagina</a> en inloggen</p>
                     </div>
                     <p style="height: 500px;"></p>
                     <?php }
                        else {?>          
                     <p>
                        <span class="error">Helaas, u bent niet bevoegd om deze pagina te bekijken.</span> Terug naar de <a href="login.php">login pagina</a>.
                     </p>
                     <?php } ?>
               </td>
            </tr>
            </div></div>
            <tr>
               <td id="td_navigatie">
                  <div id="MainMenu" class="btn-group">
                     <a class="btn btn-default" href="lijst.php" role="button">Licentielijst</a>
                     <a class="btn btn-default" href="ebooks.php" role="button">E-books-lijst</a>
                     <a class="btn btn-default" href="uitgeversplatforms.php" role="button">Uitgevers / platforms</a>
                     <?php if ($logged == 'in'){
                         ?>
                     <a class="btn btn-default" href="admin/adminlijst.php" role="button">Bewerk Licentielijst</a>
                     <a class="btn btn-default" href="admin/adminebooks.php" role="button">Bewerk e-books-lijst</a>
                     <a class="btn btn-default" href="admin/adminuitgeversplatforms.php" role="button">Bewerk Uitgevers / platforms</a>
                     <a class="btn btn-default active" href="register.php" role="button">Registreer</a>
                     <a class="btn btn-default" href="../include/logout.php" role="button">Log off</a>
                     <?php   }
                        else
                        echo "<a class=\"btn btn-default\" href=\"login.php\" role=\"button\">Bewerken</a>";   
                        ?>         
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>

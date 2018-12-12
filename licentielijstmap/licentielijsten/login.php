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
      <title>Readers Online: Bewerken</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/datatables.css">     
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/Editor/css/editor.dataTables.css">   
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Datatables-1.10.18/css/jquery.dataTables.min.css">  
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Datatables-1.10.18/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Buttons-1.5.4/css/buttons.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Select-1.2.6/css/select.dataTables.min.css">      
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Bootstrap-3.3.7/css/bootstrap.min.css" >
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/Editor/css/editor.bootstrap.min.css">
      <link rel="stylesheet" href="css/new.css" type="text/css"/>

      <style>
        input[type="text"] {
        width: 250px;
        }

        input[type="password"] {
        width: 250px;
        }
    </style>
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="/licentielijstmap/DataTables/Bootstrap-3.3.7/js/bootstrap.min.js"></script> 
      <script type="text/javascript" src="/licentielijstmap/DataTables/Datatables-1.10.18/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/DataTables/Datatables-1.10.18/js/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/DataTables/Select-1.2.6/js/dataTables.select.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/Editor/js/dataTables.editor.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/Editor/js/editor.bootstrap.min.js"></script>    
      <script src="js/menuscript.js"></script> 
      <script type="text/JavaScript" src="js/sha512.js"></script> 
      <script type="text/JavaScript" src="js/forms.js"></script> 
       
   </head>
   <body>
      <table id="wrapper" border="0" cellspacing="0">
         <tbody>
            <tr>
               <td id="tekst" >
                  <div id="advsearch">
                     <h3>Login</h3>
                     <p>Om de tijdschriften en e-bookslijsten te bewerken moet je hier inloggen.</p>
                     <p style="height: 50px;"></p>
                     <p>
                        <?php
                           if (isset($_GET['error'])) {
                               echo '<p class="error">Fout bij inloggen!</p>';
                           }
                           ?> 
                     <form action="include/process_login.php" method="post" name="login_form">
                        <table class="display" cellspacing="0" width="100%" border="0">
                           <thead>
                              <tr>
                                 <th></th>
                                 <th ></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Email:  </td>
                                 <td> <input type="text" name="email"/> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p style="height: 5px;"></p>
                                 </td>
                              </tr>
                              <tr>
                                 <td>Password: </td>
                                 <td> <input type="password" 
                                    name="password" 
                                    id="password"/> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p style="height: 5px;"></p>
                                 </td>
                              </tr>
                              <tr>
                                 <td></td>
                                 <td> <input type="button" 
                                    value="Login" 
                                    onclick="formhash(this.form, this.form.password);" /> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p></p>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </form>
                     <?php if ($logged == 'in'){
                        echo "<p>Voor een eigen login, kunt u zich hier <a href=\"register.php\">registreren</p>";
                        
                        echo "<p>Als u klaar bent, log dan <a href=\"../include/logout.php\">hier </a> uit.</p>";
                        echo "<p>Op dit moment bent u logged ".$logged.".</p>";
                        }
                        ?>
                     </p>
                     <p style="height: 440px;"></p>
                     <p></p>
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
                     <a class="btn btn-default" href="register.php" role="button">Registreer</a>
                     <a class="btn btn-default" href="../include/logout.php" role="button">Log off</a>
                     <?php   }
                        else
                        echo "<a class=\"btn btn-default active\" href=\"login.php\" role=\"button\">Bewerken</a>";   
                        ?> 
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>

<?php
//Inlogsscript overgenomen van:
//https://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL

   include_once 'include/register.inc.php';
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
      <title>Readers Online: Registration Form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
      <link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
      <style type="text/css" class="init"> 
         td.details-control {
         background: url('../images/details_open.png') no-repeat center center; 
         cursor: pointer;
         } 
         tr.details td.details-control {
         background: url('../images/details_close.png') no-repeat center center;
         }
         .left {
         position: absolute;
         left: 10px;
         .dataTables_filter input { width: 350px }
         }
      </style>
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/datatables.css">     
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/Editor/css/editor.dataTables.css">   
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Datatables-1.10.18/css/jquery.dataTables.min.css">  
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Datatables-1.10.18/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Buttons-1.5.4/css/buttons.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Select-1.2.6/css/select.dataTables.min.css">      
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/DataTables/Bootstrap-3.3.7/css/bootstrap.min.css" >
      <link rel="stylesheet" type="text/css" href="/licentielijstmap/Editor/css/editor.bootstrap.min.css">
      <link rel="stylesheet" href="css/new.css" type="text/css"/>

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
         <TBODY>
            <tr>
               <td id="tekst" >
                  <div id="advsearch">
                     <p></p>
                      <?php if ($logged == 'in'){ ?>
                     <h2>Registreer hier</h2>
                     <?php
                        if (!empty($error_msg)) {
                            print "<div class=\"alert alert-danger\"><strong>";
                            echo $error_msg;
                            print "</strong></div>";
                        }
                        ?>
                    <div class="alert alert-info">
                     <ul>
                        <li>Gebruikersnamen mogen alleen cijfers, hoofdletters en kleine letters en underscores bevatten.</li>
                        <li>E-mail adressen moet een geldige email format hebben</li>
                        <li>Wachtwoorden moeten tenminste 6 karakters lang zijn.</li>
                        <li>
                           Wachtwoorden moeten de volgende tekens bevatten:
                           <ul>
                              <li>Ten minste &eacute;&eacute;n hoofdletter (A..Z)</li>
                              <li>Ten minste &eacute;&eacute;n kleine letter (a..z)</li>
                              <li>Ten minste &eacute;&eacute;n getal (0..9)</li>
                           </ul>
                        </li>
                        <li>Uw wachtwoord en bevestiging moeten exact overeenkomen  </li>
                     </ul>
                     </div>
                     <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                        method="post" 
                        name="registration_form">
                        <table class="display" cellspacing="0" width="100%" border="0">
                           <thead>
                              <tr>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                              </tr>        </thead>
                           <tbody>
                              <tr>
                                 <td>Naam:  </td>
                                 <td> <input type='text' name='username' id='username' /> </td>
                              </tr>
                              <tr>
                                 <td>Email:  </td>
                                 <td> <input type="text" name="email" id="email" /> </td>
                              </tr>
                              <tr>
                                 <td>Password: </td>
                                 <td> <input type="password" name="password" id="password"/> </td>
                              </tr>
                              <tr>
                                 <td>Bevestig password: </td>
                                 <td> <input type="password" name="confirmpwd" id="confirmpwd" />  
                              </tr>
                              <tr>
                                 <td></td>
                                 <td> <input type="button"                                                                                                            
                                    value="Registreer" 
                                    onclick="return regformhash(this.form,
                                    this.form.username,
                                    this.form.email,
                                    this.form.password,
                                    this.form.confirmpwd);" />  </td>
                              </tr>
                           </tbody>
                        </table>
                     </form>
                     <p style="height: 300px;"></p>
                     <?php }
                        else 
                        { ?>          
                     <p>
                        <span class="error">Helaas, u bent niet bevoegd om deze pagina te bekijken.</span> Terug naar de <a href="login.php">login pagina</a>.
                     </p>
                     <?php } ?>
               </td>
            </tr>
            </div></div>
            </td>
            </tr>                
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
                     <a class="btn btn-default" href="include/logout.php" role="button">Log off</a>
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

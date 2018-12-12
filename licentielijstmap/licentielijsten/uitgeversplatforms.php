<?php
//Inlogsscript overgenomen van:
//https://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL

   include_once 'include/db_connect.php';
   include_once 'include/functions.php';
   
   sec_session_start();
   
   if ( login_check( $mysqli ) == true ) {
   			$logged = 'in';
   			 } else {
   			$logged = 'out';
   			 } 
   
   ?>
<!doctype html>
<html lang="nl">
   <head>
      <meta charset="utf-8">
      <title>Uitgevers en platforms</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
      <link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
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
      <script type="text/javascript" class="init">
         var editor; 
         
         $(document).ready(function() {
         	editor = new $.fn.dataTable.Editor( {
         		ajax: "scripts/uitgeverplatformjoin.php",
         		table: "#uitgeverplatformlijst" 	
         	} );
         
         
         	$('#uitgeverplatformlijst').DataTable( {
         		dom: "lrtip",
         			ajax: {
         			url: "scripts/uitgeverplatformjoin.php",
         			type: "POST"
         		},
         		responsive: true,
         		serverSide: true,
         	"columnDefs": [ 
         	{ "render": function (data, type, row) {
               if ( data === 'Ja' ){ return '<img src="images/yes.png">';
               } else if ( data === 'Nee' )
               { return '<img src="images/no.png">';
               }
          },
          "targets": [1,2,3]
         }
         ],
            columns: [
         			{ data: "uitgeverplatform" },
               { data: "linkingincanvas" },
               { data: "pdfincanvas" },
               { data: "inprintreader"}
         		],
         		
         		
         		"order": [0, 'asc'],
         		
         			
                  "language": {
                  "info":           "Tonen van _START_ tot _END_ van in totaal _TOTAL_ titels",
                  "lengthMenu":     "Toon _MENU_ titels",
                 "search": "Zoek:",
                 "paginate": {
                 "first":      "Eerste",
                 "last":       "Laatste",
                 "next":       "Volgende",
                 "previous":   "Voorgaande"
             }
         
           }
         
         	} );
           
         var table = $('#uitgeverplatformlijst').DataTable();
           
         $('#magnifying_glass').on( 'click', function () {
         
         table
         .columns( 0 )
         .search( document.getElementById("zoekveld").value )
         .draw();
         } );
         
         	
         } );
         
         
         
         
         
         	
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
      <div id="advsearch">
         <table id="wrapper" border="0" cellspacing="0">
            <tbody>
               <tr>
                  <td id="tekst" >
                     <h3>Uitgevers en platforms</h3>
                     <p>Deze lijst vermeldt de uitgevers en platforms waarbij de UvA tijdschriften of e-books heeft gelicentie&euml;rd .</p>
                          </td>
                           </tr>
                           <tr>
                              <td>
                                 <div id="search">
                                    <div class="search-box">
                                       <input id= "zoekveld" value="" type="search" autocomplete="off"  placeholder="Zoek..."/><button id="magnifying_glass"><img src="images/magnifying_glass.png" width="30" height="30" border="0"></button>
                                    </div>
                                 </div>
                  </td>
               </tr>
               <tr>
                  <td>
                     <div class="table">
                        <table id="uitgeverplatformlijst" class="display responsive wrap" cellspacing="0" width="100%">
                           <thead>
                              <tr>
                                 <th>Uitgever/platform</th>
                                 <th>Linken in Canvas of online reader</th>
                                 <th>PDF op Canvas of in online reader</th>
                                 <th>Opname in gedrukte reader</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td colspan="4" class="dataTables_empty">Downloaden van gegevens over de uitgevers / platforms van de server.</td>
                              </tr>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th>Uitgever/platform</th>
                                 <th>Linken in Canvas of online reader</th>
                                 <th>PDF op Canvas of in online reader</th>
                                 <th>Opname in gedrukte reader</th>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                  </td>
               <tr>
                  <td id="td_navigatie">
                     <div class="clearfix">
                        <div id="MainMenu" class="btn-group">
                           <a class="btn btn-default" href="lijst.php" role="button">Licentielijst</a>
                           <a class="btn btn-default" href="ebooks.php" role="button">E-books-lijst</a>
                           <a class="btn btn-default active" href="uitgeversplatforms.php" role="button">Uitgevers / platforms</a>
                           <?php if ($logged == 'in'){

                               ?>
                           <a class="btn btn-default" href="admin/adminlijst.php" role="button">Bewerk Licentielijst</a>
                           <a class="btn btn-default" href="admin/adminebooks.php" role="button">Bewerk e-books-lijst</a>
                           <a class="btn btn-default" href="admin/adminuitgeversplatforms.php" role="button">Bewerk Uitgevers / platforms</a>
                           <a class="btn btn-default" href="register.php" role="button">Registreer</a>
                           <a class="btn btn-default" href="include/logout.php" role="button">Log off</a>
                           <?php   }
                              else
                              echo "<a class=\"btn btn-default\" href=\"login.php\" role=\"button\">Bewerken</a>";   
                              ?> 
                        </div>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </body>
</html>
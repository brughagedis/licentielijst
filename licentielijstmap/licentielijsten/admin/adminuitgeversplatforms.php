<?php
//Inlogsscript overgenomen van:
//https://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL

   include_once '../include/db_connect.php';
   include_once '../include/functions.php';
   
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
      <title>Bewerk lijst uitgevers en platforms</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">

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
      <link rel="stylesheet" type="text/css" href="../../DataTables/datatables.css">     
      <link rel="stylesheet" type="text/css" href="../../Editor/css/editor.dataTables.css">   
      <link rel="stylesheet" type="text/css" href="../../DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css">  
      <link rel="stylesheet" type="text/css" href="../../DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../../DataTables/Buttons-1.5.4/css/buttons.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="../../DataTables/Select-1.2.6/css/select.dataTables.min.css">      
      <link rel="stylesheet" type="text/css" href="../../DataTables/Bootstrap-3.3.7/css/bootstrap.min.css" >
      <link rel="stylesheet" type="text/css" href="../../Editor/css/editor.bootstrap.min.css">
      <link rel="stylesheet" href="../css/new.css" type="text/css">
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="../../DataTables/Bootstrap-3.3.7/js/bootstrap.min.js"></script> 
      <script type="text/javascript" src="../../DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="../../DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript" src="../../DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="../../DataTables/Select-1.2.6/js/dataTables.select.min.js"></script>
      <script type="text/javascript" src="../../Editor/js/dataTables.editor.min.js"></script>
      <script type="text/javascript" src="../../Editor/js/editor.bootstrap.min.js"></script>  
      <script type="text/javascript" class="init">
         var editor; 
         
         
         
         $(document).ready(function() {
         	editor = new $.fn.dataTable.Editor( {
         		ajax: "../scripts/adminuitgeverplatform.php",
         		table: "#uitgeverplatformlijst",
         		fields: [
         			{
         				label: "Uitgever / platform:",
         				name: "uitgeverplatform"
         			},
         			{
         				label: "Type:",
         				name: "type",
                 type:  "select",
                ipOpts: [
                             { label: "Tijdschriften", value: "Tijdschriften" },
                             { label: "Tijdschriften/eBooks", value: "Tijdschriften/eBooks" },
                             { label: "eBooks", value: "eBooks" }
                         ]
         			},
         			{
         				label: "Linken in Canvas en online reader:",
         				name: "linkingincanvas",
                 type:  "select",
                ipOpts: [
                             { label: "Ja", value: "Ja" },
                             { label: "Nee", value: "Nee" },
                             { label: "Onbekend", value: "Onbekend" }
                         ]
                 
         			},
         			{
         				label: "Pdf in Canvas:",
         				name: "pdfincanvas",
                 type:  "select",
                ipOpts: [
                             { label: "Ja", value: "Ja" },
                             { label: "Nee", value: "Nee" },
                             { label: "Onbekend", value: "Onbekend" }
                         ]
         			},
         				{
         				label: "In geprinte reader:",
         				name: "inprintreader",
                 type:  "select",
                ipOpts: [
                             { label: "Ja", value: "Ja" },
                             { label: "Nee", value: "Nee" },
                             { label: "Onbekend", value: "Onbekend" }
                         ]
         			}
         		]	
         	} );
         
         	$('#uitgeverplatformlijst').DataTable( {
         		dom: "Blrtip",
         			ajax: {
         			url: "../scripts/adminuitgeverplatform.php",
         			type: "POST"
         		},
         		responsive: true,
         		serverSide: true,
             "columnDefs": [ 
             { "render": function (data, type, row) {
               if ( data === 'Ja' ){ return '<img src="../images/yes.png">';
               } else if ( data === 'Nee' )
               { return '<img src="../images/no.png">';
               }
          },
          "targets": [2,3]},
          {
        targets: [2,3],
        className: 'dt-center'
    }  
          
          
          
         ],
         
            columns: [	
               { data: "uitgeverplatform" },
               { data: "type" },
               { data: "pdfincanvas" },
               { data: "inprintreader" }
         		],
         		
         		
         		"order": [[0, 'asc']],
         		
         			
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
         
           },	select: true,
		        buttons: [
			        { extend: 'edit',   editor: editor }
		]
         	} );
                             
         var table = $('#uitgeverplatformlijst').DataTable();
           
         //oTable = $('#tijdschriftenlijst').DataTable();
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
                  
                     <?php if ($logged == 'in') {  ?>                        
                     <h3>Uitgevers / platforms lijst</h3>
                     <p>Op deze bladzijde kunnen de gegevens in de lijst met uitgevers en platforms worden bewerkt.</p>
                      </td>
                        </tr>
                     <tr>
                           <td>
                              <div id="search">
                                 <div class="search-box">
                                    <input name="q" id= "zoekveld" value="" type="search" autocomplete="off"  placeholder="Zoek..."/><button id="magnifying_glass"><img src="../images/magnifying_glass.png" width="30" height="30" border="0"></button>
                                 </div>
                              </div>
                     </td>
                        </tr>
                     </table>
                     <div class="table" id="advsearch">
                        <table id="uitgeverplatformlijst" class="display responsive wrap" cellspacing="0" width="100%">
                           <thead>
                              <tr>
                                 <th>Uitgever / platform</th>
                                 <th>Type</th>
                                 <th>Digitale overname</th>
                                 <th>Gedrukte overname</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td colspan="4" class="dataTables_empty">Downloaden van gegevens over de uitgevers en platforms van de server.</td>
                              </tr>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th>Uitgever / platform</th>
                                 <th>Type</th>
                                 <th>Digitale overname</th>
                                 <th>Gedrukte overname</th>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                     <?php }
                        else {?>          
                     <p>
                        <span class="error">Helaas, u bent niet bevoegd om deze pagina te bekijken.</span> Terug naar de <a href="../login.php">login pagina</a>.
                     </p>
                     <?php } ?>
               </td>
            </tr>
            <tr>
            <td>
            <div id="td_navigatie">
            <div id="MainMenu" class="btn-group">
            <a class="btn btn-default" href="../lijst.php" role="button">Licentielijst</a>
            <a class="btn btn-default" href="../ebooks.php" role="button">E-books-lijst</a>
            <a class="btn btn-default" href="../uitgeversplatforms.php" role="button">Uitgevers / platforms</a>
            <?php if ($logged == 'in'){
                ?>
            <a class="btn btn-default" href="adminlijst.php" role="button">Bewerk Licentielijst</a>
            <a class="btn btn-default" href="adminebooks.php" role="button">Bewerk e-books-lijst</a>
            <a class="btn btn-default active" href="adminuitgeversplatforms.php" role="button">Bewerk Uitgevers / platforms</a>
            <a class="btn btn-default" href="../register.php" role="button">Registreer</a>
            <a class="btn btn-default" href="../include/logout.php" role="button">Log off</a>
            
            <?php   }
               else
               echo "<a class=\"btn btn-default\" href=\"../login.php\" role=\"button\">Bewerken</a>";   
               ?>       
            </div></div>
            </td> 
            </tr>
            </div>
         </tbody>
      </table>
   </body>
</html>
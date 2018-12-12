<?php
//Inlogsscript overgenomen van:
//https://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL

 include_once '../include/db_connect.php';
 include_once '../include/functions.php';

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
      <title>Admin e-bookslijst</title>
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
      <link rel="stylesheet" href="../css/new.css" type="text/css"/>
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="/licentielijstmap/DataTables/Bootstrap-3.3.7/js/bootstrap.min.js"></script> 
      <script type="text/javascript" src="/licentielijstmap/DataTables/Datatables-1.10.18/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/DataTables/Datatables-1.10.18/js/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/DataTables/Select-1.2.6/js/dataTables.select.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/Editor/js/dataTables.editor.min.js"></script>
      <script type="text/javascript" src="/licentielijstmap/Editor/js/editor.bootstrap.min.js"></script>  
      <script type="text/javascript" class="init">
         var editor; 
         
         function format ( d ) {
         	return 'ISBN: '+d.ebookslijst.ISBN ;
         }
         
         $(document).ready(function() {
         	editor = new $.fn.dataTable.Editor( {
         		ajax: "../scripts/bewerkebooksjoin.php",
         		table: "#ebookslijst",
         		fields: [{
         			type : "ckeditor",
                 type:  "textarea", 
         				label: "Titel:",
         				name: "ebookslijst.publication_title"
         			}, {
               type : "ckeditor",
                 type:  "textarea",
         				label: "Auteur(s) / Organisatie:",
         				name: "ebookslijst.authorsorganisation"
         			},
                {
         				label: "ISBN:",
         				name: "ebookslijst.ISBN"
         			}, 
               {
         				label: "Jaar:",
         				name: "ebookslijst.year"
         			},
                {
                        label: "Uitgever / Platform:",
         				name: "ebookslijst.platformid",
                        type: "select",
                        placeholder: "Kies een Uitgever / platform"
         			},
               {
                        label: "Zoekveld:",
         				name: "ebookslijst.zoekveld",
                        type: "readonly"
         			},
              {
         				label: "URL:",
         				name: "ebookslijst.URL",
                  type: "readonly"
         			}
               
         ]
         } );
         
         
         var dt = $('#ebookslijst').DataTable( {
         dom: "Blrtip",
         ajax: {
         url: "../scripts/bewerkebooksjoin.php",
         type: "POST"
         },
         responsive: true,
         serverSide: true,
         "columnDefs": [ 
         {
         
         "render": function ( data, type, row ) {
         return '<a href="' + row['ebookslijst']['URL'] + '" target="_new">' + data;
         },
         "targets": 1
         },
             { "render": function (data, type, row) {
               if ( data === 'Ja' ){ return '<img src="../images/yes.png">';
               } else if ( data === 'Nee' )
               { return '<img src="../images/no.png">';
               }
               
          },
          "targets": [8,9,10]
           },
                 {"visible": false,
         "targets": [ 3,5,7 ]}
         ],
            columns: [{                                          
               "class": "details-control", 
               "orderable": false,
               "data": null, 
               "defaultContent": ""
                },
         { data: "ebookslijst.publication_title" },
         { data: "ebookslijst.authorsorganisation" },
         { data: "ebookslijst.ISBN" },
         { data: "ebookslijst.year" }, 
         { data: "ebookslijst.URL" },
         { data: "uitgeverplatform.uitgeverplatform" },
         { data: "ebookslijst.zoekveld" },
         { data: "uitgeverplatform.linkingincanvas" },
         { data: "uitgeverplatform.pdfincanvas" },
         { data: "uitgeverplatform.inprintreader" }
         ],
         
         
         
         
         "order": [1, 'asc'],
         
         
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
         
           },
            select: true,
		        buttons: [
			        { extend: 'edit',   editor: editor }
		]

         } );
         
         
         var table = $('#ebookslijst').DataTable();
           
         //oTable = $('#tijdschriftenlijst').DataTable();
         $('#magnifying_glass').on( 'click', function () {
         
         table
         .columns( 7 )
         .search( document.getElementById("zoekveld").value )
         .draw();
         } );
         
         	var detailRows = [];
         
         	$('#ebookslijst tbody').on( 'click', 'tr td:first-child', function () {
         		var tr = $(this).closest('tr');
         		var row = dt.row( tr );
         		var idx = $.inArray( tr.attr('id'), detailRows );
         
         		if ( row.child.isShown() ) {
         			tr.removeClass( 'details' );
         			row.child.hide();
         
         			detailRows.splice( idx, 1 );
         		}
         		else {
         			tr.addClass( 'details' );
         			row.child( format( row.data() ) ).show();                                           
         
         			if ( idx === -1 ) {
         				detailRows.push( tr.attr('id') );
         			}
         		}
         	} );
         
         	dt.on( 'draw', function () {
         		$.each( detailRows, function ( i, id ) {
         			$('#'+id+' td:first-child').trigger( 'click' );
         		} );
         	} );
         
         } );
         
         
         
         
         
      </script>       
  
   </head>
   <body>
      <div id="advsearch">
      <table id="wrapper" border="0" cellspacing="0">
         <tbody>
            <tr>
               <td id="tekst" >
                     <?php if ($logged == 'in') {
                        ?>                        
                     <h3>UvA e-books-lijst</h3>
                     <p>Op deze bladzijde kunnen de gegevens in de e-books lijst worden bewerkt.</p>
                        </td>
                           </tr>
                             <tr>
                              <td>
                                 <div id="search">
                                    <div class="search-box">
                                       <input name="q" id= "zoekveld" value="" type="search" autocomplete="off"  placeholder="Zoek..."/><button id="magnifying_glass"><img src="images/magnifying_glass.png" width="30" height="30" border="0"></button>
                                    </div>
                                 </div>
               </td>
            </tr>
            <tr><td>                   
            <div class="table">
            <table id="ebookslijst" class="display responsive wrap" cellspacing="0" width="100%">
            <thead>
            <tr>
            <th></th> 
            <th>Titel</th>
            <th>Auteur(s) / organisatie</th> 
            <th>ISBN</th>
            <th>Jaar</th>
            <th>URL</th>
            <th>Uitgever / platform</th>
            <th>Zoekveld</th>
            <th>Linken in BlackBoard en online reader</th>
            <th>pdf in BlackBoard en online reader</th>
            <th>In geprinte reader</th>
            </tr>
            </thead>
            <tbody><tr><td colspan="9" class="dataTables_empty">Downloaden van gegevens over de e-books van de server.</td></tr></tbody>
            <tfoot>
            <tr>
            <th></th> 
            <th>Titel</th>
            <th>Auteur(s) / organisatie</th> 
            <th>ISBN</th>
            <th>Jaar</th>
            <th>URL</th>
            <th>Uitgever / platform</th>
            <th>Zoekveld</th>
            <th>Linken in BlackBoard en online reader</th>
            <th>pdf in BlackBoard en online reader</th>
            <th>In geprinte reader</th>
            </tr>
            </tfoot>
            </table>
            </div>
            <?php } 
else {
    ?>          
            <p>
            <span class="error">Helaas, u bent niet bevoegd om deze pagina te bekijken.</span> Terug naar de <a href="../login.php">login pagina</a>.
            </p>
            <?php } 
?>
            </td>
            </tr><tr>
            <td id="td_navigatie">
            <div id="MainMenu"  class="btn-group">
            <a class="btn btn-default" href="../lijst.php" role="button">Licentielijst</a>
            <a class="btn btn-default" href="../ebooks.php" role="button">E-books-lijst</a>
            <a class="btn btn-default" href="../uitgeversplatforms.php" role="button">Uitgevers / platforms</a>
            <?php if ($logged == 'in') {
    ?>
            <a class="btn btn-default" href="adminlijst.php" role="button">Bewerk Licentielijst</a>
            <a class="btn btn-default active" href="adminebooks.php" role="button">Bewerk e-books-lijst</a>
            <a class="btn btn-default" href="adminuitgeversplatforms.php" role="button">Bewerk Uitgevers / platforms</a>
            <a class="btn btn-default" href="../register.php" role="button">Registreer</a>
            <a class="btn btn-default" href="../../include/logout.php" role="button">Log off</a>
            <?php } 
else
     echo "<a class=\"btn btn-default\" href=\"../login.php\" role=\"button\">Bewerken</a>";
 ?>       
            </UL></div></div>
            </td></tr>
         </tbody>
      </table>
   </body>
</html>

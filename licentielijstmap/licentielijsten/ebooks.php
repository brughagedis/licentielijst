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
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.6.0">
  <meta charset="utf-8">
  <title>E-books lijst</title>
  <meta name="viewport" content=
  "width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
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
         
         function format ( d ) {
                return 'ISBN: '+d.ebookslijst.isbn ;
         }
         
         $(document).ready(function() {
                editor = new $.fn.dataTable.Editor( {
                        ajax: "scripts/ebooksjoin.php",
                        table: "#ebookslijst"        
                } );
                  
         var dt = $('#ebookslijst').DataTable( {
             //"sDom": '<"top"i>rt<"bottom"lp><"clear">',
         dom: "lrtip",
                                ajax: {
                                url: "scripts/ebooksjoin.php"
                 ,
                                type: "POST"
                        },
                        responsive: true,
                        serverSide: true,
                        "columnDefs": [ 
                {
                "render": function ( data, type, row ) {
                                                return '<a href="' + row['ebookslijst']['url'] + '" target="_new">' + data;
                                        },
                                        "targets": 1}
          ,
             { "render": function (data, type, row) {
               if ( data === 'Ja' ){ return '<img src="images/yes.png">';
               } else if ( data === 'Nee' )
               { return '<img src="images/no.png">';
               }
               
          },
          "targets": [7,8,9]
           },
                 {"visible": false,
         "targets": [ 4,6 ]}
         
               ],
            columns: [
            {                                          
               "class": "details-control", 
               "orderable": false,
               "data": null, 
               "defaultContent": ""
                },
                { data: "ebookslijst.publication_title" },
                { data: "ebookslijst.authorsorganisation" },
                { data: "ebookslijst.year" },
                { data: "ebookslijst.url" },
                { data: "uitgeverplatform.uitgeverplatform" },
                { data: "ebookslijst.zoekveld" },
                { data: "uitgeverplatform.linkingincanvas" },
                { data: "uitgeverplatform.pdfincanvas" },
                { data: "uitgeverplatform.inprintreader"}
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
         
           }
         
                } );
           
         var table = $('#ebookslijst').DataTable();
           
         //oTable = $('#tijdschriftenlijst').DataTable();
         $('#magnifying_glass').on( 'click', function () {
         
         table
         .columns( 6 )
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
          <td id="tekst">
            <h3>E-books-lijst</h3>
            <p>Deze lijst vermeldt alle e-books waarop de Bibliotheek een licentie heeft
            en laat zien of hieruit wel <img src="images/yes.png" alt="yes"> of niet <img src=
            "images/no.png" alt="no"> artikelen of hoofdstukken binnen readers of Canvas mogen
            worden opgenomen.<br>
            Zorg ervoor dat gedownload materiaal aan het eind van het studiejaar wordt
            verwijderd.</p>
              </td>
                </tr>
                <tr>
                  <td>
                    <div id="search">
                      <div class="search-box">
                        <input name="q" id="zoekveld" value="" type="search" autocomplete="off"
                        placeholder="Zoek..."><button id="magnifying_glass"><img src=
                        "images/magnifying_glass.png" width="30" height="30" border=
                        "0"></button>
                      </div>
                   </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="table">
              <table id="ebookslijst" class="display responsive wrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>Titel</th>
                    <th>Auteur(s) / organisatie</th>
                    <th>Jaar</th>
                    <th>URL</th>
                    <th>Uitgever/platform</th>
                    <th>Zoekveld</th>
                    <th>Linken in Canvas en online reader</th>
                    <th>PDF op Canvas of in online reader</th>
                    <th>Opname in gedrukte reader</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="9" class="dataTables_empty">Downloaden van gegevens over de
                    e-books van de server.</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Titel</th>
                    <th>Auteur(s) / organisatie</th>
                    <th>Jaar</th>
                    <th>URL</th>
                    <th>Uitgever/platform</th>
                    <th>Zoekveld</th>
                    <th>Linken in Canvas en online reader</th>
                    <th>PDF op Canvas of in online reader</th>
                    <th>Opname in gedrukte reader</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </td>
        </tr>
        <tr>
          <td id="td_navigatie">
            <div id="MainMenu" class="btn-group">
              <a class="btn btn-default" href="lijst.php" role="button">Licentielijst</a>
              <a class="btn btn-default active" href="ebooks.php" role="button">E-books-lijst</a>
              <a class="btn btn-default" href="uitgeversplatforms.php" role="button">Uitgevers / platforms</a>
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
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>

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
      <title>Licences List</title>
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
  
      <script type="text/javascript" class="init">
         var editor; 
         
         function format ( d ) {
         	return 'ISSN: '+d.tijdschriftenlijst.issn ;
         }
             
         $(document).ready(function() {
         	editor = new $.fn.dataTable.Editor( {
         		ajax: "scripts/journalsjoin.php",
         		table: "#journals" 	
         	} );
         
         var dt =	$('#journals').DataTable( {
         		dom: "lrtip",
         			ajax: {
         			url: "scripts/journalsjoin.php",
         			type: "POST"
         		},
         		responsive: true,
         		serverSide: true,
         		"columnDefs": [ 
         	{
         	"render": function ( data, type, row ) {
         					return '<a href="' + row['tijdschriftenlijst']['url'] + '" target="_new">' + data;
         				},
         				"targets": 1}
          ,
             { "render": function (data, type, row) {
               if ( data === 'Ja' ){ return '<img src="images/yes.png">';
               } else if ( data === 'Nee' )
               { return '<img src="images/no.png">';
               }
               
          },
          "targets": [6,7]
           },
                 {"visible": false,
         "targets": [ 3,5 ]},
         
             {"sortable": false,
         "targets": [ 2 ]} ,
                    {
        targets: [6,7],
        className: 'dt-center'
    }  
         
               ],
           
               
            columns: [
             {
               "class": "details-control", 
               "orderable": false,
               "data": null, 
               "defaultContent": ""
                },
                 { data: "tijdschriftenlijst.publication_title" },
                 { data: "tijdschriftenlijst.beschikbaarheid" },
                 { data: "tijdschriftenlijst.url" },
                 { data: "uitgeverplatform.uitgeverplatform" },
                 { data: "tijdschriftenlijst.zoekveld" },
                 { data: "uitgeverplatform.pdfincanvas" },
                 { data: "uitgeverplatform.inprintreader"}
         		],
         
         		"order": [1, 'asc'],
         
         
         "language": {
         "info":           "Showing _START_ to _END_ of in total _TOTAL_ titles",
         "lengthMenu":     "Show _MENU_ titles",
         "search": "Search:",
         "paginate": {
         "first":      "First",
         "last":       "Last",
         "next":       "Next",
         "previous":   "Previous"
         }  

         }
         } );
         
         var table = $('#journals').DataTable();
         
         $('#magnifying_glass').on( 'click', function () {
         
         table
         .columns( 6 )
         .search( document.getElementById("zoekveld").value )
         .draw();
         } );
         
         var detailRows = [];
         
         $('#journals tbody').on( 'click', 'tr td:first-child', function () {
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
               <td id="tekst" >
                  <h3>License List</h3>
                     <p>
                     This list shows all e-journals that are accessible via the Library of the UvA. The symbols <img src = "images/yes.png" alt = "yes"> (yes) or <img src = "images/no.png" alt = "no"> (not) indicate whether per journal issue more than 50 pages&apos;s and / or more than 25% digital may be included in <i> Canvas </i>, an e-reader or a printed reader. <br> You may only offer this material during the module. </p>

                     <p>Scroll to the bottom of the page to navigate to the lists of e-books and publishers & platforms. </p>
                     <div class="srch_field">
                        <table cellspacing="0" cellpadding="2" border="0">
                           <tr>
                              <td>
                                 <div id="search">
                                    <div class="search-box">
                                       <input name="q" id= "zoekveld" value="" type="search" autocomplete="off"  placeholder="Search..."/><button id="magnifying_glass"><img src="images/magnifying_glass.png" width="30" height="30" border="0"></button>
                                    </div>
                                 </div>
                     </div>
                     </td></tr>
                     </table>            
               </td>
            </tr>
            <tr><td>      
            <div class="table">
            <table id="journals" class="display responsive wrap" cellspacing="0" width="95%">
            <thead>
            <tr>
            <th></th>
            <th>Title</th>
            <th>Availability</th>
            <th>URL</th>
            <th>Publisher or Platform</th>
            <th>Search field</th>
            <th>Digital inclusion</th>
            <th>Printed inclusion</th> 
            </tr>
            </thead>
            <tbody><tr><td colspan="8" class="dataTables_empty">Downloading journal data from server.</td></tr></tbody>
            <tfoot>
            <tr>
            <th></th>
            <th>Title</th>
            <th>Availability</th>
            <th>URL</th>
            <th>Publisher or Platform</th>
            <th>Search field</th>
            <th>Digital inclusion</th>
            <th>Printed inclusion</th>
            </tr>
            </tfoot>
            </table>
            </div>
            </td>
            </tr>
            <tr>
            <td id="td_navigatie">
            <div id="MainMenu" class="btn-group">
            <a class="btn btn-default active" href="list.php" role="button">License List</a>
            <a class="btn btn-default" href="ebooks_eng.php" role="button">e-books List</a>
            <a class="btn btn-default" href="publishersplatforms.php" role="button">Publishers & Platforms</a>
            <?php if ( $logged == 'in' ) {
               ?>
            <a class="btn btn-default" href="admin/adminlijst.php" role="button">Bewerk Licentielijst</a>
            <a class="btn btn-default" href="admin/adminebooks.php" role="button">Bewerk e-books-lijst</a>
            <a class="btn btn-default" href="admin/adminuitgeversplatforms.php" role="button">Bewerk Uitgevers / platforms</a>
            <a class="btn btn-default" href="register.php" role="button">Registreer</a>
            <a class="btn btn-default" href="include/logout.php" role="button">Log off</a>
            <?php } 
               else
               				 echo "<a class=\"btn btn-default\" href=\"login.php\" role=\"button\">Edit</a>";
                ?></div></div>
            </td>
            </tr>
         </tbody>
      </table>
      </div>
   </body>
</html>


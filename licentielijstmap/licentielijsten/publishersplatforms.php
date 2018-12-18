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
      <title>Publishers and Platforms List</title>
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
          "targets": [1,2]
         } ,
                    {
        targets: [1,2],
        className: 'dt-center'
    }
         
         
         
         ],
            columns: [
         			{ data: "uitgeverplatform" },
               { data: "pdfincanvas" },
               { data: "inprintreader"}
         		],
         		
         		
         		"order": [0, 'asc'],
         		
         			
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
                     <h3>Publishers and Platforms</h3>
                      <p>This list shows all publishers and platforms] that are accessible via the Library of the UvA. The symbols <img src = "images/yes.png" alt = "yes"> (yes) or <img src = "images/no.png" alt = "no"> (not) indicate whether per publisher / platform more than 50 pages&apos;s and / or more than 25% digital may be included in <i> Canvas </i>, an e-reader or a printed reader. <br> You may only offer this material during the module. </p>

                     <p>Scroll to the bottom of the page to navigate to the lists of e-books and e-journals. </p>
                    </td>
                        </tr>
                         <tr>
                           <td>
                              <div id="search">
                                 <div class="search-box">
                                    <input name="q" id= "zoekveld" value="" type="search" autocomplete="off"  placeholder="Search..."/><button id="magnifying_glass"><img src="images/magnifying_glass.png" width="30" height="30" border="0"></button>
                                 </div>
                              </div>
                            <td>
                         </tr>
      <tr><td>
      <div class="table">
      <table id="uitgeverplatformlijst" class="display responsive wrap" cellspacing="0" width="100%">
      <thead>
      <tr>
      <th>Publisher or platform</th>
      <th>Digital inclusion</th>
      <th>Print inclusion</th>
      </tr>
      </thead>
      <tbody><tr><td colspan="3" class="dataTables_empty">Downloading data of publishers / platforms from server.</td></tr></tbody>
      <tfoot>
      <tr>
      <th>Publisher or platform</th>
      <th>Digital inclusion</th>
      <th>Print inclusion</th>
      </tr>
      </tfoot>
      </table>
      </div>
      </td></tr>
      <tr>
      <td id="td_navigatie">
      <div id="MainMenu" class="btn-group">
      <a class="btn btn-default" href="list.php" role="button">License List</a>
      <a class="btn btn-default" href="ebooks_eng.php" role="button">e-books List</a>
      <a class="btn btn-default active" href="publishersplatforms.php" role="button">Publishers & Platforms</a>
      <?php if ($logged == 'in'){
         // echo "<li><a href=\"admin/adminlijst.php\" class=\"back\">Bewerk SURFlijst</a></li> ";
          ?>
      <a class="btn btn-default" href="admin/adminlijst.php" role="button">Bewerk Licentielijst</a>
      <a class="btn btn-default" href="admin/adminebooks.php" role="button">Bewerk e-books-lijst</a>
      <a class="btn btn-default" href="admin/adminuitgeversplatforms.php" role="button">Bewerk Uitgevers / platforms</a>
      <a class="btn btn-default" href="register.php" role="button">Registreer</a>
      <a class="btn btn-default" href="include/logout.php" role="button">Log off</a>
      <?php   }
         else
         echo "<a class=\"btn btn-default\" href=\"login.php\" role=\"button\">Edit</a>";   
         ?></div></div>
      </td></tr>
      </div></div>
      </tbody></table>
   </body>
</html>
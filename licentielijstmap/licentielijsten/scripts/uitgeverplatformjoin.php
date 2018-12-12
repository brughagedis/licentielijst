<?php

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( $_SERVER['DOCUMENT_ROOT']."/licentielijstmap/Editor/lib/DataTables.php" );
//include( "php/DataTables.php" );
// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
    DataTables\Editor\Join,
    DataTables\Editor\Upload,
	DataTables\Editor\Validate;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'uitgeverplatform' )
->field(
Field::inst( 'uitgeverplatform' ),
Field::inst( 'linkingincanvas' ),
Field::inst( 'pdfincanvas' ),
Field::inst( 'inprintreader' )
)
    
->process( $_POST )
	->json();

?>
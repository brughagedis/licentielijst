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
Field::inst( 'uitgeverplatform' )->validator( 'Validate::notEmpty' ),
Field::inst( 'type' )->validator( 'Validate::notEmpty' ),
Field::inst( 'linkingincanvas' )->validator( 'Validate::notEmpty' ),
Field::inst( 'pdfincanvas' )->validator( 'Validate::notEmpty' ),
Field::inst( 'inprintreader' )->validator( 'Validate::notEmpty' )
)
    
->process( $_POST )
	->json();

?>
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
Editor::inst( $db, 'tijdschriftenlijst' )
	->field(
        	Field::inst( 'tijdschriftenlijst.publication_title' ),
		Field::inst( 'tijdschriftenlijst.issn' ),
		Field::inst( 'tijdschriftenlijst.beschikbaarheid' ),
		Field::inst( 'tijdschriftenlijst.url' ),	
        	Field::inst( 'tijdschriftenlijst.zoekveld' ),
		Field::inst( 'uitgeverplatform.uitgeverplatform' ),
		Field::inst( 'uitgeverplatform.pdfincanvas' ),
		Field::inst( 'uitgeverplatform.inprintreader' )
    )
    
->leftJoin( 'uitgeverplatform', 'uitgeverplatform.id', '=', 'tijdschriftenlijst.platformid' )    
->process( $_POST )
	->json();


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
Editor::inst( $db, 'ebookslijst' )
	->field(
		Field::inst( 'ebookslijst.isbn' ),
		Field::inst( 'ebookslijst.publication_title' ),
		Field::inst( 'ebookslijst.authorsorganisation' ),	
        Field::inst( 'ebookslijst.url' ),
        Field::inst( 'uitgeverplatform.uitgeverplatform' ) ,   	
        Field::inst( 'ebookslijst.year' ),
        Field::inst( 'ebookslijst.zoekveld' ),	 
		Field::inst( 'uitgeverplatform.linkingincanvas' ),
		Field::inst( 'uitgeverplatform.pdfincanvas' ),
		Field::inst( 'uitgeverplatform.inprintreader' )
    )


->leftJoin( 'uitgeverplatform', 'uitgeverplatform.id', '=', 'ebookslijst.platformid' )    
->process( $_POST )
	->json();



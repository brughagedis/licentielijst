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
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'ebookslijst' )
	->field(
		Field::inst( 'ebookslijst.isbn' ),
		Field::inst( 'ebookslijst.publication_title' ),
		Field::inst( 'ebookslijst.authorsorganisation' ),	
        Field::inst( 'ebookslijst.url' ),
        Field::inst( 'ebookslijst.platformid' )
        ->options( Options::inst()
                 ->table( 'uitgeverplatform' )
                 ->value( 'id' )
                 ->label( 'uitgeverplatform' )
                 )
          ->validator( Validate::dbValues() ),          
        Field::inst( 'uitgeverplatform.uitgeverplatform' ),
        Field::inst( 'ebookslijst.year' ),	
        Field::inst( 'ebookslijst.zoekveld' ),	
		Field::inst( 'uitgeverplatform.pdfincanvas' ),
		Field::inst( 'uitgeverplatform.inprintreader' )
    )
    
->leftJoin( 'uitgeverplatform', 'uitgeverplatform.id', '=', 'ebookslijst.platformid' )    
->process( $_POST )
	->json();

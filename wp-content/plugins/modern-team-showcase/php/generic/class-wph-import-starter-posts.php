<?php

class WPH_Import_Starter_Posts{
	
	public $file;
	
	function __construct( $file ){
		define( 'WPH_Import_Starter_Posts', true );
		$this->file = $file;
	}
	
	function trigger_import(  ){
		if( file_exists( $this->file ) )
			echo "<h1>File does exists</h1>";
		if( ! file_exists( $this->file ) )
			echo "<h1>File does not exists</h1>";
	}
	
}

?>
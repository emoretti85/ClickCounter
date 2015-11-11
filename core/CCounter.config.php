<?php
/**
 * Configuration class for CCounter
 *
 *
 * PHP version 5
 *
 * @author    Ettore Moretti <ettoremoretti27@gmail.com>
 * @version 1.0.0
 *
 */
class CCounterConfig {
	public $Local_base_path, $Core_path, $_404, $Href_pointer, $increaseMode, $increaseFile, $DB;
	function __construct() {
		// Change "core" to the path where you have placed this class
		$this->Local_base_path = str_replace ( "core", "", dirname ( __FILE__ ) );
		// Change "core" to the path where you have placed this class
		$this->Local_base_url = "http://" . $_SERVER ['SERVER_NAME'] . str_replace ( "core", "", dirname ( $_SERVER ["REQUEST_URI"] . '?' ) );
		// Change "core" to the path where you have placed this class
		$this->Core_path = "http://" . $_SERVER ['SERVER_NAME'] . dirname ( $_SERVER ["REQUEST_URI"] . '?' ) . '/core/';
		// Change with the name and path of your personal 404 page
		$this->_404 = "./404.php";
		// You should not change the path of CCounter.hrefPointer.php, unless you know what you are doing :)
		$this->Href_pointer = "CCounter.hrefPointer.php";
		
		// Increase mode (0 => FILE; 1=> DB)
		$this->increaseMode = 0;
		// Necessary if you are using the increase mode 0
		$this->increaseFile = "LinkCounter.txt";
		// Necessary if you are using the increase mode 1
		$this->DB = new PDO ( "mysql:host=localhost;dbname=test", "root", "" );
	}
}

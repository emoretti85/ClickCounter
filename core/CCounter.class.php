<?php
/**
 * Class for CCounter
 *
 * ClickCounter is a PHP class that allows you to control the number of visitors who clicked on certain links. 
 * Useful for statistics on navigation and \ or downloading files
 *
 * PHP version 5
 *
 * @author     Ettore Moretti <ettoremoretti27@gmail.com>
 * @version 1.0.0
 *
 */
require_once ("CCounter.config.php");
class CCounter {
	public $CONF;
	function __construct() {
		$this->CONF = new CCounterConfig ();
	}
	function increaseLinkCounter($lnk) {
		switch ($this->CONF->increaseMode) {
			case 0 :
				try {
					$linksFile = file ( $this->CONF->increaseFile );
					$content = file_get_contents ( $this->CONF->increaseFile );
					$Buffer = "";
					$found = false;
					$Links = explode ( "\n", $content );
					foreach ( $Links as $l ) {
						$lContent = explode ( "~", $l );
						if ($lContent [0] == trim ( $lnk )) {
							$lContent [1] ++;
							$found = true;
						}
						if (trim ( $lContent [0] ) != "")
							$Buffer .= $lContent [0] . "~" . $lContent [1] . "\n";
					}
					
					if (! $found)
						$Buffer .= $lnk . "~0\n";
					
					file_put_contents ( $this->CONF->increaseFile, $Buffer );
				} catch ( Exception $e ) {
					print_r ( $e->getMessage () );
				}
				
				break;
			
			case 1 :
				$stm = $this->CONF->DB->prepare ( "SELECT Link,Count from clickcounter WHERE Link=:link" );
				$stm->bindParam ( ":link", $lnk );
				$stm->execute ();
				$res = $stm->fetchAll ( PDO::FETCH_ASSOC );
				
				if (isset ( $res [0] )) {
					$updStm = $this->CONF->DB->prepare ( "UPDATE clickcounter SET Count=:cnt WHERE Link=:link" );
					$cnt = $res [0] ['Count'] + 1;
					$updStm->bindParam ( ":cnt", $cnt, PDO::PARAM_INT );
					$updStm->bindParam ( ":link", $res [0] ['Link'], PDO::PARAM_STR );
					$updStm->execute ();
				} else {
					$insStm = $this->CONF->DB->prepare ( "INSERT INTO clickcounter (Link,Count) VALUES(:lnk,0) " );
					$insStm->bindParam ( ":lnk", $lnk, PDO::PARAM_STR );
					$insStm->execute ();
				}
				break;
		}
	}
	static public function getHref($lnk = '') {
		$CONF = new CCounterConfig ();
		$hrefLink = "";
		// Check if link exists in this server
		if (! file_exists ( $CONF->Local_base_path . $lnk ) || $lnk == '') {
			$hrefLink = $CONF->_404;
		} else {
			$hrefLink = $CONF->Core_path . $CONF->Href_pointer . "?lnk=" . $lnk;
		}
		return $hrefLink;
	}
}

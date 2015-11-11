<?php
require_once ("CCounter.class.php");
$Cc = new CCounter ();
$Cc->increaseLinkCounter ( $_GET ['lnk'] );
header ( "Location: " . $Cc->CONF->Local_base_url . $_GET ['lnk'] . "" );

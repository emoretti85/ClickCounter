<?php
require_once 'core/CCounter.class.php';
$CC=new CCounter();
?>
<html>
<head>
<title>Click Counter Example</title>
</head>

<body>

<h1>Click Counter PHP - Example use</h1>
<p>Click a link to increase the relative counter.</p>

<a href="<?php print_r($CC::getHref('link1.html')); ?>" target="_blank">Link1</a><br/>
<a href="<?php print_r($CC::getHref('link2.html')); ?>" target="_blank">Link2</a><br/>
<a href="<?php print_r($CC::getHref('link3.html')); ?>" target="_blank">Link3</a><br/>
<a href="<?php print_r($CC::getHref('link4.html')); ?>" target="_blank">Link4</a><br/>
<a href="<?php print_r($CC::getHref('link5.html')); ?>" target="_blank">Link5</a> (404 page, link broken example)
</body>
</html>

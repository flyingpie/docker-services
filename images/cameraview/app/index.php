<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Camera</title>
	</head>
	<body>
		<ul>
<?php

$files = glob('video/*.mp4', GLOB_BRACE);
usort($files, 'filemtime_compare');

function filemtime_compare($a, $b)
{
	#return filemtime($a) - filemtime($b);
	return filemtime($b) - filemtime($a);
}

$i = 0;
$show = 100;

foreach($files as $file)
{
	if($i == $show) break; else ++$i;
	#echo $file . ' - ' . date('D, d M y H:i:s', filemtime($file)) . '<br />' . "\n";

	echo '<li><a href="' . $file . '">' . $file . '</a></li>';
}
?>
		</ul>
	</body>
</html>

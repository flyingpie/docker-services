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
<?php

$files1 = glob('video/alarm_*.mp4', GLOB_BRACE);
$files2 = glob('video/MDalarm_*.mp4', GLOB_BRACE);
usort($files1, 'filemtime_compare');
usort($files2, 'filemtime_compare');

function filemtime_compare($a, $b)
{
	#return filemtime($a) - filemtime($b);
	return filemtime($b) - filemtime($a);
}

function pr($files)
{
	$i = 0;
	$show = 100;

	foreach($files as $file)
	{
		if($i == $show) break; else ++$i;
		#echo $file . ' - ' . date('D, d M y H:i:s', filemtime($file)) . '<br />' . "\n";

		echo '<li><a href="' . $file . '">' . $file . '</a></li>';
	}
}

?>

		<div style="float: left; width: 50%;">
			<h3>Auto</h3>
			<ul>
				<?php pr($files1); ?>
			</ul>
		</div>

		<div style="float:left;">
			<h3>Tuin</h3>
			<ul>
				<?php pr($files2); ?>
			</ul>
		</div>

	</body>
</html>

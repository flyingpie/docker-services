<?php

if (!isset($gCms)) exit;

$protocol_ok = true;
$myprotocol = "";
if (isset($params['protocol']))
{
	$protocol_ok = false;
	$protocols = array('http','ftp', 'https');
	foreach($protocols as $protocol)
	{
		if($protocol == $params['protocol'])
		{
			$protocol_ok = true;
			$myprotocol = $params['protocol'];
		}
	}
}

if (!isset($params['name']))
{
  echo '[' . $this->Lang('error_insufficientparams', 'name') . ']';
}
else if (strlen($params['name']) > 255)
{
  echo '[' . $this->Lang('error_nametoolong') . ']';
}
else if (!isset($params['link']))
{
  echo '[' . $this->Lang('error_insufficientparams', 'link') . ']';
} 
else if (!$protocol_ok)
{
	echo '[' . $this->Lang('error_protocol_nok', 'link') . ']';
}
else
{
  echo  $this->CreateLink($id, 'click', $returnid, '',
                               Array('name' => $params['name'], 'link' => urlencode($params['link']), 'protocol' => $myprotocol),
                               '', true, true, '');
}
?>


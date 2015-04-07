<?php
# CMS Made Simple Configuration File
# Documentation: /doc/CMSMS_config_reference.pdf
#
$config['dbms'] = 'mysql';
$config['db_hostname'] = $_ENV['MYSQL_HOST'];
$config['db_username'] = $_ENV['MYSQL_USER'];
$config['db_password'] = $_ENV['MYSQL_PASS'];
$config['db_name'] = $_ENV['MYSQL_DB'];
$config['db_prefix'] = 'cms_';
$config['db_port'] = 0;
$config['root_url'] = '';
if (isset($_ENV['ROOT_URL']) && !empty($_ENV['ROOT_URL']))
{
	$config['root_url'] = $_ENV['ROOT_URL'];
}
$config['timezone'] = 'Europe/Amsterdam';
$config['default_encoding'] = 'utf-8';
?>

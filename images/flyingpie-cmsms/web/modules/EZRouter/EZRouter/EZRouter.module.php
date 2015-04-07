<?php

class EZRouter extends CMSModule {

	function GetName() {
		return 'EZRouter';
	}

	function GetFriendlyName() {
		return 'EZRouter';
	}

	function GetVersion() {
		return '0.4';
	}

	function _GetHelp() {
		return $this->Lang('help');
	}

	function GetAuthor() {
		return 'GT';
	}

	function GetAuthorEmail() {
		return 'tcat@kani.hu';
	}

	function IsPluginModule() {
		return false;
	}

	function HasAdmin() {
		return false;
	}

	function GetDependencies() {
		return array();
	}

	function MinimumCMSVersion() {
		return "1.9.0";
	}

	function MaximumCMSVersion() {
		return "1.99";
	}

	function GetPageURLs() {
		/**
		 * @var cms_cache_handler $c
		 */
		if (class_exists('cms_cache_handler') && ($c = cms_cache_handler::get_instance()) && ($cache = $c->get('page_urls', 'ezrouter'))) {
			return $cache;
		} elseif (empty($c) && file_exists($tmpfile = 'tmp/EZRouter.cache.ser') && ($cache = file_get_contents($tmpfile)) && ($cache = @unserialize($cache))) {
			return $cache;
		} else {
			$db = &cmsms()->GetDb();
			$dbresult = &$db->Execute("SELECT content_id, content_alias, IF(LENGTH(page_url) > 0, page_url, hierarchy_path) as page_url, accesskey FROM ".cms_db_prefix()."content WHERE LENGTH(page_url) > 0 OR accesskey = 1");
			$list = array();
			while ($dbresult && $row = $dbresult->FetchRow()) {
				unset($elem);
				$elem = &$list;
				foreach(explode('/', $row['page_url']) as $part) {
					if (!isset($elem[$part])) $elem[$part] = array();
					$elem = &$elem[$part];
				}
				$elem['_'] = $row;
			}
			if (isset($c)) {
				$c->set('page_urls', $list, 'ezrouter');
			} else {
				file_put_contents($tmpfile, serialize($list));
			}
			return $list;
		}
	}
	function FindRoute($url, $contentinfo, &$params) {
			$u = explode('/', $url);
			$found = 0;
			foreach($u as $i => $part) {
				if (isset($contentinfo[$part])) {
					$contentinfo = &$contentinfo[$part];
					if (substr($part, 0, 1) == '-') {
						$params[substr($part,1)] = '';
						$params['arg'][substr($part,1)] = '';
					} else {
						$params['::'.$i] = $part;
					}
					$found = 1;
				} else {
					//search for variables in parts
					foreach ($contentinfo as $p => $ci) {
						if (substr($p, 0, 1) == '-') {
							$params[substr($p,1)] = $part;
							$params['arg'][substr($p,1)] = $part;
							$contentinfo = $contentinfo[$p];
							$found = 1;
							break;
						} else {
							$params['arg'.$i] = $part;
							$params['arg'][$i] = $part;
						}
					}
				}
			}
			if (!isset($contentinfo['_'])) {
				do {
					$f = 0;
					foreach ($contentinfo as $p => $ci) if (substr($p, 0, 1) == '-') {
						$contentinfo = &$contentinfo[$p];
						$params[substr($p,1)] = '';
						$params['arg'][substr($p,1)] = '';
						$f = 1;
						break;
					}
				} while ($f);
			}
			return $found ? $contentinfo : false;
	}
	function SetParameters() {
		$config = cmsms()->GetConfig();
		if (!isset($_GET[$config['query_var']])) return;
		$page = urldecode($_GET[$config['query_var']]);
		if ($page) {
			$contentinfo = $this->GetPageURLs();
			$route = array();
			$params = array('arg' => array());
			$contentinfo = $this->FindRoute($_GET['page'], $contentinfo, $params);
			if (!$contentinfo || !isset($contentinfo['_']) || $contentinfo['_']['accesskey']) return;
			foreach ($params as $i => $p) {
				if (substr($i, 0, 2) == '::') {
					//static part
					$route[] = $p;
				} else {
					$_GET[$i] = $p;
					$this->smarty->assign($i, $p);
					if ($p && is_scalar($p)) $route[] = '(?P<'.$i.'>[^\/]+)';
				}
			}
			$route = new CmsRoute($rr = '/'.implode('\/', $route).'$/', '', array('action' =>'default', 'module' => '', 'id' => '', 'mact' => '', 'returnid' => $contentinfo['_']['content_id']));
			cms_route_manager::register($route);
			//$this->RegisterRoute($rr = '/'.implode('\/', $route).'$/', array('action'=>'default', 'module' => '', 'id' => '', 'mact' => '', 'returnid' => $contentinfo['_']['content_id']));
			$this->mCachable = true;
		}
	}

	/**
	 * An event that this module is listening to has occurred, and should be handled.
	 * This method must be over-ridden if this module is capable of handling events.
	 * of any type.
	 *
	 * @param string The name of the originating module
	 * @param string The name of the event
	 * @param array  Array of parameters provided with the event.
	 * @return boolean
	 */
	function DoEvent( $originator, $eventname, &$params )	{
		if ($originator == 'Core' && $eventname == 'ContentEditPost')	{
			if (class_exists('cms_cache_handler') && ($c = cms_cache_handler::get_instance())) {
				$c->erase('page_urls', 'ezrouter');
			} else {
				$config = cmsms()->GetConfig();
				if (file_exists($tmpfile = $config['root_path'].'/tmp/EZRouter.cache.ser')) unlink($tmpfile);
			}
		}
	}
}

?>

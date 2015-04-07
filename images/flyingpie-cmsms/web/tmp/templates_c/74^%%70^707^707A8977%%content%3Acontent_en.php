<?php /* Smarty version 2.6.26, created on 2014-11-08 14:24:12
         compiled from content:content_en */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup_image', 'content:content_en', 2, false),)), $this); ?>
<?php $this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/74^%%70^707^707A8977%%content%3Acontent_en.inc'] = 'bc642b683fe91206fd83955d29ed4a7f'; ?><p>Scrumboard application for managing projects using the scrum method, optimized for touch devices such as Smart Boards and tablets. Features a synchronisation system to enable long-distance sharing of the scrumboard.</p>
<p><?php if ($this->caching && !$this->_cache_including): echo '{nocache:bc642b683fe91206fd83955d29ed4a7f#0}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('bc642b683fe91206fd83955d29ed4a7f','0');echo cms_user_tag_popup_image(array('src' => "scrumboard/sprint.png",'title' => 'Sprint view','desc' => 'View of a single sprint with its backlog items','style' => "float: left;"), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:bc642b683fe91206fd83955d29ed4a7f#0}'; endif;?>
</p>
<p><?php if ($this->caching && !$this->_cache_including): echo '{nocache:bc642b683fe91206fd83955d29ed4a7f#1}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('bc642b683fe91206fd83955d29ed4a7f','1');echo cms_user_tag_popup_image(array('src' => "scrumboard/details.png",'title' => 'Detail view','desc' => "Sprint backlog item detail view, can edit the sbi's properties",'style' => "float: left;"), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:bc642b683fe91206fd83955d29ed4a7f#1}'; endif;?>
</p>
<p><?php if ($this->caching && !$this->_cache_including): echo '{nocache:bc642b683fe91206fd83955d29ed4a7f#2}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('bc642b683fe91206fd83955d29ed4a7f','2');echo cms_user_tag_popup_image(array('src' => "scrumboard/history.png",'title' => 'Backlog item history','desc' => "History of a sprint backlog item, indicates how long each status took",'style' => "float: left;"), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:bc642b683fe91206fd83955d29ed4a7f#2}'; endif;?>
</p>
<p><?php if ($this->caching && !$this->_cache_including): echo '{nocache:bc642b683fe91206fd83955d29ed4a7f#3}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('bc642b683fe91206fd83955d29ed4a7f','3');echo cms_user_tag_popup_image(array('src' => "scrumboard/burndown.png",'title' => 'Burn down chart','desc' => "Burn down chart of the current sprint, on the right side of the sprint itself",'style' => "float: left;"), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:bc642b683fe91206fd83955d29ed4a7f#3}'; endif;?>
</p>
<p><?php if ($this->caching && !$this->_cache_including): echo '{nocache:bc642b683fe91206fd83955d29ed4a7f#4}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('bc642b683fe91206fd83955d29ed4a7f','4');echo cms_user_tag_popup_image(array('src' => "scrumboard/filter.png",'title' => 'Sprint backlog item filter','desc' => 'Filtering makes a specific selection of backlog items within the sprint','style' => "float: left;"), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:bc642b683fe91206fd83955d29ed4a7f#4}'; endif;?>
</p>
<p><?php if ($this->caching && !$this->_cache_including): echo '{nocache:bc642b683fe91206fd83955d29ed4a7f#5}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('bc642b683fe91206fd83955d29ed4a7f','5');echo cms_user_tag_popup_image(array('src' => "scrumboard/zoom.png",'title' => 'Sprint zoom','desc' => "Zooms out the scrumboard for an overview when the backlog items won't fit the screen",'style' => "float: left;"), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:bc642b683fe91206fd83955d29ed4a7f#5}'; endif;?>
</p>
<p><strong>Features</strong></p>
<ul>
<li>Fully optimized for touch devices such as Smart Boards and tablets</li>
<li>Per-sprint overview of backlog items with a burn down chart</li>
<li>Zooming, filtering and sorting for a quick overview of the board, even with large numbers of backlog items</li>
<li>Synchronisation over multiple clients for use with long-distance teams</li>
<li>Animating timeline to view the change of the scrumboard over time from a specified date</li>
</ul>
<p><strong>Collaborators</strong></p>
<p>Mark van den Bersselaar, Rob van Dijck, Thomas Middeldorp, Xander van Rijn, Maarten Stadhouders</p>
<p><strong>Technology</strong></p>
<p>C++, Qt</p>

		//Creates a new plugin class and a custom listbox
		tinymce.create('tinymce.plugins.CMSLinkerPlugin', {
		createControl: function(n, cm) {
			switch (n) {
				case 'cmslinker':
					var c = cm.createMenuButton('cmslinker', {
						title : 'CMSMS Linker',
						image : 'http://www.flyingpie.nl/modules/MicroTiny/images/cmsmslink.gif',
						icons : false
					});

					c.onRenderMenu.add(function(c, m) {
		
						m.add({title : '1 Home', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Home';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='home'}\">"+sel+"</a>");
						}});
		
						m.add({title : '2 Home', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Home';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='slenderhome'}\">"+sel+"</a>");
						}});
		
						m.add({title : '3.1 Templates and stylesheets', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Templates and stylesheets';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='templates-and-stylesheets'}\">"+sel+"</a>");
						}});
		
						m.add({title : '3.2 Pages and navigation', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Pages and navigation';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='pages-and-navigation'}\">"+sel+"</a>");
						}});
		
						m.add({title : '3.3 Content', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Content';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='content_types'}\">"+sel+"</a>");
						}});
		
						m.add({title : '3.4 Menu Manager', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Menu Manager';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='menu-manager'}\">"+sel+"</a>");
						}});
		
						m.add({title : '3.5 Extensions', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Extensions';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='extensions'}\">"+sel+"</a>");
						}});
		
						m.add({title : '3.6 Event Manager', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Event Manager';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='event-manager'}\">"+sel+"</a>");
						}});
		
						m.add({title : '3.7 Workflow', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Workflow';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='workflow'}\">"+sel+"</a>");
						}});
		
						m.add({title : '3.8 Where do I get help?', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Where do I get help?';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='where-do-i-get-help'}\">"+sel+"</a>");
						}});
		
						m.add({title : '4.1 CMSMS tags in the template &#133;', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='CMSMS tags in the templates';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='cmsms_tags'}\">"+sel+"</a>");
						}});
		
						m.add({title : '4.2 Left simple navigation + 1 &#133;', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Left simple navigation + 1 column';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='navleft'}\">"+sel+"</a>");
						}});
		
						m.add({title : '4.3 Top simple navigation + le &#133;', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Top simple navigation + left subnavigation + 1 column';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='top_left'}\">"+sel+"</a>");
						}});
		
						m.add({title : '4.4 CSSMenu top + 2 columns', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='CSSMenu top + 2 columns';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='cssmenu_horizontal'}\">"+sel+"</a>");
						}});
		
						m.add({title : '4.5 CSSMenu left + 1 column', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='CSSMenu left + 1 column';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='cssmenu_vertical'}\">"+sel+"</a>");
						}});
		
						m.add({title : '4.6 Minimal template', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Minimal template';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='minimal-template'}\">"+sel+"</a>");
						}});
							var mm = m.addMenu({title : '4.7 Higher End'});
		
						mm.add({title : '4.7 Higher End', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Higher End';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='higher-end'}\">"+sel+"</a>");
						}});
							mm.addSeparator();
		
						mm.add({title : '4.7.1 NCleanBlue', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='NCleanBlue';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='ncleanblue'}\">"+sel+"</a>");
						}});
		
						mm.add({title : '4.7.2 ShadowMenu Tab + 2 colum &#133;', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='ShadowMenu Tab + 2 columns';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='shadowmenu-tab-2-columns'}\">"+sel+"</a>");
						}});
		
						mm.add({title : '4.7.3 ShadowMenu left + 1 colu &#133;', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='ShadowMenu left + 1 column';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='shadowmenu-left-1-column'}\">"+sel+"</a>");
						}});
							var mmm = mm.addMenu({title : '5.1 Modules'});
		
						mmm.add({title : '5.1 Modules', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Modules';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='modules'}\">"+sel+"</a>");
						}});
							mmm.addSeparator();
		
						mmm.add({title : '5.1.1 News', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='News';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='news'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '5.1.2 Menu Manager', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Menu Manager';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='menu-manager-2'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '5.1.3 Theme Manager', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Theme Manager';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='theme-manager'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '5.1.4 MicroTiny', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='MicroTiny';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='microtiny'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '5.1.5 Search', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Search';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='search'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '5.1.6 Module Manager', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Module Manager';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='module-manager'}\">"+sel+"</a>");
						}});
							var mmm = mm.addMenu({title : '5.2 Tags'});
		
						mmm.add({title : '5.2 Tags', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Tags';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='tags'}\">"+sel+"</a>");
						}});
							mmm.addSeparator();
		
						mmm.add({title : '5.2.1 Tags in the core', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Tags in the core';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='tags-in-the-core'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '5.2.2 User Defined Tags', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='User Defined Tags';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='user-defined-tags'}\">"+sel+"</a>");
						}});
		
						m.add({title : '6 About', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='About';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='about'}\">"+sel+"</a>");
						}});
		
						m.add({title : '7 Madstats', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Madstats';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='steam-droid-2'}\">"+sel+"</a>");
						}});
		
						m.add({title : '8 Steam Droid', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Steam Droid';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='steam-droid'}\">"+sel+"</a>");
						}});
		
						m.add({title : '9 Beats by Bauk', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Beats by Bauk';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='beats-by-bauk-2'}\">"+sel+"</a>");
						}});
							var mm = m.addMenu({title : '10 Portfolio'});
		
						mm.add({title : '10 Portfolio', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Portfolio';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='portfolio'}\">"+sel+"</a>");
						}});
							mm.addSeparator();
		
						mm.add({title : '10.1 TxT-Doom', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='TxT-Doom';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='txt-doom'}\">"+sel+"</a>");
						}});
		
						mm.add({title : '10.2 Ludo', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Ludo';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='ludo'}\">"+sel+"</a>");
						}});
		
						mm.add({title : '10.3 The Winning Sudoku', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='The Winning Sudoku';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='the-winning-sudoku'}\">"+sel+"</a>");
						}});
		
						mm.add({title : '10.4 Server Config Generator', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Server Config Generator';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='server-config-generator'}\">"+sel+"</a>");
						}});
		
						mm.add({title : '10.5 Steam Droid', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Steam Droid';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='steamdroid'}\">"+sel+"</a>");
						}});
							var mmm = mm.addMenu({title : '10.6 Madstats'});
		
						mmm.add({title : '10.6 Madstats', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Madstats';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='madstats'}\">"+sel+"</a>");
						}});
							mmm.addSeparator();
		
						mmm.add({title : '10.6.1 Download', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Download';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='madstats-download'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '10.6.2 Documentation', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Documentation';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='madstats-documentation'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '10.6.3 Templates', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Templates';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='madstats-templates'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '10.6.4 Translations', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Translations';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='madstats-translations'}\">"+sel+"</a>");
						}});
		
						mmm.add({title : '10.6.5 API', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='API';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='madstats-api'}\">"+sel+"</a>");
						}});
		
						mm.add({title : '10.7 The Winning Scrumboard', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='The Winning Scrumboard';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='the-winning-scrumboard'}\">"+sel+"</a>");
						}});
		
						mm.add({title : '10.8 SlenderMod', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='SlenderMod';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='slendermod'}\">"+sel+"</a>");
						}});
		
						mm.add({title : '10.9 Beats by Bauk', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Beats by Bauk';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='beats-by-bauk'}\">"+sel+"</a>");
						}});
		
						m.add({title : '11 Weblog', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='Weblog';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='weblog'}\">"+sel+"</a>");
						}});
		
						m.add({title : '12 SlenderMod', onclick : function() {
							var sel=tinyMCE.activeEditor.selection.getContent();
							if (sel=='') sel='SlenderMod';
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, "<a href=\"{cms_selflink href='slendermod-2'}\">"+sel+"</a>");
						}});
		
					});

					// Return the new menu button instance
					return c;
			}

			return null;
		}
		});

		// Register plugin with a short name
		tinymce.PluginManager.add('cmslinker', tinymce.plugins.CMSLinkerPlugin);

		 tinyMCE.init({ 
    mode : "exact",
  elements : "content_en",
  body_class : "CMSMSBody",
      content_css : "http://www.flyingpie.nl/tmp/cache/stylesheet_18f410d28e1931476945530c1147f0f7.css,http://www.flyingpie.nl/tmp/cache/stylesheet_172d713c8186650952ae390eb0448340.css",
        entity_encoding : "raw",
  button_tile_map : true, 

		
  theme : "advanced",
  skin : "o2k7",
  skin_variant : "black",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  visual : true,
	      
  accessibility_warnings : false,

  forced_root_block : '',      			
  fix_list_elements : true,
  verify_html : true,
  verify_css_classes : false,
  
  plugins : "paste,inlinepopups,cmslinker",
  
  paste_auto_cleanup_on_paste : true,
  paste_remove_spans : true,
  paste_remove_styles : true,
  theme_advanced_buttons1 : "undo,|,bold,italic,underline,|,cut,copy,paste,pastetext,removeformat,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,cmslinker,link,unlink,|,image,|,formatselect",
  theme_advanced_buttons2 : "",
  theme_advanced_buttons3 : "",
  
  theme_advanced_statusbar_location: "bottom",
  theme_advanced_resizing: true,
 

  theme_advanced_blockformats : "p,div,h1,h2,h3,h4,h5,h6,blockquote,code",
  document_base_url : "http://www.flyingpie.nl/",

  relative_urls : true,
  remove_script_host : true,
  language: "en",
  dialog_type: "modal",
  apply_source_formatting : true  
	 
  ,file_browser_callback : 'CMSMSFilePicker'
  
});
  


function toggleMicroTiny(id) {
  if (!tinyMCE.getInstanceById(id))
    tinyMCE.execCommand('mceAddControl', false, id);
  else
    tinyMCE.execCommand('mceRemoveControl', false, id);
}
	
    
function CMSMSFilePicker (field_name, url, type, win) {
     
  var cmsURL = "http://www.flyingpie.nl/modules/MicroTiny/filepicker.php?_sx_=c14b6b5e&type="+type;
  
  tinyMCE.activeEditor.windowManager.open({
  
    file : cmsURL,
    title : 'File picker',
    width : '800',
    height : '500',
    resizable : "yes",
    scrollbars : "yes",
    inline : "yes",      close_previous : "no"
  
  }, {
    window : win,
    input : field_name
  });
  return false;
}


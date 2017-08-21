<?= $header ?>
<script>
	tinyMCE.init({
	
        mode : "exact",
        elements : "teditor,teditor2,teditor3",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false
	});
	function ajaxfilemanager(field_name, url, type, win) {
		var ajaxfilemanagerurl = "../admin/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
		var view = 'detail';
		switch (type) {
			case "image":
			view = 'thumbnail';
				break;
			case "media":
				break;
			case "flash": 
				break;
			case "file":
				break;
			default:
				return false;
		}
		tinyMCE.activeEditor.windowManager.open({
		    url: "../admin/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
		    width: 782,
		    height: 440,
		    inline : "yes",
		    close_previous : "no"
		},{window : win, input : field_name });
	}
	
function validator(){
	tinyMCE.triggerSave();
	if( $('#teditor').val() == '' ){
		alert("Please fill title");
		return false;
	}
}
</script>


<div class="page_section" id="project-page">
    <div id="container">
	
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-newspaper">&nbsp;</span> Add Iklan</h2>
            <h2 class="fr"><a href="list_table" class="button2">Back</a></h2>
        </div><!-- end .titlebox -->
        
		<?= $contentedit ?>
	
</div><!-- end #home -->
</div><!-- end #home -->
</div><!-- end #home -->
<?= $footer ?>

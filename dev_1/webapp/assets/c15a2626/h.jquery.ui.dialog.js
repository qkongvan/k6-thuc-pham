$(function (){
	$('<div id="h-app-dialog" style="display:none;"><iframe class="iframe-dialog" width="100%" height="100%"></iframe></div>').appendTo('body');
    $('a.h-dialog-link').click(function() {
    	showDialog(this.href, this.title);
        
        return false; //prevent the browser to follow the link
    });
});

function showDialog(url, tit)
{
	//var box = $('<div style="display:none;"><iframe class="iframe-dialog" width="100%" height="100%"></iframe></div>').appendTo('body');
    //var iframeBox = box.find('iframe.iframe-dialog');
        
	var box = $('#h-app-dialog');
	var iframeBox = box.find('iframe.iframe-dialog');
	
	iframeBox.attr('src', 'about:blank');
	iframeBox.attr('src', url);
	box.dialog({
		title: tit?tit:"",
		iframe: true,
		modal: true,
		close: function(event, ui) {
			//box.remove(); // remove div with all data and events
			iframeBox.attr('src', 'about:blank');
		},
    	resize: function() { iframeBox.hide(); }, 
		resizeStop: function() { iframeBox.show(); },
		drag: function() { iframeBox.hide(); }, 
		dragStop: function() { iframeBox.show(); }
		//buttons: { "Close": function() { $(this).dialog("close"); } },
	});
}

function getDialog()
{
	return $('#h-app-dialog');
}
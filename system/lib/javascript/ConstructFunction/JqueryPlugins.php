<?php

function vtooltip($code)
{
	return NULL;
}

#--------------------------------------------------------------------------------------------------------#

function thickbox($code)
{
	return NULL;
}

#--------------------------------------------------------------------------------------------------------#

function confirmbox()
{
	return NULL;
}

#--------------------------------------------------------------------------------------------------------#

function font(array $Classes)
{
	$code = null;
	
	//Cufon.replace('h1',{ textShadow: '1px 1px #fff'});

	foreach ( $Classes as $k => $v)
	{
		if(!is_numeric($k))
		$code .= " Cufon.replace('".$k."',{ textShadow: '".$v."'});"."\n";
		else 
		$code .= " Cufon.replace('".$v."');"." ";
	}

	return $code;
}

#--------------------------------------------------------------------------------------------------------#

function captcha()
{
	$code = " $(document).ready(function() {";
	//$('.QapTcha').QapTcha({disabledSubmit:true,autoRevert:true});
	
	$code .= "$('.QapTcha').QapTcha({disabledSubmit:true,autoRevert:true});";
	
	$code .= "});";
	
	return $code;
}

#--------------------------------------------------------------------------------------------------------#

function validation()
{
	return ' $(document).ready(function(){ $(".valid").validate(); });';
}

#--------------------------------------------------------------------------------------------------------#

function orbit($ElemnetId)
{
	return ' $(window).load(function() {$(\''.$ElemnetId.'\').orbit({ animationSpeed: 800, timer: true, bullets: true});});';
}

#--------------------------------------------------------------------------------------------------------#


function tiptip($ClassName)
{
	return ' $(function(){ $(".tipr").tipTip({defaultPosition:\'right\'}); $(".tipl").tipTip({defaultPosition:\'left\'}); $(".tipt").tipTip({defaultPosition:\'top\'}); $(".tip").tipTip({}); });  ';
}

#--------------------------------------------------------------------------------------------------------#

function mb_containerPlus()
{
	return ' $(function(){ function openModal(o){ var $overlay=$("<div/>").attr("id","mb_overlay").css({position:"fixed",width:"100%", height:"100%", top:0, left:0, background:"#000", opacity:.7}).hide(); $("body").prepend($overlay); $overlay.mb_bringToFront(); o.mb_bringToFront(); o.mb_centerOnWindow(false); $overlay.fadeIn(500); } function closeModal(o){ $("#mb_overlay").fadeOut(500,function(){$(this).remove();})} function initDock(o,docID){ if(o.hasClass("dock")) return; var opt= o.get(0).options; var docEl=$("<span>").attr("id",o.attr("id")+"_dock").css({width:opt.dockedIconDim+5,display:"inline-block"}); var icon= $("<img>").attr("src",opt.elementsPath+"icons/"+(o.attr("icon")?o.attr("icon"):"restore.png")).css({opacity:.4,width:opt.dockedIconDim,height:opt.dockedIconDim, cursor:"pointer"}); icon.click(function(){o.mb_iconize()}); docEl.append(icon); $("#"+docID).append(docEl); o.attr("dock",o.attr("id")+"_dock"); } function iconize(o){ $("#"+o.attr("dock")).find("img:first").hide(); } function restore(o){ $("#"+o.attr("dock")).find("img:first").show(); } function close(o){ $("#"+o.attr("dock")).find("img:first").hide(); $("#open").fadeIn(); } $(".containerPlus").not("#modalContainer").buildContainers({ containment:"document", elementsPath:"'.BASEURL.'js/mb_containerPlus/elements/", dockedIconDim:45, onCreate:function(o){initDock(o,"dock")}, onClose:function(o){close(o)}, onRestore:function(o){restore(o);}, onIconize:function(o){iconize(o)}, onLoad:function(o){}, effectDuration:300}); $("#modalContainer").buildContainers({ containment:"document", elementsPath:"'.BASEURL.'js/mb_containerPlus/elements/", dockedIconDim:45, onCreate:function(o){}, onClose:function(o){closeModal(o)}, onRestore:function(o){openModal(o)}, onIconize:function(o){}, effectDuration:300 }); }); ';
}

#--------------------------------------------------------------------------------------------------------#

function mb_extruder()
{
	return ' $(function(){ $("#extruderTop").buildMbExtruder({ positionFixed:false,position:"top",width:350,extruderOpacity:1,autoCloseTime:0,autoOpenTime:1000,hidePanelsOnClose:false,onExtOpen:function(){},onExtContentLoad:function(){},onExtClose:function(){} }); $("#extruderBottom").buildMbExtruder({ position:"bottom", width:350, extruderOpacity:1, onExtOpen:function(){}, onExtContentLoad:function(){}, onExtClose:function(){} }); $("#extruderLeft").buildMbExtruder({ position:"left", width:300,extruderOpacity:.8,hidePanelsOnClose:false,accordionPanels:false,onExtOpen:function(){},onExtContentLoad:function(){$("#extruderLeft").openPanel();},onExtClose:function(){} });$("#extruderLeft2").buildMbExtruder({position:"left",width:300,positionFixed:false,top:0,extruderOpacity:.8,onExtOpen:function(){},onExtContentLoad:function(){},onExtClose:function(){} }); $("#extruderRight").buildMbExtruder({position:"right",width:300,extruderOpacity:.8,textOrientation:"tb",onExtOpen:function(){},onExtContentLoad:function(){},onExtClose:function(){} }); $.fn.changeLabel=function(text){ $(this).find(".flapLabel").html(text); $(this).find(".flapLabel").mbFlipText(); } }); ';
}

#--------------------------------------------------------------------------------------------------------#

function mb_miniAudioPlayer()
{
	return ' $(function(){ $(".audio").mb_miniPlayer({ width:240, inLine:false }); });';
}

#--------------------------------------------------------------------------------------------------------#

function mbScrollable(array $options)
{
	if(!is_array($options) || (is_array($options)&&count($options)==0)):
	  throw new Exception("mbScrollable jquery plugins must containe a array setting to install it read mbScrollable docmuntation.!");
	endif;
	  
	  $class = $options[0];
	  $dir = (isset($options['dir']) && $options['dir'] == "v")?"dir:'vertical',":'';
	  $w = (isset($options['w']) && is_numeric($options['w']))?"width:".$options['w'].",":'';
	  $h = (isset($options['h']) && is_numeric($options['h']))?"height:".$options['h'].",":'';
	  $eip = (isset($options['eip']) && is_numeric($options['eip']))?$options['eip']:'1';
	  $em = (isset($options['em']) && is_numeric($options['em']))?$options['em']:'6';
	  $ceid = (isset($options['ceid']))?$options['ceid']:'#controls';
	  $st = (isset($options['pt']) && is_numeric($options['pt']))?$options['pt']:'600';
	  $ap = (isset($options['ap']) && $options['ap'] == "false")?$options['ap']:'true';
	  $pt = (isset($options['st'])&& is_numeric($options['st']))?$options['st']:'6000';
	
	return ' $(function(){   $("'.$class.'").mbScrollable({  '.$dir.' '.$w.' '.$h.'elementsInPage:'.$eip.',elementMargin:'.$em.',controls:"'.$ceid.'",slideTimer:'.$pt.',autoscroll:'.$ap.',scrollTimer:'.$st.' });       });';
}


#--------------------------------------------------------------------------------------------------------#


function ajax(array $options)
	{
		$code = ' $(function(){ ';
		foreach ($options as $key => $value) 
		{
			 // prepaire ajax event 
			 $event = explode("/", $key);
			 $code .= "$('".$event[0]."').".$event[1]."(function(){ $.ajax({";
			 $code .= (isset($value['type']))? "type:"."\"".$value['type']."\""."," : "type:"."\"GET\"".",";
			 // Error be carfull..
//			 $code .= (isset($value['processData']))? "processData:".$value['processData']."," : NULL;
			 $code .= (isset($value['dataType']))? "dataType:\"".$value['dataType']."\",": NULL;
			 $code .= (isset($value['cache']))? "cache:".$value['cache']."," : NULL;
			 $code .= (isset($value['global'])) ? "global:".$value['global']."," : NULL;
			 $code .= (isset($value['ifModified']))? "ifModified:".$value['ifModified']."," : NULL;
			 $code .= (isset($value['url']))? "url:\"".$value['url']."\"," : NULL;			 
			 foreach ($value as $key1 => $value1)
			 {
			 	//get data values and fix it
			 	if($key1 == "data" && is_array($value1))
			 	{$code .= 'data: {';
			 		foreach ($value1 as $key2 => $value2)
			 		{if(substr($value2,0,1) == "#" || substr($value2,0,1) == ".")
			 			{ $code .= $key2.":$('".$value2."').val()"; }
			 			else 
			 			{ $code .= $key2.":'".$value2."'"; }
			 			$code .= (end($value1) == $value2)?NULL:",";
			 		}
			 		$code .= "},";
			 	}

			 	else if($key1 == "beforeSend" && is_array($value1))
			 	{ $code .= "beforeSend: function(){ ";
			 		foreach ($value1 as $key2 => $value2)
			 		{ $code .= $value2."; "; }
			 		$code .= "},";
			 	}
			 	
			 	else if($key1 == "complete" && is_array($value1))
			 	{ $code .= "complete: function(){";
			 		foreach ($value1 as $key2 => $value2)
			 		{ $code .= $value2."; "; }
			 		$code .= "},";
			 	}
			 	
			 	else if ($key1 == "success" && is_array($value1))
			 	{   $code .= "success: function(data){";
			 		foreach ($value1 as $key2 => $value2)
			 		{ $code .= $value2."; "; }
			 		$code .= "},";
			 	}
			 	
			 	else if ($key1 == "error" && is_array($value1))
			 	{   $code .= "error: function(){";
			 		foreach ($value1 as $key2 => $value2)
			 		{  $code .= $value2."; "; }
			 		$code .= "},";
			 	}
			 	
			 	else
			 	{
					if(is_array($value1))
					{  foreach ($value1 as $key2 => $value2)
						{ $code .= $key2.$value2; }
					}
			 	}
			 }
			 
			$code .= "statusCode: { 404: function() {alert('page not found');} }";
			$code .= (end($value) === $value1)? "});" : NULL;
			$code .= ($event[1] == "submit")? "return false;" : NULL;
			$code .= (end($value) === $value1)? "});" : NULL;
		}
						
		$code .= "});";
		return $code;
	}

#--------------------------------------------------------------------------------------------------------------#
/*
	
function ajaxUploader(array $options)
{
	$Requireds = array('eID','url','max_file_size','max_file_count');
	foreach($Requireds as $name)
	{ if(!isset($options[$name])) { throw new Exception("you forget to add ".$name." in your ajaxUploader array"); } }
	$code = ' $(function(){';
	if(isset($options['event']))
	{ $event = explode('/',$options['event']); if(count($event) == 2){
	   $code .= '$("'.$event[0].'").'.$event[1].'(function() {';
	   $endEventStatice = 1; }	
	}
	$code .= '$("'.$options['eID'].'").plupload({';
	$code .= "runtimes : 'flash,html5,browserplus,silverlight,gears,html4', unique_names : true, multiple_queues : true, rename: true, sortable: true,";
	$code .= "flash_swf_url : '".BASEURL."js/ajaxUploader/plupload.flash.swf',";
	$code .= "silverlight_xap_url : '".BASEURL."js/ajaxUploader/plupload.silverlight.xap',";
	$code .= (isset($options['resize']))? "resize: {".$options['resize']."},":"resize: {quality : 90},";
	$code .= "url : '".$options['url']."',";
	$code .= "max_file_size : '".$options['max_file_size']."',";
	$code .= "max_file_count: ".$options['max_file_count'].",";
	$code .= " ".(isset($options['filters']))?"filters : [".$options['filters']." ],":NULL."";
	
	################################################################################################
	
	$initSetting = array( "Refresh" => "","StateChanged" => "", "QueueChanged" => "", "UploadProgress" => "", "FilesAdded" => "", "FilesRemoved" => "",                           "FileUploaded" => "", "UploadComplete" => "", "ChunkUploaded" => "", "Error" => ""
						); 
	extract($initSetting);
	foreach($options as $key => $value)
	{ if(in_array($key,array_keys($initSetting)) && is_array($value) &&  count($value) > 0)
		{ foreach($value as $k => $v) { $$key .= $v.";"; } }
	}
	################################################################################################
	
    $code .= "init: { Refresh: function(up) { ".$Refresh." }, StateChanged: function(up) {".$StateChanged."}, QueueChanged: function(up) {".$QueueChanged."},UploadProgress: function(up, file) {".$UploadProgress."},FilesAdded: function(up, files) {".$FilesAdded."},FilesRemoved: function(up, files) {".$FilesRemoved."},FileUploaded: function(up, file, info) {".$FileUploaded."},UploadComplete: function(up,files){".$UploadComplete."},ChunkUploaded: function(up, file, info) {".$ChunkUploaded."},Error: function(up, args) {".$Error."}}";
	
    $code .= '});';
	$code .= (isset($endEventStatice) && $endEventStatice == 1)? '});': NULL;
	$code .= '});';
	return $code;
}

*/

#--------------------------------------------------------------------------------------------------------------#

function swfUploader()
{
	$code = ' var swfu;
		window.onload = function() {
			var settings = {
				flash_url : "'.BASEURL.'js/swfUploader/swfupload/swfupload.swf",
				upload_url: "http://localhost/SWFUpload/demos/simpledemo/upload.php",
				post_params: {"ROWID" : "'.session_id().'"},
				file_size_limit : "3 MB",
				file_types : "*.gif;*.png;*.jpg;*.zip;*.avi",
				file_types_description : "Web Image Files",
				file_upload_limit : 1,
				file_queue_limit : 1,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				
				
				button_width: "65",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: \'<span class="theFont">Upload</span>\',
				button_text_style: ".theFont { font-size: 13; }",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,				
				upload_success_handler : uploadSuccess,																	
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	
			};

			swfu = new SWFUpload(settings);
	     };';
	
	return  $code;
}

###############################################################################################################################


function easy_confirm($classname)
{
	return ' $(function(){  $("'.$classname.'").easyconfirm();   });';
}


function tabs($selector)
{
	if(is_array($selector))
	{
		$code = '';
		
		foreach ($selector as $k)
		{
			$code .= '$(function(){ $(\''.$k.'\').tabify();  });'."\n";
		}
		
		return $code;
	}
	else 
	return '$(function(){ $(\''.$selector.'\').tabify();  });';
}

###############################################################################################################################


function slides($em)
{
	return '$(function(){ var startSlide = 1; $(\''.$em.'\').slides({ effect: \'fade\', preload: true, preloadImage: \'http://localhost/mysite/js/slides/img/loading.gif\', generatePagination: true, play: 5000, pause: 2500, hoverPause: true, start: startSlide, animationComplete: function(current){ } }); });';
}

###############################################################################################################################

function scrollbar()
{
	return '$(document).ready(function(){ $(\'#scrollbar1\').tinyscrollbar();	});';
}

###############################################################################################################################

function hoverZoom()
{
	return '$(function() { $(\'#blue\').hoverZoom();  });';
}

#############################################################################################################################

function colorbox()
{
	return '$(function() {   $(".overview a").colorbox({iframe:true, innerWidth:425, innerHeight:344});   });';
}

?>
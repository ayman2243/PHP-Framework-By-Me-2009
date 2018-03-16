// JavaScript Document
$(function(){
	
	$(".overview").hover( function() { $("div.overview").show(); $("a.overview").addClass("active"); } );
	$('.overview').mouseleave( function() { $("div.overview").hide(); $("a.overview").removeClass("active"); } );
	
});
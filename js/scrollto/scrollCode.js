$(window).resize(function() {
  window.setTimeout('location.reload()',10);
});

$(function(){
	$('a').click(function(event) {
		
		var href = $(this).attr('href');
		
		if (href === "#!/home-page") {
			$(".DataBody").animate({"left": -($('#home').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#ahome').addClass('active');
		}else
		if (href === "#!/about-page") {
			$(".DataBody").animate({"left": -($('#about').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#aabout').addClass('active');
		}else
		if (href === "#!/work-page") {
			$(".DataBody").animate({"left": -($('#work').position().left)}, 600);
			//$(".worksLayout").animate({marginTop: "0px"}, 600);
			$('div.links a').removeClass('active');
			$('#awork').addClass('active');
		}else
		if (href === "#!/services-page") {
			$(".DataBody").animate({"left": -($('#services').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#aservices').addClass('active');
		}else
		if (href === "#!/contacts-page") {
			$(".DataBody").animate({"left": -($('#contacts').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#acontacts').addClass('active');
		}
		else
		{
			var n = href.replace("!/","");
			$(".DataBody").animate({"left": -($(n).position().left)}, 0);
			$('div.links a').removeClass('active');
		}
	
	});
});
$(function(){
		
		if (location.hash === "#!/home-page") {
			$(".DataBody").animate({"left": -($('#home').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#ahome').addClass('active');
		}else
		if (location.hash === "#!/about-page") {
			$(".DataBody").animate({"left": -($('#about').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#aabout').addClass('active');
		}else
		if (location.hash === "#!/work-page") {
			$(".DataBody").animate({"left": -($('#work').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#awork').addClass('active');
		}else
		if (location.hash === "#!/services-page") {
			$(".DataBody").animate({"left": -($('#services').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#aservices').addClass('active');
		}else
		if (location.hash === "#!/contacts-page") {
			$(".DataBody").animate({"left": -($('#contacts').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#acontacts').addClass('active');
		}
		else if(location.hash)
		{
			var n = location.hash.replace("!/","");
			$(".DataBody").animate({"left": -($(n).position().left)}, 0);
			$('div.links a').removeClass('active');
		}
		
		$(window).bind('hashchange', function() {

		if (location.hash === "#!/home-page") {
			$(".DataBody").animate({"left": -($('#home').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#ahome').addClass('active');
		}else
		if (location.hash === "#!/about-page") {
			$(".DataBody").animate({"left": -($('#about').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#aabout').addClass('active');
		}else
		if (location.hash === "#!/work-page") {
			$(".DataBody").animate({"left": -($('#work').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#awork').addClass('active');
		}else
		if (location.hash === "#!/services-page") {
			$(".DataBody").animate({"left": -($('#services').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#aservices').addClass('active');
		}else
		if (location.hash === "#!/contacts-page") {
			$(".DataBody").animate({"left": -($('#contacts').position().left)}, 600);
			$('div.links a').removeClass('active');
			$('#acontacts').addClass('active');
		}
		else if(location.hash)
		{
			var n = location.hash.replace("!/","");
			$(".DataBody").animate({"left": -($(n).position().left)}, 0);
			$('div.links a').removeClass('active');
		}

				
		});
	
});

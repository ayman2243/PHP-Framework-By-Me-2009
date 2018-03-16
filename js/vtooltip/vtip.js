

this.vtip = function() {    
    this.xOffset = -10; // x distance from mouse
    this.yOffset = 16; // y distance from mouse       
    
    $(".vtip").unbind().hover(    
        function(e) {
            this.t = this.title;
            
            this.top = (e.pageY + yOffset); this.left = (e.pageX + xOffset);
            
            $('body').append( '<p id="vtip"><img id="vtipArrow" />' + this.t + '</p>' );
                        
            $('p#vtip #vtipArrow').attr("src", 'http://www.devondisplay.com/images/vtip_arrow.png');
            $('p#vtip').css("top", this.top+"px").css("left", this.left+"px").show();
            
            this.title = ''; 
            
        },
        function() {
            this.title = this.t;
            $("p#vtip").hide().remove();
            this.title = this.t;
        }
    ).mousemove(
        function(e) {
            //this.top = (e.pageY + yOffset);
            //this.left = (e.pageX + xOffset);
                         
            //$("p#vtip").css("top", this.top+"px").css("left", this.left+"px");
        }
    );            
    
};

$(document).ready(function(){vtip();}); 
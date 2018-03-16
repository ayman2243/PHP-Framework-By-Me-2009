$(document).ready(function(){
	
	$('.item .delete').click(function(event){
		
		var elem = $(this).closest('.item');
		
		
		$.confirm({
			'title'		: 'Delete Confirmation',
			'message'	: 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){
						elem.slideUp();
						var itemID = event.target.id;
						
						$.post("http://localhost/gomado3/index.php/js/delete", { name: "John" },
						
					    function(data) {
						    // alert("Data Loaded: " + data); 		
							if(data =='error' ){elem.slideDown();}
							
								   });
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
		
	});
	
});
var Event = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        console.log('Event Created');
        Display = new Display();
        create_todo();
        create_note();
        update_todo();
        update_note();
        delete_todo();
        delete_note();
       
    };
    
    // ------------------------------------------------------------------------
    
    var create_todo = function() {
    	 $("#create_todo").submit(function(evt) {
    		 evt.preventDefault();
  	        var url = $(this).attr('action');
  	        var postData = $(this).serialize();
  	        
  	        $.post(url, postData, function(o){
  	           if(o.result == 1) {
  	               Display.success(o.output);
  	               var output  = Template.todo(o.data[0]);
  	               $("#list_todo").append(output);
  	           } 
  	           else
  	           {
  	        	   Display.error(o.error);
  	           }
  	            
  	        },'json');
  	        load_todo();
    	 });
    };
    
    // ------------------------------------------------------------------------
    
    var create_note = function() {
        $("#create_note").submit(function(evt) {
            console.log('create_note clicked');
            return false;
        });
    };
    
    // ------------------------------------------------------------------------
    
    var update_todo = function() {
        
    };

    // ------------------------------------------------------------------------

    var update_note = function() {
        
    };
    
    // ------------------------------------------------------------------------
    
    var delete_todo = function() {
        
    };

    // ------------------------------------------------------------------------

    var delete_note = function() {
        
    };
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};

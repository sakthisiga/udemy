var Display = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        console.log('Result Created');
    };
    
    // ------------------------------------------------------------------------
    
    this.success = function(msg) { 
    	
    	var dom = $("#success");
    	if(typeof msg == "undefined")
    		{ 	
    			dom.html("Success").fadeIn();
    		}
    	else
    		{
		    	var op = '<ul>';
				op += '<li>' + msg + '</li>';
				op += '</ul>';
				
		    	dom.html(op).fadeIn();
		    	
		    	setTimeout( function(){
		    		dom.fadeOut();
		    	},2000);
    		}
    };
    
    // ------------------------------------------------------------------------
    
    this.error = function(msg) {
    	
    	var dom = $("#error");
    	if(typeof msg == "undefined")
		{
    		dom.html('Error').fadeIn();
		}
    	if(typeof msg == "object")
		{
    		var output = '<ul>';
    		for(var key in msg)
    			{
    				output += '<li>' + msg[key] + '</li>';
    			}
    		output += "</ul>";
    		dom.html(output).fadeIn();
		}
    	else
    	{
    		dom.html(msg).fadeIn();
    	}
    	
    	setTimeout( function(){
    		dom.fadeOut();
    	},2000);
    };
    
    // ------------------------------------------------------------------------
    
this.warning = function(msg) {
    	
    	var dom = $("#warning");
    	if(typeof msg == "undefined")
		{
    		dom.html('Warning').fadeIn();
		}
    	if(typeof msg == "object")
		{
    		var output = '<ul>';
    		for(var key in msg)
    			{
    				output += '<li>' + msg[key] + '</li>';
    			}
    		output += "</ul>";
    		dom.html(output).fadeIn();
		}
    	else
    	{
    		var op = '<ul>';
    		op += '<li>' + msg + '</li>';
    		op += '</ul>';
    		dom.html(op).fadeIn();
    	}
    	
    	setTimeout( function(){
    		dom.fadeOut();
    	},2000);
    };
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};

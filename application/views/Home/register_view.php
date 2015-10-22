<div class="row-fluid">

    <div class="span4 offset4">
         <div id="register-form-error" class="alert alert-error"><!-- Dynamic field flows --> </div>
    </div>
    
</div>


<div class="row-fluid">
<div class="span12">
   
<form id="register-form" class="form-signin" method="post" action="<?=site_url('user/register')?>">
 <fieldset>
    <legend>Register User</legend>
	<div class="control-group">
		<label class="control-label"> User Name</label>
		<div class="controls">
			<input type="text" name="username" class="input-xlarge">
		</div>	
	</div>
	
        <div class="control-group">
		<label class="control-label"> Email</label>
		<div class="controls">
			<input type="text" name="email" class="input-xlarge">
		</div>	
	</div>
    
	<div class="control-group">
		<label class="control-label"> Password</label>
		<div class="controls">
			<input type="password" name="password" class="input-xlarge">
		</div>	
	</div>
	
    <div class="control-group">
		<label class="control-label"> Confirm Password</label>
		<div class="controls">
			<input type="password" name="confirm_password" class="input-xlarge">
		</div>	
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" value="Register" class="btn btn-primary"> 
                        <a class="btn btn-inverse" href="<?=site_url('/')?>">Back</a>
		</div>	
	</div>
 </fieldset>
</form>

</div>
</div>

<script type="text/javascript">
$(function(){
    
    $("#register-form-error").hide();
    $("#register-form").submit(function(evt){
        evt.preventDefault();
        var url = $(this).attr('action');
        var postData = $(this).serialize();
        
        $.post(url, postData, function(o){
           if(o.result == 1) {
               window.location.href = '<?=site_url('dashboard')?>';
           } 
           else
           {
               $("#register-form-error").show();
               var output = '<ul>';
               
               for (var key in o.error)
               {
                    var value = o.error[key];
                    output += '<li>' + value + '</li>';
               }
               output += '</ul>';
               $("#register-form-error").html(output);
               
           }
            
        },'json');
    });
});
</script>
    
<div class="container-fluid">
    <div class="row-fluid">

            <div id="dashboard-side" class="span4">
				<!-- Todo Form Begin-->
				<form id="create_todo" class="form-inline" method="post" action="<?=site_url('api/create_todo')?>">
						<input type="text" name="content" placeholder="Type in a Todo">
						<input class="btn btn-primary" type="submit" value="Create">
				</form>
				<!-- Todo Form Ends-->
				<!-- Display the result -->
				
				<div id="list_todo">
				
				</div>
				</table>
            </div>

            <div id="dashboard-main" class="span8">
				<!-- Note Form Begin-->
				<form id="create_note" class="form-inline" method="post" action="<?=site_url('api/create_note')?>">
						<input type="text" name="title" placeholder="Type in a note Title">
						<textarea name="content"></textarea>
						<input class="btn btn-primary" type="submit" value="Create">
				</form>
				<!-- Note Form Ends-->
            </div>
    </div> 
</div>


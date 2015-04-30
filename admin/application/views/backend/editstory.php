<section class="panel">
	<header class="panel-heading">
		<h3 class="panel-title">Story Details</h3>
	</header>
	<div class="panel-body">
		<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editstorysubmit");?>' enctype='multipart/form-data'>
			<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Title</label>
				<div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="title" value='<?php echo set_value(' title ',$before->title);?>'>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Content</label>
				<div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="content" value='<?php echo set_value(' content ',$before->content);?>'>
				</div>
			</div>

			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">Number of image</label>
				<div class="col-sm-4">
					<?php echo form_dropdown( "numberofimage",$numberofimage,set_value( 'numberofimage',$before->numberofimage),"class='chzn-select form-control'");?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Image1</label>
				<div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="image1" value='<?php echo set_value(' image1 ',$before->image1);?>'>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Image2</label>
				<div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="image2" value='<?php echo set_value(' image2 ',$before->image2);?>'>
				</div>
			</div>
<!--			<?php print_r($selectedcategory);?>-->
			<div class=" form-group">
				<label class="col-sm-2 control-label">Category</label>
				<div class="col-sm-4">
					<?php echo form_dropdown( 'category[]',$category,$selectedcategory, 'id="select3" class="chzn-select form-control" 	data-placeholder="Choose an Genre..." multiple');?>
				</div>
			</div>
			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">Status</label>
				<div class="col-sm-4">
					<?php echo form_dropdown( "status",$status,set_value( 'status',$before->status),"class='chzn-select form-control'");?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Timestamp</label>
				<div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="timestamp" value='<?php echo set_value(' timestamp ',$before->timestamp);?>'>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
				<div class="col-sm-4">
					<button type="submit" class="btn btn-primary">Save</button>
					<a href='<?php echo site_url("site/viewpage"); ?>' class='btn btn-secondary'>Cancel</a>
				</div>
			</div>
		</form>
	</div>
</section>
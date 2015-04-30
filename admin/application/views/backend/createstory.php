<div id="page-title">
    <a href="<?php echo site_url("site/viewstory"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">Story Details </h1>
</div>
<div id="page-content">
    <div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Create Story</h3>
			</div>
			<div class="panel-body">
				<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createstorysubmit");?>' enctype='multipart/form-data'>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="normal-field">Title</label>
							<div class="col-sm-4">
								<input type="text" id="normal-field" class="form-control" name="title" value='<?php echo set_value(' title ');?>'>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="normal-field">Content</label>
							<div class="col-sm-4">
								<textarea row="4" cols="50" id="normal-field" class="form-control" name="content" value='<?php echo set_value(' content ');?>'></textarea>
							</div>
						</div>
						<div class=" form-group">
							<label class="col-sm-2 control-label" for="normal-field">Number of image</label>
							<div class="col-sm-4">
								<?php echo form_dropdown( "numberofimage",$numberofimage,set_value( 'numberofimage'), "class='chzn-select form-control'");?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="normal-field">Image1</label>
							<div class="col-sm-4">
								<input type="file" id="normal-field" class="form-control" name="image1" value='<?php echo set_value(' image1 ');?>'>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="normal-field">Image2</label>
							<div class="col-sm-4">
								<input type="file" id="normal-field" class="form-control" name="image2" value='<?php echo set_value(' image2 ');?>'>
							</div>
						</div>
					<div class=" form-group">
							<label class="col-sm-2 control-label" for="normal-field">Category</label>
							<div class="col-sm-4">
								<?php echo form_dropdown( "category[]",$category,set_value( 'category'), 'id="select3" class="chzn-select form-control" 	data-placeholder="Choose an Genre..." multiple');?>
							</div>
						</div>
						<div class=" form-group">
							<label class="col-sm-2 control-label" for="normal-field">Status</label>
							<div class="col-sm-4">
								<?php echo form_dropdown( "status",$status,set_value( 'status'), "class='chzn-select form-control'");?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
							<div class="col-sm-4">
								<button type="submit" class="btn btn-primary">Save</button>
								<a href="<?php echo site_url(" site/viewpage "); ?>" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
				</form>
				</div>
		</section>
		</div>
	</div>
	</div>
<div id="page-title">
    <a href="<?php echo site_url("site/viewstoryimage"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">Story Image Details </h1>
</div>
<div id="page-content">
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">
Create Story Image </h3>
			</div>
			<div class="panel-body">
				<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createstoryimagesubmit");?>' enctype='multipart/form-data'>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="normal-field">Story id</label>
							<div class="col-sm-4">
								<?php echo form_dropdown( "storyid",$storyid,set_value( 'storyid'), "class='chzn-select form-control'");?>
								<!--<input type="text" id="normal-field" class="form-control" name="storyid" value='<?php echo set_value('storyid');?>'>-->
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="normal-field">Order</label>
							<div class="col-sm-4">
								<input type="text" id="normal-field" class="form-control" name="order" value='<?php echo set_value(' order ');?>'>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="normal-field">Bottom Text</label>
							<div class="col-sm-4">
								<input type="text" id="normal-field" class="form-control" name="bottomtext" value='<?php echo set_value(' order ');?>'>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="normal-field">image</label>
							<div class="col-sm-4">
								<input type="file" id="normal-field" class="form-control" name="image" value='<?php echo set_value(' image ');?>'>
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
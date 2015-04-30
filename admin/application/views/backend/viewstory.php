<div id="page-title">
	<a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url('site/createstory'); ?>">Create</a>

	<h1 class="page-header text-overflow">Story Details</h1>
</div>
<div id="page-content">
<div class="row">
	<div class="col-lg-12">
			<div class="panel drawchintantable">
				<?php $this->chintantable->createsearch("story List");?>
				<div class="fixed-table-container">
					<div class="fixed-table-body">
				<table class="table table-hover" id="" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th data-field="id">ID</th>
							<th data-field="title">Title</th>
							<th data-field="content">Content</th>
							<th data-field="numberofimage">Number of image</th>
							<th data-field="image1">Image1</th>
							<th data-field="image2">Image2</th>
							<th data-field="status">Status</th>
							<th data-field="timestamp">Timestamp</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<?php $this->chintantable->createpagination();?>
			</div>
		</section>
		<script>
			function drawtable(resultrow) {
				return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.title + "</td><td>" + resultrow.content + "</td><td>" + resultrow.numberofimage + "</td><td>" + resultrow.image1 + "</td><td>" + resultrow.image2 + "</td><td>" + resultrow.status + "</td><td>" + resultrow.timestamp + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editstory?id=');?>" + resultrow.id + "'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' href='<?php echo site_url('site/deletestory?id='); ?>" + resultrow.id + "'><i class='icon-trash '></i></a></td></tr>";
			}
			generatejquery("<?php echo $base_url;?>");
		</script>
	</div>
</div>
</div>
</div>
</div>
	<section id="admin-page">
	<?php echo anchor('admin/page/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Add Page'); ?>
	<hr />
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Page Management</h4></div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Title</th>
							<th>URL</th>
							<th>Description</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if (count($pages)) 
							{
								foreach ($pages as $page) 
								{
								
						?>
						<tr>
							<td><?php echo anchor('admin/page/edit/' . $page->static_page_id, $page->static_page_title ); ?></td>
							<td><?php echo anchor('admin/page/edit/' . $page->static_page_id, $page->static_page_url ); ?></td>
							<td><?php echo anchor('admin/page/edit/' . $page->static_page_id, $page->description ); ?></td>
							<td><?php echo btn_edit('admin/page/edit/' . $page->static_page_id); ?></td>
							<td><?php echo btn_delete('admin/page/delete/' . $page->static_page_id); ?></td>
						</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="3">We could not find any pages.</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div><!--/table-responsive-->
		</div><!--panel-body-->
	</div><!--/panel panel-default-->
	</section>

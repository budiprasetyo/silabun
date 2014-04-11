	<section id="admin-page">
	<?php echo anchor('admin/user/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Add User'); ?>
	<hr />
	<div class="panel panel-default">
		<div class="panel-heading"><h4>User Management</h4></div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Username</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if (count($users)) 
							{
								foreach ($users as $user) 
								{
								
						?>
						<tr>
							<td><?php echo anchor('admin/user/edit/' . $user->users_id, $user->username ); ?></td>
							<td><?php echo btn_edit('admin/user/edit/' . $user->users_id); ?></td>
							<td><?php echo btn_delete('admin/user/delete/' . $user->users_id); ?></td>
						</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="3">Kami tidak dapat menemukan user tersebut.</td>
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

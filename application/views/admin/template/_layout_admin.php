<?php
/*
 * _layout_admin.php
 * 
 * Copyright 2014 metamorph <metamorph@code-machine>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */


?>
<?php $this->load->view('admin/components/header'); ?>

<body class="bootstrap-admin-with-small-navbar">
	<nav class="navbar navbar-inverse navbar-fixed-top bootstrap-admin-navbar" role="navigation">
	<div class="container">
	<div class="row">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">	<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>	
			<a class="navbar-brand" rel="home" href="<?php echo base_url() . 'companies.php/admin/dashboard/home'; ?>">Murvien </a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $username; ?> <b class="caret"></b></a>

					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url() . 'companies.php/admin/user/logout'; ?>"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
						<li><a href="#" class="">Another action</a>
						</li>
						<li class="divider"></li>
						<li><a href="#" class="">Separated link</a>
						</li>
						<li class="divider"></li>
						<li><a href="#" class="">One more separated link</a>
						</li>
					</ul>
				</li>
			</ul>
		</div><!--/collapse-navbar-->
	</div><!--/row-->
	</div><!--/container-->
	</nav><!--/navbar navbar-inverse-->
	
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-md-3">
				<div class="container">
				<div class="row">
					
				<div class="col-md-2 bootstrap-admin-col-left">
                    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                        <li class="active">
                            <a href="<?php echo base_url() . 'companies.php/admin/dashboard/home'; ?>"><i class="glyphicon glyphicon-chevron-right"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . 'companies.php/admin/user/home'; ?>"><i class="glyphicon glyphicon-chevron-right"></i> User Management</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . 'companies.php/admin/page'; ?>"><i class="glyphicon glyphicon-chevron-right"></i> Static Page</a>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-chevron-right"></i> Statistics (Charts)</a><!-- stats.html -->
                        </li>
                        <li>
                            <a href="forms.html"><i class="glyphicon glyphicon-chevron-right"></i> Forms</a>
                        </li>
                        <li>
                            <a href="tables.html"><i class="glyphicon glyphicon-chevron-right"></i> Tables</a>
                        </li>
                        <li>
                            <a href="buttons-and-icons.html"><i class="glyphicon glyphicon-chevron-right"></i> Buttons &amp; Icons</a>
                        </li>
                        <li>
                            <a href="wysiwyg-editors.html"><i class="glyphicon glyphicon-chevron-right"></i> WYSIWYG Editors</a>
                        </li>
                        <li>
                            <a href="ui-and-interface.html"><i class="glyphicon glyphicon-chevron-right"></i> UI &amp; Interface</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge pull-right">731</span> Orders</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge pull-right">812</span> Invoices</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge pull-right">27</span> Clients</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge pull-right">1,234</span> Users</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge pull-right">2,221</span> Messages</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge pull-right">11</span> Reports</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge pull-right">83</span> Errors</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge pull-right">4,231</span> Logs</a>
                        </li>
                    </ul>
                </div>
			</div><!--/col-md-2 bootstrap-admin-col-left-->
			</div>
			</div>
			
			<div class="col-sm-9 col-md-9"><?php $this->load->view($subview); ?></div>
		</div><!--/row-->
	</div><!--/container-->

    
<?php $this->load->view('admin/components/footer'); ?>

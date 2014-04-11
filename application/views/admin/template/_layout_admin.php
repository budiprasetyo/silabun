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

<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">	<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>	
			<a class="navbar-brand" rel="home" href="#">Murvien </a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_url() . 'companies.php/admin/user/home'; ?>" class="">Дайджест СМИ</a>
				</li>
				<li><a href="#" class="">Экологический вестник</a>
				</li>
				<li><a href="#" class="">Фонд социального страхования</a>
				</li>
				<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> User <b class="caret"></b></a>

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
			<div class="col-sm-3 col-md-3 pull-right">
				<form class="navbar-form" role="search">
					<div class="input-group">
						<input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>
							</button>
						</div><!--/input-group-btn-->
					</div><!--/input-group-->
				</form><!--/navbar-form-->
			</div><!--/col-sm-3 col-md-3 pull-right-->
		</div><!--/collapse-navbar-->
	</div><!--/navbar navbar-inverse-->
	
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-md-3"></div>
			<div class="col-sm-9 col-md-9"><?php $this->load->view($subview); ?></div>
		</div><!--/row-->
	</div><!--/container-->

    
<?php $this->load->view('admin/components/footer'); ?>

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
	<div id="wrap">
		<div id="top">
			<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
				<div class="container-fluid">
						
						<header class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">	<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>	
							<a class="navbar-brand" rel="home" href="<?php echo base_url() . 'companies.php/admin/dashboard/home'; ?>"><img src="<?php echo base_url(); ?>assets/css/images/kemenkeu.png" alt="logo" height="50px" /></a>
						</header>
						
						<div class="topnav">
							<div class="btn-group">
								<a data-toggle="tooltip" data-original-title="Fullscreen" data-placement="bottom" class="btn btn-default btn-sm" id="toggleFullScreen">
									<i class="glyphicon glyphicon-fullscreen"></i>
								</a>
							</div><!--/btn-group-->
							<div class="btn-group">
								<a href="<?php echo base_url() . 'companies.php/admin/user/logout'; ?>" data-toggle="tooltip" data-original-title="logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
									<i class="fa fa-power-off"></i>
								</a>
							</div><!--/btn-group-->
							<div class="btn-group">
								<a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
								  <i class="fa fa-bars"></i>
								</a> 
								<a data-placement="bottom" data-original-title="Show / Hide Right" data-toggle="tooltip" class="btn btn-default btn-sm toggle-right"> <span class="glyphicon glyphicon-comment"></span>  </a> 
							</div><!--/btn-group-->
						</div><!--/top-nav-->
						
				</div><!--/container-->
			</nav><!--/navbar navbar-inverse-->
			
			<header class="head">
				<div class="search-bar">
					<form class="main-search">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Live Search" />
							<span class="input-group-btn">
								<button class="btn btn-primary btn-sm text-muted" type="button">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div><!--/.input-group-->
					</form><!--/.main-search-->
				</div><!--/.search-bar-->
				<div class="main-bar">
					
				</div><!--/.main-bar-->
			</header><!--/header .head-->
		</div><!--/#top-->
		
		<!-- checking uri segment for highlighting vertical menu-->
		<?php $uri_segment = $this->uri->segment(2); ?>

			<div id="left">
				<div class="media user-media">
					
					<div class="user-media-toggleHover">
						<span class="fa fa-user"></span>
					</div><!--/user-media-toggleHover-->
					
					<div class="user-wrapper">
						<a class="user-link" href="">
							<img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url(); ?>assets/css/images/user.gif">
						</a><!--/user-link-->
						<div class="media-body">
							<h5 class="media-heading"><?php echo ucfirst(strtolower($username)); ?></h5>
							<ul class="list-unstyled user-info">
								<li> <a href="">Administrator</a>  </li>
								<li>Last Access :
								  <br>
								  <small>
									<i class="fa fa-calendar"></i>&nbsp;get from database</small> 
								</li>
							  </ul>
						</div><!--/media-body-->
					</div><!--/user-wrapper-->
					
				</div><!--/media user-media-->
				
				<ul id="menu" class="">
				  <li class="nav-header">Menu</li>
				  <li class="nav-divider"></li>
				  <li class="">
					<a href="">
					  <i class="fa fa-dashboard"></i><span class="link-title"> Dashboard</span> 
					</a> 
				  </li>
				  
				  <li class="">
					<a href="javascript:;">
					  <i class="glyphicon glyphicon-user"></i>
					  <span class="link-title">
					  Manajemen Pengguna
					</span> 
					  <span class="fa arrow"></span> 
					</a> 
					<ul style="height: inherit;">
					  <li class="">
						<a href="icon.html">
						  <i class="fa fa-angle-right"></i>&nbsp;Persetujuan Pengguna</a> 
					  </li>
					  <li class="">
						<a href="button.html">
						  <i class="fa fa-angle-right"></i>&nbsp;Wewenang Pengguna</a> 
					  </li>
					  <li class="">
						<a href="progress.html">
						  <i class="fa fa-angle-right"></i>&nbsp;Progress</a> 
					  </li>
					  <li class="">
						<a href="pricing.html">
						  <i class="fa fa-credit-card"></i>&nbsp;Pricing Table</a> 
					  </li>
					  <li class="">
						<a href="bgimage.html">
						  <i class="fa fa-angle-right"></i>&nbsp;Bg Image</a> 
					  </li>
					  <li class="">
						<a href="bgcolor.html">
						  <i class="fa fa-angle-right"></i>&nbsp;Bg Color</a> 
					  </li>
					</ul>
				  </li>
				  
				  
				  <li>
					<a href="">
					  <i class="glyphicon glyphicon-upload"></i>
					  <span class="link-title"> Upload</span> 
					</a> 
				  </li>
				  <li>
					<a href="maps.html">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  <li>
					<a href="maps.html">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  <li>
					<a href="maps.html">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  
				  <li>
					<a href="maps.html">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  <li>
					<a href="maps.html">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  <li class="nav-divider"></li>
				  <li>
					<a href="maps.html">
					<span class="link-title">
					&nbsp;
					</span>
					</a>  
				  </li>
				  <li>
					<a href="maps.html">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				</ul><!--/#menu-->
				
			</div><!--/left-->
				
			<div id="content">
				<div class="outer">
					<div class="inner">
						<?php $this->load->view($subview); ?>
					</div><!--/inner-->
				</div><!--/outer-->
			</div><!--/content-->
			
			<div id="right">
				<div class="alert alert-danger">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>Warning!</strong>  Best check yo self, you're not looking too good.
				</div>

				<!-- .well well-small -->
				<div class="well well-small dark">
				  <ul class="list-unstyled">
					<li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span> 
					</li>
					<li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span> 
					</li>
					<li>Popularity <span class="dynamicbar pull-right">Loading..</span> 
					</li>
					<li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span> 
					</li>
				  </ul>
				</div><!-- /.well well-small -->

				<!-- .well well-small -->
				<div class="well well-small dark">
				  <button class="btn btn-block">Default</button>
				  <button class="btn btn-primary btn-block">Primary</button>
				  <button class="btn btn-info btn-block">Info</button>
				  <button class="btn btn-success btn-block">Success</button>
				  <button class="btn btn-danger btn-block">Danger</button>
				  <button class="btn btn-warning btn-block">Warning</button>
				  <button class="btn btn-inverse btn-block">Inverse</button>
				  <button class="btn btn-metis-1 btn-block">btn-metis-1</button>
				  <button class="btn btn-metis-2 btn-block">btn-metis-2</button>
				  <button class="btn btn-metis-3 btn-block">btn-metis-3</button>
				  <button class="btn btn-metis-4 btn-block">btn-metis-4</button>
				  <button class="btn btn-metis-5 btn-block">btn-metis-5</button>
				  <button class="btn btn-metis-6 btn-block">btn-metis-6</button>
				</div><!-- /.well well-small -->

				<!-- .well well-small -->
				<div class="well well-small dark">
				  <span>Default</span> <span class="pull-right"><small>20%</small> </span> 
				  <div class="progress xs">
					<div class="progress-bar progress-bar-info" style="width: 20%"></div>
				  </div>
				  <span>Success</span> <span class="pull-right"><small>40%</small> </span> 
				  <div class="progress xs">
					<div class="progress-bar progress-bar-success" style="width: 40%"></div>
				  </div>
				  <span>warning</span> <span class="pull-right"><small>60%</small> </span> 
				  <div class="progress xs">
					<div class="progress-bar progress-bar-warning" style="width: 60%"></div>
				  </div>
				  <span>Danger</span> <span class="pull-right"><small>80%</small> </span> 
				  <div class="progress xs">
					<div class="progress-bar progress-bar-danger" style="width: 80%"></div>
				  </div>
				</div>
			  </div><!-- /#right -->
		
	</div><!--/#wrap-->
	
	 <!-- #helpModal -->
    <div id="helpModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
              in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->
    
<?php $this->load->view('admin/components/footer'); ?>

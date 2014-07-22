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
							<a class="navbar-brand" rel="home" href="<?php echo base_url() . 'companies.php/admin/dashboard/home'; ?>"><img src="<?php echo base_url(); ?>assets/css/images/kemenkeu.png" alt="logo" height="50px" style="padding:3px 0 3px 20px;"/></a>
						</header>
						
						<div class="topnav">
						</div><!--/top-nav-->
						
				</div><!--/container-->
			</nav><!--/navbar navbar-inverse-->
			
			<header class="head">
				<div class="search-bar">
					<form class="main-search">
						<div class="input-group">
							<!--/ remove input button for  searching here-->
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
							<h5 class="media-heading"><?php echo strtoupper($username); ?></h5>
							<ul class="list-unstyled user-info">
								<li> <a href=""><?php echo $username; ?></a>  </li> <!-- role id -->
								<li>Sign Up User
								  <br>
								</li>
							  </ul>
						</div><!--/media-body-->
					</div><!--/user-wrapper-->
					
				</div><!--/media user-media-->
				
				<ul id="menu" class="">
				  <li class="nav-header"></li>
				  <li class="nav-divider"></li>
				  <li class="">
					<a href="javascript:;">
						<span class="link-title">&nbsp;</span> 
					</a> 
				  </li>
				  
				  <li class="">
					<a href="javascript:;">
					  <span class="link-title">&nbsp;</span> 
					</a> 
				  </li>
				  
				 
				  <li>
					<a href="javascript:;">
					  <span class="link-title"> &nbsp;</span> 
					</a> 
				  </li>
				  <li>
				  
				  <li class="">
					<a href="javascript:;">
					  <span class="link-title">
					  &nbsp;
					</span> 
					</a> 
				  </li>
				  
				  <li>
					<a href="javascript:;">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  <li>
					<a href="javascript:;">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  <li>
					<a href="javascript:;">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  
				  <li>
					<a href="javascript:;">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  <li>
					<a href="javascript:;">
					<span class="link-title">
					&nbsp;
					</span>
					</a> 
				  </li>
				  <li class="nav-divider"></li>
				  <li>
					<a href="javascript:;">
					<span class="link-title">
					&nbsp;
					</span>
					</a>  
				  </li>
				  <li>
					<a href="javascript:;">
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

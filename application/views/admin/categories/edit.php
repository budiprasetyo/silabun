
	<div class="row">
		<div class="col-lg-6">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="fa fa-edit"></i>
					</div><!--/icons-->
					<h5>your title here</h5>
					
					<!-- .toolbar -->
					<div class="toolbar">
						<nav style="padding: 8px;">
							<a href="javascript:;" class="btn btn-default btn-xs collapse-box">
							  <i class="fa fa-minus"></i>
							</a> 
							<a href="javascript:;" class="btn btn-default btn-xs full-box">
							  <i class="fa fa-expand"></i>
							</a> 
							<a href="javascript:;" class="btn btn-danger btn-xs close-box">
							  <i class="fa fa-times"></i>
							</a> 
						</nav>
					</div><!--/.toolbar-->
				</header>
				
				<div id="div-1" class="body">
					<form class="form-horizontal">
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">Normal Input Field</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Email" class="form-control">
						</div>
					  </div><!-- /.form-group -->
					  <div class="form-group">
						<label for="pass1" class="control-label col-lg-4">Password Field</label>
						<div class="col-lg-8">
						  <input class="form-control" type="password" id="pass1" data-original-title="Please use your secure password" data-placement="top">
						</div>
					  </div><!-- /.form-group -->
					  <div class="form-group">
						<label class="control-label col-lg-4">Read only input</label>
						<div class="col-lg-8">
						  <input type="text" value="read only" readonly="" class="form-control">
						</div>
					  </div><!-- /.form-group -->
					  <div class="form-group">
						<label class="control-label col-lg-4">Disabled input</label>
						<div class="col-lg-8">
						  <input type="text" value="disabled" disabled="" class="form-control">
						</div>
					  </div><!-- /.form-group -->
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">With Placeholder</label>
						<div class="col-lg-8">
						  <input type="text" id="text2" placeholder="placeholder text" class="form-control">
						</div>
					  </div><!-- /.form-group -->
					  <div class="form-group">
						<label for="limiter" class="control-label col-lg-4">Input limiter</label>
						<div class="col-lg-8">
						  <textarea id="limiter" class="form-control" maxlength="140"></textarea>
						</div>
					  </div><!-- /.row -->
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Default Textarea</label>
						<div class="col-lg-8">
						  <textarea id="text4" class="form-control"></textarea>
						</div>
					  </div><!-- /.form-group -->
					  <div class="form-group">
						<label for="autosize" class="control-label col-lg-4">Textarea With Autosize</label>
						<div class="col-lg-8">
						  <textarea id="autosize" class="form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 54px;"></textarea>
						</div>
					  </div><!-- /.form-group -->
					  <div class="form-group">
						<label for="tags" class="control-label col-lg-4">Tags</label>
						<div class="col-lg-8">
						  <input name="tags" id="tags" value="foo,bar,baz" class="form-control" style="display: none;"><div id="tags_tagsinput" class="tagsinput" style="width: 300px; height: 100px;"><span class="tag"><span>foo&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span><span class="tag"><span>bar&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span><span class="tag"><span>baz&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span><div id="tags_addTag"><input id="tags_tag" value="" data-default="add a tag" style="width: 68px; color: rgb(102, 102, 102);"></div><div class="tags_clear"></div></div>
						</div>
					  </div><!-- /.form-group -->
					</form><!--/form-horizontal-->
				  </div><!--/div-1-->
				
			</div><!--/box-dark-->
		</div><!--/col-lg-6-->
	</div><!--/row-->
	
	<!--BEGIN AUTOMATIC JUMP-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-exchange"></i>
                    </div>
                    <h5>Automatically jump to the next input-field</h5>
                  </header>
                  <div class="body">
                    <form id="validVal" class="form-inline">
                      <div class="row form-group">
                        <div class="col-lg-4">
                          <input class="form-control autotab" type="text" maxlength="3" tabindex="11">
                        </div><!-- /.col-lg-4 -->
                        <div class="col-lg-4">
                          <input class="form-control autotab" type="text" maxlength="4" tabindex="12">
                        </div><!-- /.col-lg-4 -->
                        <div class="col-lg-4">
                          <input class="form-control" type="text" maxlength="5" tabindex="13">
                        </div>
                      </div><!-- /.row -->
                      <div class="row form-group">
                        <div class="col-lg-6">
                          <select class="form-control autotab" name="tabs1_7" tabindex="14">
                            <option value="one">One</option>
                            <option value="two">Two</option>
                            <option value="three">Three</option>
                          </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                          <select class="form-control autotab" tabindex="15">
                            <option value="one">One</option>
                            <option value="two">Two</option>
                            <option value="three">Three</option>
                          </select>
                        </div><!-- /.col-lg-6 -->
                      </div><!-- /.row -->
                    </form>
                  </div>
                </div>
              </div>
            </div><!--/.row-->

    <!--END AUTOMATIC JUMP-->

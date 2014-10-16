<div id="content">
	<div id="row">
		<div class="col-lg-12">
			<h3>Aplikasi Silabun Online</h3>
				<blockquote>
					<p>Sistem Laporan Bendahara Umum Negara</p>
				</blockquote>
			  <h4>Table of contents</h4>
              <ul>
                <li> <a href="#author">Author</a>  </li>
                <li> <a href="#release-history">Release History</a>  </li>
                <li> <a href="#credits">Credits</a>  </li>
              </ul>
            <hr />
            <h4 id="author">Author</h4>
            <p>Copyleft 2014 all rights reversed Direktorat Sistem Perbendaharaan</p>
            <ul>
				<li>Developer: <a href="http://askubuntu.com/users/97999/metamorph" target="_blank">Budi Prasetyo a.k.a. metamorph</a> <i class="glyphicon glyphicon-phone"></i>+62811383477 [only SMS]</li>
				<li>Service Desk: <a href="https://www.facebook.com/hoobsalbot" target="_blank">Ivan Setiawan a.k.a. hoobsalbot</a> <i class="glyphicon glyphicon-phone"></i>+628562130825</li>
				<li>eMail: <a href="https://mail.google.com" target="_blank">silabunweb@gmail.com</a></li>
            </ul>
            <hr />
            <h4 id="release-history">Release History</h4>
            <?php
				 
				$dir = "/var/www/dsp-lpj-local/";
				$output = array();
				chdir($dir);
				exec("git log",$output);
				$histories = array();
				
				foreach($output as $line){
					
					if(strpos($line, 'commit') === 0){
						if(!empty($commit)){
							array_push($histories, $commit);	
							unset($commit);
						}
						$commit['hash'] = substr($line, strlen('commit'));
					}
					else if(strpos($line, 'Author') === 0){
						$commit['author'] = substr($line, strlen('Author:'));
					}
					else if(strpos($line, 'Date') === 0){
						$commit['date'] = substr($line, strlen('Date:'));
					}
					else{	
						if(isset($commit['message']))
							$commit['message'] .= $line;
						else
							$commit['message'] = $line;					}
				}
				
				if(!empty($commit)) {
					array_push($history, $commit);
				}
				
				//~ var_dump($histories);
			?>
			<table class="table table-bordered table-condensed table-hover table-striped sortfield">
			<thead>
				<tr>
					<th>Date</th>
					<th>Commit</th>
					<th>Author</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($histories as $history) 
					{
				?>
				<tr>
					<td><?php echo $history['date']; ?></td>
					<td><?php echo substr($history['hash'],0,10); ?></td>
					<td><?php echo $history['author']; ?></td>
					<td style="white-space:normal;"><?php echo $history['message']; ?></td>
				</tr>
				<?php 
					}
				?>
			</tbody>
			</table>
			<hr />
            <h4 id="credits">Credits</h4>
				<ul>
					<li> <a href="https://github.com/onokumus/Bootstrap-Admin-Template" target="_blank">Bootstrap Admin Template by Onokumus</a> </li>
					<li> <a href="http://php.net" target="_blank">PHP</a> </li>
					<li> <a href="http://www.mysql.com" target="_blank">MySQL</a> </li>
					<li> <a href="http://nginx.org" target="_blank">Nginx</a> </li>
					<li> <a href="http://httpd.apache.org" target="_blank">Apache</a> </li>
					<li> <a href="http://git-scm.com" target="_blank">Git</a> </li>
					<li> <a href="https://ellislab.com/codeigniter" target="_blank">Codeigniter</a> </li>
					<li> <a href="http://www.ubuntu.com" target="_blank">Ubuntu</a> </li>
				</ul>
		</div>
	</div>
</div>
			

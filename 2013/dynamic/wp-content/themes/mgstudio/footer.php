<?php 
global $t_url;
$pageID = get_page_by_path( 'contato' );
$pageID = $pageID->ID;
$email = antispambot( get_option( 'admin_email' ) );
?>	<hr>
	<footer id="foot">
		<h5 id="feelings">Acesse seus sentidos…</h5>
		<section id="contact">
			<h5 class="heading">Entre em contato!</h5>
			<div id="hcard-mg" class="vcard">
				<em class="fn org">MG Studio</em>
				<address class="adr">
					<span class="street-address"><?php the_field( 'street-address', $pageID ); ?> 
						<br><?php the_field( 'neighborhood', $pageID ); ?> </span>
					<span class="locality"><?php the_field( 'locality', $pageID ); ?></span> - 
					<span class="region"><?php the_field( 'region', $pageID ); ?></span><br>
					Cep: <span class="postal-code"><?php the_field( 'postal-code', $pageID ); ?></span>
				</address>
				<div class="tel"><?php 
				$fones = array();
				while( has_sub_field( 'fones', $pageID ) )
					$fones[] = get_sub_field( 'fone' );
				echo implode( ' | ', $fones ); 
				?></div>
				<a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
			</div>
		</section>
		<section id="social-again">
			<a href="http://pinterest.com/mgstudio/" target="_blank"><img src="<?php echo $t_url; ?>/img/pins.png" alt="Pinterest" width="46" height="47"></a>
			<iframe src="//www.facebook.com/plugins/like.php?locale=en_US&amp;href=http%3A%2F%2Fwww.facebook.com%2Fmgstudioweb&amp;send=false&amp;layout=button_count&amp;width=85&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=462254627128823" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe>
		</section>
		<p id="copyright">© Copyright | Todos os direitos reservados</p>
	</footer>
	<!-- WP/ --><?php wp_footer(); ?><!-- /WP -->
	<!-- ClickTale Bottom part -->
	<div id="ClickTaleDiv" style="display: none;"></div>
	<script>if(document.location.protocol!='https:')document.write(unescape("%3Cscript%20src='http://s.clicktale.net/WRe0.js'%20type='text/javascript'%3E%3C/script%3E"));</script>
	<script>if(typeof ClickTale=='function')ClickTale(6093,1,"www08");</script>
	<!-- ClickTale end of Bottom part -->
</body>
</html>
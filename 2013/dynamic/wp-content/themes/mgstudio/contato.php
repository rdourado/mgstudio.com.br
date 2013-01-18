<?php 
/*
Template name: Contato
*/

$nome = $email = $telefone = $msg = '';
$error = "\n";
$ok = false;

if ( isset( $_POST['gotcha'] ) && $_POST['gotcha'] )
	wp_die( 'Aha! Gotcha!', 'SPAMMER!' );

if ( $_POST['submitted'] ) {

	if ( ! $_POST['nome'] )
		$nome = ' invalid" placeholder="Digite um nome" aria-invalid="true" aria-describedby="err-msg';
	if ( ! $_POST['email'] || ( $_POST['email'] && ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) )
		$email = ' invalid" placeholder="Digite um e-mail válido" aria-invalid="true" aria-describedby="err-msg';
	if ( ! $_POST['telefone'] )
		$telefone = ' invalid" placeholder="Digite um telefone" aria-invalid="true" aria-describedby="err-msg';
	if ( ! $_POST['msg'] )
		$msg = ' invalid" placeholder="Digite uma mensagem" aria-invalid="true" aria-describedby="err-msg';

	if ( $nome || $email || $telefone || $msg ) {
		$error = '<p id="err-msg">Por favor, preencha todos os campos.</p>';
	} else {
		$youremail 	= get_option( 'admin_email' );
		$body 		= "Nome: " . $_POST['nome'] . "\nE-mail: " . $_POST['email'] . "\nTelefone: " . $_POST['telefone'] . "\n\n" . $_POST['msg'];
		//$headers 	= "Reply-To: {$_POST['email']}\nReturn-Path: {$youremail}\n";
		
		$headers = "MIME-Version: 1.1\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "From: " . $youremail . "\n"; // remetente
		$headers .= "Reply-To: " . $youremail . "\n"; // return-path
		$headers .= "Return-Path: " . $youremail . "\n"; // return-path
		
		//var_dump($youremail, '[MG] Mensagem enviada pelo site', $body, $headers);
		//exit();

		if ( mail( $youremail, '[MG] Mensagem enviada pelo site', $body, $headers, "-r" . $youremail ) ) {
			$ok = true;
			$error = '<p id="err-msg">Mensagem enviada! Por favor, aguarde nosso retorno.</p>' . "\n";
		} else {
			$error = '<p id="err-msg">Erro ao enviar mensagem. Por favor, tente novamente.</p>' . "\n";
		}
	}

}

?>
<?php get_header(); ?>
	<article id="body" class="entry">
<?php 	while( have_posts() ) : the_post(); ?>
		<h1 id="entry-title"><?php the_title(); ?></h1>
		<form action="" method="post" id="contactform">
			<h2>Entre em contato conosco!</h2>
			<fieldset>
				<?php echo $error; ?>
				<p class="field field-nome">
					<label for="nome">Nome:</label><br>
					<input type="text" name="nome" id="nome" value="<?php 
					if ( ! $ok ) echo $_POST['nome']; 
					?>" class="field-text<?php echo $nome; ?>" size="30" autofocus required aria-required="true">
				</p>
				<p class="field field-email">
					<label for="email">E-mail:</label><br>
					<input type="email" name="email" id="email" value="<?php 
					if ( ! $ok ) echo $_POST['email']; 
					?>" class="field-text<?php echo $email; ?>" size="30" required aria-required="true">
				</p>
				<p class="field field-telefone">
					<label for="telefone">Telefone:</label><br>
					<input type="text" name="telefone" id="telefone" value="<?php 
					if ( ! $ok ) echo $_POST['telefone']; 
					?>" class="field-text<?php echo $telefone; ?>" size="30" required aria-required="true">
				</p>
				<p class="field field-msg">
					<label for="msg">Mensagem:</label><br>
					<textarea name="msg" id="msg" cols="30" rows="10" class="field-area<?php echo $msg; ?>" required aria-required="true"><?php 
					if ( ! $ok ) echo $_POST['msg']; 
					?></textarea>
				</p>
				<p class="antispam">
					<label for="gotcha">Campo antispam. Ignore-o, por favor.</label><br>
					<input type="text" name="gotcha" id="gotcha" value="">
				</p>
				<p class="field field-submit">
					<input type="hidden" name="submitted" class="hide" value="1">
					<button type="submit">Enviar</button>
				</p>
			</fieldset>
			<?php the_content(); ?>
		</form>
<?php 	endwhile; ?>
		<div id="localization">
			<h3 class="ucase">Onde estamos</h3>
			<?php the_field( 'gmap' ); ?>

			<p class="adr"><?php the_field( 'street-address' ); ?> <br>
			<?php the_field( 'neighborhood' ); ?> <?php the_field( 'locality' ); ?> - <?php the_field( 'region' ); ?> <br>
			Cep: <?php the_field( 'postal-code' ); ?></p>
			<p class="tel">Tel. <?php 
			$fones = array();
			while( has_sub_field( 'fones' ) )
				$fones[] = get_sub_field( 'fone' );
			echo implode( ' <br>', $fones ); 
			?></p>
		</div>
	</article>
<?php get_footer(); ?>
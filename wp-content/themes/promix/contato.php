<?php
/* Template Name: Contato */

$pageTitle = 'Contato';

get_header();
?>


<h1 class="pmx-h1"><?php echo $pageTitle; ?></h1>



<form class="pmx-form" id="contact-form" >
    <fieldset class="pmx-fieldset" >
    	<input class="pmx-input"  id="nome" type="text"/>
        <label class="pmx-label"  for="nome">Nome</label>
  	</fieldset>
  	<fieldset class="pmx-fieldset" >
    	<input class="pmx-input"  id="email" type="email"/>
        <label class="pmx-label"  for="email">E-mail</label>
  	</fieldset>
  	<fieldset class="pmx-fieldset" >
    	<input class="pmx-input"  id="assunto" type="text"/>
        <label class="pmx-label"  for="assunto">Assunto</label>
  	</fieldset>
  	<fieldset class="pmx-fieldset" >
  	    <textarea class="pmx-input"  id="mensagem" ></textarea>
        <label class="pmx-label"  for="mensagem">Mensagem</label>
  	</fieldset>

  	<button class="pmx-btn pmx-primary" id="contact-send-msg" >Enviar</button>

  	<div class="clear" ></div>
  	<div id="msg-result" ></div>
</form>

<span id="result" ></span>


<?php get_footer(); ?>
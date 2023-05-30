<?php
session_start();
require_once "../../controllers/head_script.php";
require_once "../../controllers/nav_script.php";
?>
<div class="container contact">
<div class="row">
	<div class="col-md-12">
	<div class="d-flex justify-content-center form-container mt-5 mb-5 pt-0 rounded mnb">
		<form name="contact" id="contact" method="post" action="/controllers/contact_script.php" enctype="multipart/form-data">
			<div class=" input-row">
			<label style="padding-top: 20px;">Nom</label> <span id="userName" class="info"></span><br /> 
			<input type="text" class="input-field" name="userName" id="userName" />
	</div>
	<div class="input-row">
		<label>Email</label> <span id="userEmail-info" class="info"></span><br />
		<input type="email" class="input-field" name="userEmail" id="userEmail" required />
	</div>
	<div class="input-row">
		<label>Sujet</label> <span id="subject" class="info"></span><br />
		<input type="text" class="input-field" name="subject" id="subject" />
	</div>
	<div class="input-row">
		<label>Message</label> <span id="userMessage" class="info"></span><br />
		<textarea name="content" id="content" class="input-field" cols="35" rows="6"></textarea>
	</div>
	<div>
		<input type="submit" name="send" class="btn-submit my-3" value="Envoyer" />
	</div>
	</form>
	</div>
</div>
	</div>
</div>
<?php
require_once"../../controllers/footer_script.php";
?>

<div class="container">
	<div class="row">
		<div class="span4 offset4">
			<div class="well">
			<legend>None Shall Pass</legend>
			<form method="POST" action="/auth/login" accept-charset="UTF-8">
				<p>Enter the password for "advanced" access. Please remember to log out afterwards.</p>
				<?PHP if(isset($error)){ ?>
				<div class="alert alert-error">
					<a class="close" data-dismiss="alert" href="#">x</a> Incorrect
				</div>
				<?PHP } ?>
					<input class="span3" placeholder="Magic Word" type="password" name="password">
					<input class="span3" type="hidden" name="redirect" value="<?PHP
						echo isset($redirect) ? $redirect : '/';
					?>">
				</label>
				<button class="btn-info btn" type="submit">Make it so</button>      
			</form>    
			</div>
		</div>
	</div>
</div>


<div class="container">
<?PHP 
$row = NULL;
foreach($mysteries as $mystery){
	if($row === 0){ ?>
</div>
	<?PHP } 
	if(!$row){ ?>
<div class="row-fluid">
&nbsp;
</div>
<div class="row-fluid">
	<?PHP } 
	$row++;
	if($row == 3){
		$row = 0;
	}
	?>
		<div class="span4 centered">
			<h3><?PHP echo $mystery['name'] ?></h3>
			<div class="row-fluid">
				<div class="span2">
					Earth
				</div>
				<div class="span2">
					Fire
				</div>
				<div class="span2">
					Air
				</div>
				<div class="span2">
					Water
				</div>
				<div class="span2">
					Blood
				</div>
				<div class="span2">
					Coin
				</div>
			</div>
			<div class="row-fluid">
				<div class="span2 big">
					<?PHP echo $mystery['earth'] ?>
				</div>
				<div class="span2">
					<?PHP echo $mystery['fire'] ?>
				</div>
				<div class="span2">
					<?PHP echo $mystery['air'] ?>
				</div>
				<div class="span2">
					<?PHP echo $mystery['water'] ?>
				</div>
				<div class="span2">
					<?PHP echo $mystery['blood'] ?>
				</div>
				<div class="span2">
					<?PHP echo $mystery['coin'] ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span10 offset1 big">
					<?PHP echo $mystery['effect'] ?>
				</div>
			</div>
		</div>
<?PHP } ?>
</div>

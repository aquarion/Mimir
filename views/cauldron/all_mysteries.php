
<div class="container">

<ul class="nav nav-pills">
          	<li class="toggleinvert" title="invert selection"><a href="#" ><i class="icon-refresh"></i></a></li>
          	<li class="active toggleall"><a href="#"     >All</a></li>
          	<?PHP 
          	$types = array_keys($types);
          	sort($types);
          	foreach($types as $type ) { ?>
          	<li class="active toggleme" id="<?PHP echo 'nav'.preg_replace('/\s+/', '', $type) ?>"><a href="#"     ><?PHP echo $type ?></a></li>
          	<?PHP } ?>
        </ul>

<?PHP 
$row = NULL;
foreach($mysteries as $mystery){
	if($row === 0){ ?>
</div>
	<?PHP } 
	if(!$row){ ?>
&nbsp;
</div>
<div class="row-fluid mysteryrow">
	<?PHP } 
	$row++;
	if($row == 3){
		$row = 0;
	}
	?>
		<div style="display: inline-block"  class="span4 centered type<?PHP echo preg_replace('/\s+/', '', $mystery['type']); ?> mysteryblock">
			<h3 class="mysteryname"><?PHP echo $mystery['name'] ?></h3>
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
					<p><?PHP echo $mystery['effect'] ?></p>
					<p><?PHP echo $mystery['type'] ?></p>
				</div>
			</div>
		</div>
<?PHP } ?>
</div>
<div id="hiddenBlocks"></div>
  <script>


  	function reflow(){
    	$('.toggleme').each(function(){
    		var type = $('a', this).html().replace(/\s/g, '');;
    		if($(this).hasClass('active')){
    			$('.type'+type).show();
    		} else {
    			$('.type'+type).hide();
    		}
    	});

		if($('.toggleme.active').length == $('.toggleme').length){
			$('.toggleall').addClass('active');
		} else {
			$('.toggleall').removeClass('active');
		}


  		$('.mysteryblock').each(function(){
  			$(this).detach();
  			$(this).appendTo('#hiddenBlocks');
  		})
  		mysteries = jQuery.makeArray( $('.mysteryblock:visible') );
  		mysteries = mysteries.sort(function(x, y){ 
  			x = $('.mysteryname', x).html()
  			y = $('.mysteryname', y).html()

		    if (x < y) {
		        return 1;
		    }
		    if (x > y) {
		        return -1;
		    }
		    return 0;
		});

  		$('.mysteryrow').each(function(){
	  		var thisRow = $(this)
  			for (var i = 0; i < 3; i++) {
	  			mystery = mysteries.pop();

	  			if(mystery){
	  				$(mystery).detach()
	  				$(mystery).appendTo(thisRow);
	  			} else {
	  				return;
	  			}		
  			};
  		})

  	}


    $('.toggleme').click(function (e) {
    	$(this).toggleClass('active');
    	reflow();
    })
    
    $('.toggleinvert').click(function (e) {
    	$('.toggleme').toggleClass('active');
    	reflow();
    })

    $('.toggleall').click(function (e) {
    	$(this).toggleClass('active');
		if($(this).hasClass('active')){
			$('.toggleme').addClass('active');
			$('.mysteryblock').show();
		} else {
			$('.toggleme').removeClass('active');
			$('.mysteryblock').hide();
		}
		reflow();
    })

    $('#navWorldForge').click();
    


    
</script>
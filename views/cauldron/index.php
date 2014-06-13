
<div class="container">
	<div class="row">
		<div class="span5">
			<h1>Cauldron</h1>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span2 well centered">
			<a href="" class="increment" rel="fire">
				<img src="/assets/home/img/elements/Red.png">
			</a>
			<br/>
			Fire<br/>
			<a href="" class="decrement" rel="fire">-</a>
			<input type="numeric" class="input-mini centered" id="fire" />
			<a href="" class="increment" rel="fire">+</a> 
		</div>
		<div class="span2 well centered">
			<a href="" class="increment" rel="water">
				<img src="/assets/home/img/elements/Blue.png"></a>
			<br/>
			Water<br/>
			<a href="" class="decrement" rel="water">-</a>
			<input type="numeric" class="input-mini centered" id="water" />
			<a href="" class="increment" rel="water">+</a> 
		</div>
		<div class="span2 well centered">
			<a href="" class="increment" rel="earth">
				<img src="/assets/home/img/elements/Green.png"><br/>
			</a>
			Earth<br/>

			<a href="" class="decrement" rel="earth">-</a>
			<input type="numeric" class="input-mini centered" id="earth" />
			<a href="" class="increment" rel="earth">+</a> 
		</div>
		<div class="span2 well centered">
			<a href="" class="increment" rel="air">
				<img src="/assets/home/img/elements/White.png"><br/>
			</a>
			Air<br/>
			<a href="" class="decrement" rel="air">-</a>
			<input type="numeric" class="input-mini centered" id="air" />
			<a href="" class="increment" rel="air">+</a> 
		</div>
		<div class="span2 well centered">
			<a href="" class="increment" rel="blood">
				<img src="/assets/home/img/elements/blood.png">
			</a>
			<br/>
			Blood<br/>
			<a href="" class="decrement" rel="blood">-</a>
			<input type="numeric" class="input-mini centered" id="blood" />
			<a href="" class="increment" rel="blood">+</a> 
		</div>
		<div class="span2 well centered">
			<a href="" class="increment" rel="coin">
				<img src="/assets/home/img/elements/coin.png">
			</a>
			<br/>
			Coin<br/>
			<a href="" class="decrement" rel="coin">-</a>
			<input type="numeric" class="input-mini centered" id="coin" />
			<a href="" class="increment" rel="coin">+</a> 
		</div>
	</div>
</div>


<script type="text/javascript">

Cauldron = {
    
    increment : function(clicked){
    	element = $('#'+$(this).attr('rel'));

    	value = parseInt(element.val());
    	if (!value){
    		value = 0;
    	}

    	newvalue = value + 1;
    	if(newvalue < 0){
    		newvalue = 0;
    	}
    	element.val(newvalue);

    	return false;
    },
    
    decrement : function(clicked){
    	element = $('#'+$(this).attr('rel'));

    	value = parseInt(element.val());
    	if (!value){
    		value = 0;
    	}

    	newvalue = value - 1;
    	if(newvalue < 0){
    		newvalue = 0;
    	}
    	element.val(newvalue);

    	return false;
    },
    
    add_init : function(){
        $(".decrement").click(Cauldron.decrement);
        $(".increment").click(Cauldron.increment);
        
        
    }    
}
    
$(document).ready(Cauldron.add_init)
</script>

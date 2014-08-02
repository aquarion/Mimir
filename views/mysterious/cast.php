<?PHP
use \Michelf\Markdown;
?><div class="container-fluid">
    <div class="row-fluid">
    <div class="span5">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span7">
        <h1 class="pull-right">Greater Mysteries</h1>
    </div>
    </div>
  <div class="row-fluid">
    <div class="span10 offset1">

      <h1 class="pull-center">Casting "<?PHP echo $mystery->name ?>"</h1>
      <p><?PHP echo Markdown::defaultTransform($mystery->short_desc); ?></p>

      <table class="table">
        <tr>
          <th>Drachma</th>
          <th>Earth</th>
          <th>Air</th>
          <th>Fire</th>
          <th>Water</th>
          <th>Blood</th>
        </tr>
        <tr>
          <td><?PHP echo $mystery->drachma ?></td>
          <td><?PHP echo $mystery->quin_earth ?></td>
          <td><?PHP echo $mystery->quin_air ?></td>
          <td><?PHP echo $mystery->quin_fire ?></td>
          <td><?PHP echo $mystery->quin_water ?></td>
          <td><?PHP echo $mystery->blood ?></td>
        </tr>
      </table>
      <?PHP if($mystery->extra_requirements){ ?>
        <p><?PHP echo Markdown::defaultTransform($mystery->extra_requirements); ?></p>
      <?PHP } ?>


      <h2>Effect</h2>
        <div class="effect_fade"><?PHP echo Markdown::defaultTransform($mystery->effect); ?>
        <div class="show-full"><a href="#">Show Full Effect</a></div>
        <div class="hide-full"><a href="#">Hide Full Effect</a></div>
        </div>


      <p>This mystery can only be cast at an event under the sign of <b><?PHP echo $mystery->sign_requirement ?></b></p>

      <?PHP if($mystery->enhancements){ ?>
        <h3>Enhancements</h3>
        <p><?PHP echo Markdown::defaultTransform($mystery->enhancements); ?></p>
      <?PHP } ?>

      <hr/>

      <h1>Casting Details</h1>


  <div class="row-fluid">
    <div class="span10 offset1">        
        <form class="form-horizontal" action="<?PHP echo '/mysterious/cast/'.$mystery->id  ?>" method="POST">
        <input type="hidden" name="posted" value="true">
        <div class="control-group">
          <label class="control-label" for="wmd-input-casters">Casters</label>
          <div class="controls">
            <div id="wmd-button-bar-casters"></div>
            <textarea class="input-block-level" rows="10" name="casters" id="wmd-input-casters"></textarea>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="wmd-input-extras_and_targets">Extras &amp; Targets</label>
          <div class="controls">
            <div id="wmd-button-bar-extras_and_targets"></div>
            <textarea class="input-block-level" rows="10" name="extras_and_targets" id="wmd-input-extras_and_targets"></textarea>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="wmd-input-notes">Notes</label>
          <div class="controls">
            <div id="wmd-button-bar-notes"></div>
            <textarea class="input-block-level" rows="10" name="notes" id="wmd-input-notes"></textarea>
          </div>
        </div>

            
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">Make it so.</button>
          </div>
        </div>
      </form>
    </div>
    </div>
  </div>
</div>


<script type="text/javascript">


jQuery.fn.animateAuto = function(prop, speed, callback){
    var elem, height, width;
    return this.each(function(i, el){
        el = jQuery(el), elem = el.clone().css({"height":"auto","width":"auto"}).appendTo("body");
        height = elem.css("height"),
        width = elem.css("width"),
        elem.remove();
        
        if(prop === "height")
            el.animate({"height":height}, speed, callback);
        else if(prop === "width")
            el.animate({"width":width}, speed, callback);  
        else if(prop === "both")
            el.animate({"width":width,"height":height}, speed, callback);
    });  
}


$(document).ready(function(){

  $('.effect_fade .show-full a').click(function(){
    $('.effect_fade .show-full').fadeOut(500, function(){
      $('.effect_fade .hide-full').fadeIn(500);
    });
    $('.effect_fade').animateAuto("height", 1000); 
    return false;
  });

  $('.effect_fade .hide-full a').click(function(){
    $('.effect_fade .hide-full').fadeOut(500,function(){
      $('.effect_fade .show-full').fadeIn(500);
    });
    $('.effect_fade').animate({ height: "30px" } , 1000); 
    return false;
  });
  
});
</script>
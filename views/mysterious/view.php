<?PHP
use \Michelf\Markdown;
?><div class="container-fluid">
  <div class="row-fluid">
      <div class="span6">
          <?PHP include("navigation.php"); ?>
      </div>
      <div class="span6">
          <h1 class="pull-right">Greater Mysteries</h1>
      </div>
  </div>
  <div class="row-fluid">
    <div class="span10 offset1">

      <h1 class="pull-center"><?PHP echo $mystery->name ?> 

      <div class="btn-group">
      <a href="/mysterious/edit/<?PHP echo $mystery->id ?>" class="btn"><i class="icon-edit"></i> Edit</a>
      <a href="/mysterious/printpdf/<?PHP echo $mystery->id ?>" class="btn"><i class="icon-print"></i> Print</a>
      <a href="/mysterious/cast/<?PHP echo $mystery->id ?>" class="btn"><i class="icon-star"></i> Cast</a>
      </div>
      </h1>
      <p><?PHP echo Markdown::defaultTransform($mystery->short_desc); ?></p>
     
      <blockquote><?PHP echo Markdown::defaultTransform($mystery->flavour); ?></blockquote>

      <h2>Casting</h2>
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
        <div class="effect_fade">
          <?PHP echo Markdown::defaultTransform($mystery->effect); ?>
          <div class="show-full"><a href="#">Show Full Effect</a></div>
          <div class="hide-full"><a href="#">Hide Full Effect</a></div>
        </div>


      <p>This mystery can only be cast at an event under the sign of <b><?PHP echo $mystery->sign_requirement ?></b></p>

      <?PHP if($mystery->enhancements){ ?>
        <h3>Enhancements</h3>
        <p><?PHP echo Markdown::defaultTransform($mystery->enhancements); ?></p>
      <?PHP } ?>

      <?PHP if($cast){ ?>
        <h1><a name="cast"></a>Casting Details</h1>
        <?PHP foreach($cast as $casting) {?>
          <h3>Casters</h3>
          <p><?PHP echo Markdown::defaultTransform($casting->casters); ?></p>
          <h3>Extras &amp; Targets</h3>
          <p><?PHP echo Markdown::defaultTransform($casting->extras_and_targets); ?></p>
          <h3>Notes</h3>
          <p><?PHP echo Markdown::defaultTransform($casting->notes); ?></p>
        <hr/>

        <?PHP
      }
      } ?>

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
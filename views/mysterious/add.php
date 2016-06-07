<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span6">
        <?PHP if($mystery->id){ ?>
          <h1 class="pull-right">Edit Greater Mystery</h1>
        <?PHP } else { ?>
          <h1 class="pull-right">Add New Greater Mystery</h1>
        <?PHP } ?>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span10 offset1">        
        <form class="form-horizontal" action="<?PHP echo $mystery->id ? '/mysterious/edit/'.$mystery->id : '/mysterious/add'; ?>" method="POST">
            
            <?PHP if(isset($errors)){
               echo '<div class="alert alert-error">';
               foreach($errors as $index => $error){
                   echo "<li>".$error."</li>";
               }
               echo '</div>';
             } ?>
            <h2>Mystery Information</h2>
        <div class="control-group">

        <?PHP if($mystery->id){ ?>
                <input name="id" type="hidden" value="<?PHP echo $mystery->id ?>">
        <?PHP } ?>
        <div class="control-group">
          <label class="control-label" for="inputName">Name</label>
          <div class="controls">
            <input type="text" id="inputName" placeholder="Name" name="name" value="<?PHP echo $mystery->name ?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputDesc">Short Description</label>
          <div class="controls">
            <input type="text" id="inputDesc" placeholder="Description" name="short_desc"  class="input-xxlarge" value="<?PHP echo $mystery->short_desc ?>">
          </div>
        </div>
          
        <div class="control-group">
          <label class="control-label" for="wmd-input-flavour">Flavour Text</label>
          <div class="controls">
            <div id="wmd-button-bar-flavour"></div>
            <textarea class="input-block-level" rows="3" id="wmd-input-flavour" name="flavour"><?PHP echo $mystery->flavour ?></textarea>
          </div>
        </div>

        <label class="control-label" for="inputType">Mystery Type</label>
        <div class="controls">
            <select name="mystery_type">
                <?PHP
                $type_options = array(
                    'Greater Mystery',
                    'Paramount Mystery',
                    'Zodiac Mystery',
                    'Special'
                );
                $selected = 'selected="selected"';
                foreach($type_options as $option){
                    printf('<option %s>%s</option>', $mystery->mystery_type == $option ? $selected : '', $option);
                }
                ?>
            </select>
            (Using "Special" requires a conversation.)
        </div>
      </div>        

        <label class="control-label" for="inputType">Effect Type</label>
        <div class="controls">
            <select name="effect_type">
                <?PHP
                $type_options = array(
                  'Add champions',
                  'Arena',
                  'Buff',
                  'Buff Characters',
                  'Buff Warband',
                  'Buff, Tribute de-buff',
                  'Challenge buff',
                  'Curse',
                  'Divination',
                  'Healing',
                  'Metamagic',
                  'Natural Disaster',
                  'Philosopher Buff',
                  'Plot',
                  'Power Up',
                  'Quest buff',
                  'Quest Buff',
                  'Route Creator',
                  'Route Destroyer',
                  'Route Disruptor',
                  'Route Mover',
                  'Special',
                  'Summons',
                  'Transmute',
                  'Tribute Effector',
                  'Tribute Stealer',
                  'Warleader Buff',
                  'World Forge',
                  'Other'
                );
                $selected = 'selected="selected"';
                foreach($type_options as $option){
                    printf('<option %s>%s</option>', $mystery->effect_type == $option ? $selected : '', $option);
                }
                ?>
            </select>
        </div>

            
      <h2>Casting</h2>
        
        <div class="control-group">
          <label class="control-label" for="inputDrachma">Drachma</label>
          <div class="controls">
            <div class="input-prepend">
                <span class="add-on kudos"><img src="/assets/home/img/fatcow-icons/coin_stack_gold.png"></span>
                <input type="number" class="input-mini kudossrc" data-value="1" id="drachma" placeholder="Drachma" name="drachma" min="0" value="<?PHP echo $mystery->drachma ?>">
            </div>
            
            
            
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputDrachma">Quintessence</label>
          <div class="controls">
            
            <div class="input-prepend">
            <span class="add-on kudos"><img src="/assets/home/img/elements/icons/earth_element-25.png" ></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="earth" placeholder="Earth" name="quin_earth" min="0" value="<?PHP echo $mystery->quin_earth ?>">
            </div>
            <div class="input-prepend">
            <span class="add-on kudos"><img src="/assets/home/img/elements/icons/air_element-25.png" ></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="air" placeholder="Air" name="quin_air" min="0" value="<?PHP echo $mystery->quin_air ?>">
            </div>
            <div class="input-prepend">
            <span class="add-on kudos"><img src="/assets/home/img/elements/icons/fire_element-25.png" ></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="fire" placeholder="Fire" name="quin_fire" min="0" value="<?PHP echo $mystery->quin_fire ?>">
            </div>
            <div class="input-prepend">
            <span class="add-on kudos"><img src="/assets/home/img/elements/icons/water_element-25.png" ></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="water" placeholder="Water" name="quin_water" min="0" value="<?PHP echo $mystery->quin_water ?>">
            </div>
            
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputBlood">Blood</label>
          <div class="controls">
              
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/fatcow-icons/heart.png"></span>
            <input type="number" class="input-mini" id="lives" data-value="10" placeholder="<3" name="blood" value="<?PHP echo $mystery->blood ?>">
            </div>
          </div>
        </div>
                
                
        <div class="control-group">
          <label class="control-label" for="wmd-input-requirements">Extra Requirements</label>
          <div class="controls">
            <div id="wmd-button-bar-requirements"></div>
            <textarea class="input-block-level input-xxlarge wmd-input" rows="10" name="extra_requirements" id="wmd-input-requirements"><?PHP echo $mystery->extra_requirements ?></textarea>
          </div>
        </div>
      
        <div class="control-group">
          <label class="control-label" for="inputSign">Sign Requirement</label>
          <div class="controls">
              <select name="sign_requirement">
                  <?PHP
                  $type_options = array();
                  $events = Event::events();
                  foreach($events as $event){
                    $type_options[$event['sign']] = $event['sign'];
                  }
                  $type_options[] = "Special";
                  $selected = 'selected="selected"';


                  foreach($type_options as $option){
                      printf('<option %s>%s</option>', $mystery->sign_requirement == $option ? $selected : '', $option);
                  }
                  ?>
              </select>
          </div>
        </div>

      <h2>Effects</h2>

        <div class="control-group">
          <label class="control-label" for="wmd-input-effects">Roleplay &amp; Effects</label>
          <div class="controls">
            <div id="wmd-button-bar-effects"></div>
            <textarea class="input-block-level" rows="10" name="effect" id="wmd-input-effects"><?PHP echo $mystery->effect ?></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="wmd-input-enhancements">Enhancements</label>
          <div class="controls">
            <div id="wmd-button-bar-enhancements"></div>
            <textarea class="input-block-level" rows="10" name="enhancements" id="wmd-input-enhancements"><?PHP echo $mystery->enhancements ?></textarea>
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
<script type="text/javascript">

Altar = {
    
    
    searchByPriestName : function(query, process){
        console.log(query);
        console.log(process);
    },
    
    searchByPid : function(query, process){
        console.log(query);
        console.log(process);
        return $.get('/typeahead', { pid: query }, function (data) {
            return process(data.options);
        });
    },
    
    
    add_init : function(){
        
        $("#inputPID").typeahead(Altar.searchByPid);
        $("#inputCharacter").typeahead({source : Altar.searchByPriestName});
        
    }    
}
    
$(document).ready(Altar.add_init)
</script>

<script type="text/javascript">
$(document).ready(function(){

  var converter1 = Markdown.getSanitizingConverter();
  var flavour_markdown = new Markdown.Editor(converter1, "-flavour");
  flavour_markdown.run();

  var requirements_markdown = new Markdown.Editor(converter1, "-requirements");
  requirements_markdown.run();

  var effects_markdown = new Markdown.Editor(converter1, "-effects");
  effects_markdown.run();

  var enhancements_markdown = new Markdown.Editor(converter1, "-enhancements");
  enhancements_markdown.run();
  
});
</script>
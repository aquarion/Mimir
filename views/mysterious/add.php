<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Add New Greater Mystery</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span10 offset1">        
        <form class="form-horizontal" action="add" method="POST">
            
            <?PHP if(isset($errors)){
               echo '<div class="alert alert-error">';
               foreach($errors as $index => $error){
                   echo "<li>".$error."</li>";
               }
               echo '</div>';
             } ?>
            <h2>Mystery Information</h2>
        <div class="control-group">


    
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
          <label class="control-label" for="inputFlavour">Flavour Text</label>
          <div class="controls">
            <textarea class="input-block-level" rows="3" id="inputFlavour" name="flavour"><?PHP echo $mystery->flavour ?></textarea>
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
            <span class="add-on kudos"><img src="/assets/home/img/elements/Green.png" width="16"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="earth" placeholder="Earth" name="quin_earth" min="0" value="<?PHP echo $mystery->quin_earth ?>">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/White.png" width="16"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="air" placeholder="Air" name="quin_air" min="0" value="<?PHP echo $mystery->quin_air ?>">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/Red.png" width="16"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="fire" placeholder="Fire" name="quin_fire" min="0" value="<?PHP echo $mystery->quin_fire ?>">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/Blue.png" width="16"></span>
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
          <label class="control-label" for="inputExtra">Extra Requirements</label>
          <div class="controls">
            <textarea class="input-block-level" rows="3" name="extra_requirements"><?PHP echo $mystery->notes ?></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="inputNotes">Roleplay &amp; Effects</label>
          <div class="controls">
            <textarea class="input-block-level" rows="3" name="effect"><?PHP echo $mystery->effect ?></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="inputNotes">Enhancements</label>
          <div class="controls">
            <textarea class="input-block-level" rows="3" name="effect"><?PHP echo $mystery->enhancements ?></textarea>
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
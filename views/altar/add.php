<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Add New Sacrifice</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2">
       
    </div>
    <div class="span10">        
        <form class="form-horizontal" action="add" method="POST">
            <h2>About the Sacrificer</h2>
        <div class="control-group">
          <label class="control-label" for="inputType">Type</label>
          <div class="controls">
              <select name="sacrifice_type">
                  <option>Sacrifice</option>
                  <option>Human Sacrifice</option>
                  <option>Funeral</option>
                  <option>Arena</option>
                  <option>God Audience</option>
                  <option>Other</option>
              </select>
          </div>
        </div>        
    
        <div class="control-group">
          <label class="control-label" for="inputPriest">Priest</label>
          <div class="controls">
            <input type="number" class="input-mini" id="inputPID" name="priest_id" placeholder="PID" length="4" min="0">
            <input type="text" id="inputCharacter" placeholder="Character" name="priest_name">
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputGroup" >Group/Nation</label>
          <div class="controls">
            <input type="text" id="inputGroup" class="input-small" placeholder="Group" name="group_name">

            <select name="nation" id="inputNation">
            <?PHP
            $options = Nation::options();
            $selected = 'selected="Selected"';
            $template = '<option value="%s" %s>%s</option>';
            foreach($options as $index => $value){
                $sel = $index === false ? $selected : '';
                printf($template, $index, $sel, $value);
            }
            ?>
            </select>
            
          </div>
        </div>
            
            <h2>About the Sacrifice Target</h2>
            
            
        <div class="control-group">
          <label class="control-label" for="inputDeity" name="deity">Deity</label>
          <div class="controls">
            <input type="text" id="inputDeity" placeholder="Deity" name="deity"
            data-source='["CARTHAGE: Astarte", "CARTHAGE: Athtar", "CARTHAGE: Baal", "CARTHAGE: Dagon", "CARTHAGE: DEATH MESSENGER – Mot", "CARTHAGE: El", "CARTHAGE: Eshmun", "CARTHAGE: Kothar-na-Khasis", "CARTHAGE: Melqart", "CARTHAGE: Adonis", "CARTHAGE: OTHER (specify in Comments)", "CARTHAGE: Shapash", "CARTHAGE: Tanit", "CARTHAGE: Yam", "EGYPT: Anubis", "EGYPT: Apep", "EGYPT: Bast", "EGYPT: DEATH MESSENGER – Aken", "EGYPT: Geb", "EGYPT: Horus", "EGYPT: Isis", "EGYPT: Nephthys", "EGYPT: Nut", "EGYPT: Osiris", "EGYPT: OTHER (specify in Comments)", "EGYPT: Ra", "EGYPT: Sekhmet", "EGYPT: Shu", "EGYPT: Sutekh", "EGYPT: Tefnut", "EGYPT: Thoth", "GREECE: Aphrodite", "GREECE: Apollo", "GREECE: Ares", "GREECE: Artemis", "GREECE: DEATH MESSENGER – Charon", "GREECE: Demeter", "GREECE: Eris", "GREECE: Hades", "GREECE: Hecate", "GREECE: Hera", "GREECE: OTHER (specify in Comments)", "GREECE: Persephone", "GREECE: Poseidon", "GREECE: Zeus", "PERSIA (NEW): Aesma Daeva", "PERSIA (NEW): Ahura Mazda (Ohrmazd)", "PERSIA (NEW): Amitra", "PERSIA (NEW): Angra Mainyu (Ahriman)", "PERSIA (NEW): DEATH MESSENGER – Asto Vidatu", "PERSIA (NEW): Sraosha", "PERSIA (NEW): The Arch-Daevas", "PERSIA (NEW): The Bounteous Immortals", "PERSIA (OLD): Amitra", "PERSIA (OLD): Anu", "PERSIA (OLD): Pazuzu", "PERSIA (OLD): Lamashtu", "PERSIA (OLD): Azi Dahak", "PERSIA (OLD): DEATH MESSENGER – Namtar", "PERSIA (OLD): Enki", "PERSIA (OLD): Ereshkigal", "PERSIA (OLD): Ishtar", "PERSIA (OLD): Marduk", "PERSIA (OLD): Nergal", "PERSIA (OLD): Ninhursag", "PERSIA (OLD): Shamash", "PERSIA (OLD): Sin", "PERSIA (OLD): Tiamat", "PERSIA: OTHER (specify in Comments)", "ROME: Aeneas", "ROME: Cybele", "ROME: DEATH MESSENGER – Tiberinus", "ROME: Diana", "ROME: Janus", "ROME: Juno", "ROME: Jupiter", "ROME: Mars", "ROME: Mercury", "ROME: Metis", "ROME: Mithras", "ROME: Cardea", "ROME: Rhea Silvia", "ROME: Vulcan", "ROME: ", "ROME: Neptune", "ROME: OTHER (specify in Comments)", "ROME: Pluto", "ROME: Proserpina", "ROME: Remus", "ROME: Romulus", "ROME: Romulus & Remus", "HP: Athena Britomartis", "HP: Dionysos Devoured", "HP: Hephaestus Reforged", "HP: Molech", "HP: Atargatis", "HP: Adonis", "HP: The Bull Leaper", "HP: DEATH MESSENGER: Asterius", "HP: OTHER (specify in Comments)"]'  
            data-provide="typeahead" data-items="24">
          </div>
        </div>
            
            <h2>About the Sacrifice</h2>
        
        <div class="control-group">
          <label class="control-label" for="inputDrachma">Drachma</label>
          <div class="controls">
            <div class="input-prepend">
                <span class="add-on kudos">C</span>
            <input type="number" class="input-mini kudossrc" data-value="0.05" id="chalkoi" placeholder="halkoi" name="chalkoi" min="0">
            </div>
            <div class="input-prepend">
                <span class="add-on kudos">O</span>
                <input type="number" class="input-mini kudossrc" data-value="0.25" id="obol" placeholder="bol" name="obol" min="0">
            </div>
            <div class="input-prepend">
                <span class="add-on kudos">D</span>
                <input type="number" class="input-mini kudossrc" data-value="1" id="drachma" placeholder="rachma" name="drachma" min="0">
            </div>
            <div class="input-prepend">
                <span class="add-on kudos">P</span>
                <input type="number" class="input-mini kudossrc" data-value="5" id="pentadrachma" placeholder="entadrac" name="pentadrachma" min="0">
            </div>
            <div class="input-prepend">
                <span class="add-on kudos">M</span>
                <input type="number" class="input-mini kudossrc" data-value="20" id="Mina" placeholder="ina" name="mina" min="0">
            </div>
            
            
            
            
            
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputDrachma">Quintessence</label>
          <div class="controls">
            
            <div class="input-prepend">
            <span class="add-on kudos"><img src="/assets/home/img/elements/Green.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="earth" placeholder="Earth" name="quin_earth" min="0">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/White.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="air" placeholder="Air" name="quin_air" min="0">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/Red.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="fire" placeholder="Fire" name="quin_fire" min="0">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/Blue.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="water" placeholder="Water" name="quin_water" min="0">
            </div>
            
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputLives">Lives</label>
          <div class="controls">
              
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/fatcow-icons/heart.png"></span>
            <input type="number" class="input-mini" id="lives" data-value="10" placeholder="" name="lives">
            </div>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputLives">Life Bonus</label>
          <div class="controls">
              
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/fatcow-icons/heart_add.png"></span>
            <input type="number" class="input-mini kudossrc" data-value="1" id="life_bonus" placeholder="" name="life_bonus">
            </div>
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputArena" >Arena Bonus</label>
          <div class="controls">
              
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/announcementIcon.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="1" id="Arena" placeholder="" name="arena_bonus">
            </div>
          </div>
        </div>
            
            
        <div class="control-group">
          <label class="control-label" for="inputTotal">Total</label>
          <div class="controls">
            <input type="text" readonly="readonly" id="total" name="total">
          </div>
        </div>
                
        <div class="control-group">
          <label class="control-label" for="inputNotes">Notes</label>
          <div class="controls">
              <p>In here: Who they sacrificed, if that's important. Anything weird about any of the above. This is an OOC box, there is no prayer mechanic.</p>
            <textarea class="input-block-level" rows="3" name="notes"></textarea>
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
    
    recalculate_total : function(){
        var total = 0;
        $(".kudossrc").each(function(thing){
            thing = $(this);
            thisTotal = thing.val() * thing.attr("data-value");
            //console.log(this.id+" @ "+thing.val() +" x "+thing.attr("data-value")+" = "+thisTotal);
            total = total + thisTotal;
        });
        $('#total').val(total);
    },
    
    recalculate_life_bonus : function(){
        lives = $('#lives').val();
        value = $('#lives').attr("data-value");
        $('#life_bonus').val(lives*value);
        Altar.recalculate_total();
    },
    
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
        $(".kudossrc").change(Altar.recalculate_total);
        $("#lives").change(Altar.recalculate_life_bonus);
        
        console.log("Hello");
        //$("#inputPID").typeahead({source : Altar.searchByPid});
        $("#inputPID").typeahead(Altar.searchByPid);
        $("#inputCharacter").typeahead({source : Altar.searchByPriestName});
        
    }    
}
    
$(document).ready(Altar.add_init)
</script>
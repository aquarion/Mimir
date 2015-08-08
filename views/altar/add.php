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
    <div class="span10 offset1">        
        <form class="form-horizontal" action="add" method="POST">
            
            <?PHP if(isset($errors)){
               echo '<div class="alert alert-error">';
               foreach($errors as $index => $error){
                   echo "<li>".$error."</li>";
               }
               echo '</div>';
             } ?>
            <h2>About the Sacrificer</h2>
        <div class="control-group">
          <label class="control-label" for="inputType">Type</label>
          <div class="controls">
              <select name="sacrifice_type">
                  <?PHP
                  $type_options = array(
                      'Sacrifice',
                      'Human Sacrifice',
                      'Funeral',
                      'Arena',
                      'God Audience',
                      'Other'
                  );
                  $selected = 'selected="selected"';
                  foreach($type_options as $option){
                      printf('<option %s>%s</option>', $kudo->sacrifice_type == $option ? $selected : '', $option);
                  }
                  ?>
              </select>
          </div>
        </div>        
    
        <div class="control-group">
          <label class="control-label" for="inputPriest">Priest</label>
          <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-search"></i></span>
            <input type="search" id="inputSearch" placeholder="Search"> 
          </div> (If the wrong character keeps appearing, check previous characters are marked dead, then get Aq to regenerate the search)<br/>
            
            <input type="number" class="input-mini" id="inputPID" name="priest_id" placeholder="PID" length="4" min="0" value="<?PHP echo $kudo->priest_id ?>">
            <input type="text" id="inputCharacter" placeholder="Character" name="priest_name" value="<?PHP echo $kudo->priest_name ?>">
            <div id="priestWarning" class="alert alert-warning hidden" style="margin-top: 5px">Warning: That's not a priest</div>
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputGroup" >Group/Nation</label>
          <div class="controls">
            <input type="text" id="inputGroup" class="input-small" placeholder="Group" name="group_name" value="<?PHP echo $kudo->group_name ?>">

            <select name="nation" id="inputNation">
            <?PHP
            $options = Nation::options();
            $selected = 'selected="Selected"';
            $template = '<option value="%s" %s>%s</option>';
            foreach($options as $index => $value){
                $sel = $index === $kudo->nation ? $selected : '';
                printf($template, $index, $sel, $value);
            }
            ?>
            </select>
            
          </div>
        </div>

        <div class="row-fluid">
          <div class="span12 ">
              <ul class="">
                  <li class=" centered span2" >
                          <img src="/assets/home/img/nations/smaller/carthage.png" />
                          <div class="caption">Carthage</div >
                  </li>
                  <li class=" centered span2">
                          <img src="/assets/home/img/nations/smaller/egypt.png" />
                          <div class="caption">Egypt</div >
                  </li>
                  <li class=" centered span2">
                          <img src="/assets/home/img/nations/smaller/greece.png" />
                          <div class="caption">Greece</div >
                  </li>
                  <li class=" centered span2">
                          <img src="/assets/home/img/nations/smaller/hellasphoenicia.png" />
                          <div class="caption">Hellas Phoenicia</div >
                  </li>
                  <li class=" centered span2">
                          <img src="/assets/home/img/nations/smaller/persia.png" />
                          <div class="caption">Persia</div >
                  </li>
                  <li class=" centered span2">
                          <img src="/assets/home/img/nations/smaller/rome.png" />
                          <div class="caption">Rome</div >
                  </li>
              </ul>
          </div>
        </div>
            
        <h2>About the Sacrifice Target</h2>
            
            
        <div class="control-group">
          <label class="control-label" for="inputDeity" name="deity">Deity</label>
          <div class="controls">
            <input type="text" id="inputDeity" placeholder="Deity" name="deity" value="<?PHP echo $kudo->deity ?>"
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
            <input type="number" class="input-mini kudossrc" data-value="0.05" id="chalkoi" placeholder="halkoi" name="chalkoi" min="0" value="<?PHP echo $kudo->chalkoi ?>">
            </div>
            <div class="input-prepend">
                <span class="add-on kudos">O</span>
                <input type="number" class="input-mini kudossrc" data-value="0.25" id="obol" placeholder="bol" name="obol" min="0" value="<?PHP echo $kudo->obol ?>">
            </div>
            <div class="input-prepend">
                <span class="add-on kudos">D</span>
                <input type="number" class="input-mini kudossrc" data-value="1" id="drachma" placeholder="rachma" name="drachma" min="0" value="<?PHP echo $kudo->drachma ?>">
            </div>
            <div class="input-prepend">
                <span class="add-on kudos">P</span>
                <input type="number" class="input-mini kudossrc" data-value="5" id="pentadrachma" placeholder="entadrac" name="pentadrachma" min="0" value="<?PHP echo $kudo->pentadrachma ?>">
            </div>
            <div class="input-prepend">
                <span class="add-on kudos">M</span>
                <input type="number" class="input-mini kudossrc" data-value="20" id="Mina" placeholder="ina" name="mina" min="0" value="<?PHP echo $kudo->mina ?>">
            </div>
            
            
            
            
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputDrachma">Quintessence</label>
          <div class="controls">
            
            <div class="input-prepend">
            <span class="add-on kudos"><img src="/assets/home/img/elements/Green.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="earth" placeholder="Earth" name="quin_earth" min="0" value="<?PHP echo $kudo->quin_earth ?>">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/White.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="air" placeholder="Air" name="quin_air" min="0" value="<?PHP echo $kudo->quin_air ?>">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/Red.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="fire" placeholder="Fire" name="quin_fire" min="0" value="<?PHP echo $kudo->quin_fire ?>">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/Blue.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="5" id="water" placeholder="Water" name="quin_water" min="0" value="<?PHP echo $kudo->quin_water ?>">
            </div>
            
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputLives">Lives</label>
          <div class="controls">
              
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/fatcow-icons/heart.png"></span>
            <input type="number" class="input-mini" id="lives" data-value="10" placeholder="<3" name="lives" value="<?PHP echo $kudo->lives ?>">
            </div>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputLives" placeholder="<3 $">Life Bonus</label>
          <div class="controls">
              
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/fatcow-icons/heart_add.png"></span>
            <input type="number" class="input-mini kudossrc" data-value="1" id="life_bonus" placeholder="" name="life_bonus" value="<?PHP echo $kudo->life_bonus ?>">
            </div>
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputArena" >Arena Bonus</label>
          <div class="controls">
              
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/announcementIcon.png" width="22px"></span>
            <input type="number" class="input-mini kudossrc" data-value="1" id="Arena" placeholder="" name="arena_bonus" value="<?PHP echo $kudo->arena_bonus ?>">
            </div>
          </div>
        </div>
            
            
        <div class="control-group">
          <label class="control-label" for="inputTotal">Total</label>
          <div class="controls">
            <input type="text" readonly="readonly" id="total" name="total" value="<?PHP echo $kudo->total ?>">
          </div>
        </div>


        <div class="control-group">
          <label class="control-label" for="inputChamp">On Behalf of Champion</label>
          <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-search"></i></span>
            <input type="search" id="inputChampionSearch" placeholder="Search">
          </div><br/>
            <input type="number" class="input-mini" id="inputChampPID" name="champion_id" placeholder="PID" length="4" min="0" value="<?PHP echo '' ?>">
            <input type="text" id="inputChamption" placeholder="Champion" name="champion_name" value="<?PHP echo '' ?>">
            <div id="champWarning" class="alert alert-error hidden" style="margin-top: 5px">Warning: That's not a champion</div>
          </div>
        </div>
                
        <div class="control-group">
          <label class="control-label" for="inputNotes">Notes</label>
          <div class="controls">
              <p>In here: Who they sacrificed, if that's important. Anything weird about any of the above. This is an OOC box, there is no prayer mechanic.</p>
            <textarea class="input-block-level" rows="3" name="notes"><?PHP echo $kudo->notes ?></textarea>
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
    
$(document).ready(Altar.add_init)
</script>
<style type="text/css">
.panel {
  border: 1px solid #EEE;
  border-radius: 7px;
  padding: 1em;
}
</style>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Add New Blessing</h1>
    </div>
  </div>

  <div class="row-fluid">
    <div class="span10 offset1">
        <form class="form-horizontal" action="create" method="POST">

            <?PHP if(isset($errors)){
               echo '<div class="alert alert-error">';
               foreach($errors as $index => $error){
                   echo "<li>".$error."</li>";
               }
               echo '</div>';
             } 

             if ($blessing->id){
              ?><input type="hidden" name="id" value="<?PHP echo $blessing->id ?>"><?PHP
             }
             ?>

        <div class="control-group">
          <label class="control-label" for="inputTarget">Blessing Author</label>
          <div class="controls">
            <input type="text" id="inputAuthor" placeholder="Crew Member" name="author" value="<?PHP echo $blessing->author ?>">
          </div>
        </div>


            <h2>About the Target</h2>

        <div class="control-group">
          <label class="control-label" for="inputTarget">Target</label>
          <div class="controls">
            <input type="number" class="input-mini" id="inputPID" name="target_id" placeholder="PID" length="4" min="0" value="<?PHP echo $blessing->target_id ?>">
            <input type="text" id="inputCharacter" placeholder="Character" name="target_name" value="<?PHP echo $blessing->target_name ?>">
          </div>
        </div>

        <div class="control-group">
        <label class="control-label" for="inputType">Type</label>
        <div class="controls">
          <select name="blessing_type">
              <?PHP
              $type_options = array(
                  'Arena/Quest',
                  'Class Skills',
                  'Special Creature',
                  'Story Effect',
                  'Other'
              );
              $selected = 'selected="selected"';
              foreach($type_options as $option){
                  printf('<option %s>%s</option>', $blessing->blessing_type == $option ? $selected : '', $option);
              }
              ?>
          </select>
        </div>

        <div class="control-group">
        <label class="control-label" for="inputType">Reason</label>
        <div class="controls">
          <select name="reason">
              <?PHP
              $type_options = array(
                  'Kudos',
                  'Renown',
                  'Whim',
                  'Vengence',
                  'Caprice',
                  'Other'
              );
              $selected = 'selected="selected"';
              foreach($type_options as $option){
                  printf('<option %s>%s</option>', $blessing->reason == $option ? $selected : '', $option);
              }
              ?>
          </select>
        </div>

        <div class="control-group">
        <label class="control-label" for="inputType">Duration</label>
        <div class="controls">
          <select name="duration">
              <?PHP
              $type_options = array(
                  'Until next Sunrise or Sunset (Soonist)',
                  'Until next Sunrise or Sunset (Latest)',
                  'End of the Annual',
                  'Next Arena Battle or Quest this Annual',
                  'Any Arena Battle or Quest this Annual',
                  'Until the stars go out',
                  'Until Revoked',
                  'Other'
              );
              $selected = 'selected="selected"';
              foreach($type_options as $option){
                  printf('<option %s>%s</option>', $blessing->duration == $option ? $selected : '', $option);
              }
              ?>
          </select>
        </div>

        <h2>What have you done to me?</h2>


        <div class="control-group">
          <label class="control-label" for="inputNotes">IC Description</label>
          <div class="controls">
              <textarea class="input-block-level" rows="3" name="description"><?PHP echo $blessing->description ?></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="inputNotes">Game Effects</label>
          <div class="controls">
              <textarea class="input-block-level" rows="3" name="effect"><?PHP echo $blessing->effect ?></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="inputDeity">From</label>

          <div class="controls">
            <select name="from_type">
                <?PHP
                $type_options = array(
                    'Deific',
                    'Titanic',
                    'Philosophic',
                    'Unknown',
                    'Other'
                );
                $selected = 'selected="selected"';
                foreach($type_options as $option){
                    printf('<option %s>%s</option>', $blessing->from_type == $option ? $selected : '', $option);
                }
                ?>
            </select>

            <input type="text" id="inputDeity" placeholder="Issuer" name="issuer" value="<?PHP echo $blessing->issuer ?>"
            data-source='["CARTHAGE: Astarte", "CARTHAGE: Athtar", "CARTHAGE: Baal", "CARTHAGE: Dagon", "CARTHAGE: DEATH MESSENGER – Mot", "CARTHAGE: El", "CARTHAGE: Eshmun", "CARTHAGE: Kothar-na-Khasis", "CARTHAGE: Melqart", "CARTHAGE: Adonis", "CARTHAGE: OTHER (specify in Comments)", "CARTHAGE: Shapash", "CARTHAGE: Tanit", "CARTHAGE: Yam", "EGYPT: Anubis", "EGYPT: Apep", "EGYPT: Bast", "EGYPT: DEATH MESSENGER – Aken", "EGYPT: Geb", "EGYPT: Horus", "EGYPT: Isis", "EGYPT: Nephthys", "EGYPT: Nut", "EGYPT: Osiris", "EGYPT: OTHER (specify in Comments)", "EGYPT: Ra", "EGYPT: Sekhmet", "EGYPT: Shu", "EGYPT: Sutekh", "EGYPT: Tefnut", "EGYPT: Thoth", "GREECE: Aphrodite", "GREECE: Apollo", "GREECE: Ares", "GREECE: Artemis", "GREECE: DEATH MESSENGER – Charon", "GREECE: Demeter", "GREECE: Eris", "GREECE: Hades", "GREECE: Hecate", "GREECE: Hera", "GREECE: OTHER (specify in Comments)", "GREECE: Persephone", "GREECE: Poseidon", "GREECE: Zeus", "PERSIA (NEW): Aesma Daeva", "PERSIA (NEW): Ahura Mazda (Ohrmazd)", "PERSIA (NEW): Amitra", "PERSIA (NEW): Angra Mainyu (Ahriman)", "PERSIA (NEW): DEATH MESSENGER – Asto Vidatu", "PERSIA (NEW): Sraosha", "PERSIA (NEW): The Arch-Daevas", "PERSIA (NEW): The Bounteous Immortals", "PERSIA (OLD): Amitra", "PERSIA (OLD): Anu", "PERSIA (OLD): Pazuzu", "PERSIA (OLD): Lamashtu", "PERSIA (OLD): Azi Dahak", "PERSIA (OLD): DEATH MESSENGER – Namtar", "PERSIA (OLD): Enki", "PERSIA (OLD): Ereshkigal", "PERSIA (OLD): Ishtar", "PERSIA (OLD): Marduk", "PERSIA (OLD): Nergal", "PERSIA (OLD): Ninhursag", "PERSIA (OLD): Shamash", "PERSIA (OLD): Sin", "PERSIA (OLD): Tiamat", "PERSIA: OTHER (specify in Comments)", "ROME: Aeneas", "ROME: Cybele", "ROME: DEATH MESSENGER – Tiberinus", "ROME: Diana", "ROME: Janus", "ROME: Juno", "ROME: Jupiter", "ROME: Mars", "ROME: Mercury", "ROME: Metis", "ROME: Mithras", "ROME: Cardea", "ROME: Rhea Silvia", "ROME: Vulcan", "ROME: ", "ROME: Neptune", "ROME: OTHER (specify in Comments)", "ROME: Pluto", "ROME: Proserpina", "ROME: Remus", "ROME: Romulus", "ROME: Romulus & Remus", "HP: Athena Britomartis", "HP: Dionysos Devoured", "HP: Hephaestus Reforged", "HP: Molech", "HP: Atargatis", "HP: Adonis", "HP: The Bull Leaper", "HP: DEATH MESSENGER: Asterius", "HP: OTHER (specify in Comments)"]'
            data-provide="typeahead" data-items="24">
          </div>
        </div>

        <h2>Tokens</h2>
        <p>Tokens for the "blessed" to give out (Count must be > 1, Target isn't required. Effect kind of is)</p>
      </div>
    </div>

        <div class="row-fluid">
          <div class="span3 panel panel-default">
            Count:  <input    name= "token_count[1]" value="<?PHP echo $blessing->token(1,'count') ?>"  type="number" /><br/>
            Target: <input    name="token_target[1]" value="<?PHP echo $blessing->token(1,'target') ?>" type="text" placeholder="eg. Name [PID], or 'Persian Champion'"/><br/>
            Effect: <textarea name="token_effect[1]"       ><?PHP echo $blessing->token(1,'effect') ?></textarea>
          </div>

          <div class="span3 panel panel-default">
            Count:  <input    name= "token_count[2]" value="<?PHP echo $blessing->token(2,'count') ?>"  type="number" /><br/>
            Target: <input    name="token_target[2]" value="<?PHP echo $blessing->token(2,'target') ?>" type="text" placeholder="eg. Name [PID], or 'Persian Champion'"/><br/>
            Effect: <textarea name="token_effect[2]"       ><?PHP echo $blessing->token(2,'effect') ?></textarea>
          </div>

          <div class="span3 panel panel-default">
            Count:  <input    name= "token_count[3]" value="<?PHP echo $blessing->token(3,'count') ?>"  type="number" /><br/>
            Target: <input    name="token_target[3]" value="<?PHP echo $blessing->token(3,'target') ?>" type="text" placeholder="eg. Name [PID], or 'Persian Champion'"/><br/>
            Effect: <textarea name="token_effect[3]"       ><?PHP echo $blessing->token(3,'effect') ?></textarea>
          </div>

          <div class="span3 panel panel-default">
            Count:  <input    name= "token_count[4]" value="<?PHP echo $blessing->token(4,'count') ?>"  type="number" /><br/>
            Target: <input    name="token_target[4]" value="<?PHP echo $blessing->token(4,'target') ?>" type="text" placeholder="eg. Name [PID], or 'Persian Champion'"/><br/>
            Effect: <textarea name="token_effect[4]"       ><?PHP echo $blessing->token(4,'effect') ?></textarea>
          </div>
        </div>


      <div class="row-fluid">
      <div class="span10">

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

        //$("#inputPID").typeahead({source : Altar.searchByPid});
        $("#inputPID").typeahead(Altar.searchByPid);
        $("#inputCharacter").typeahead({source : Altar.searchByPriestName});

    }
}

$(document).ready(Altar.add_init)
</script>
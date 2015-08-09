<style type="text/css">
.panel {
  border: 1px solid #EEE;
  border-radius: 7px;
  padding: 1em;
}
</style>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span6">
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
            <div class="input-prepend">
              <span class="add-on"><i class="icon-search"></i></span>
              <input type="search" id="inputSearch" placeholder="Search"> 
            </div> <br/>
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
        <label class="control-label" for="inputDuration">Duration</label>
        <div class="controls">
              <input type="text" id="inputDuration" placeholder="Duration" name="duration" value="<?PHP echo $blessing->duration ?>" autocomplete="off">
        </div>

        <h2>What have you done to me?</h2>

        <p>(Seperate paragraphs with a clear empty line, use *bold* and _italic_ )</p>
        
        <div class="control-group">
          <label class="control-label" for="inputNotes">IC Description</label>
          <div class="controls">
              <textarea class="input-block-level" rows="5" name="description"><?PHP echo $blessing->description ?></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="inputNotes">Game Effects</label>
          <div class="controls">
              <textarea class="input-block-level" rows="5" name="effect"><?PHP echo $blessing->effect ?></textarea>
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
        <p>Tokens for the "blessed" to give out (Count must be > 1, Target isn't required. Effect kind of is). Examples for Target:
        <ul>
          <li>Persian Champions</li>
          <li>The Silenced Court</li>
          <li>1763 - Tendao of Palma</li>
        </ul>

        Start typing a character name to auto-complete from the player db.
        </p>

      </div>
    </div>

        <div class="row-fluid">
          <div class="span3 panel panel-default">
            Count:  <input    name= "token_count[1]" value="<?PHP echo $blessing->token(1,'count') ?>"  type="number" /><br/>
            Target: <input    name="token_target[1]" value="<?PHP echo $blessing->token(1,'target') ?>" type="text" class="character_search" placeholder="eg. Name [PID], or 'Persian Champion'"/><br/>
            Effect: <textarea name="token_effect[1]"       ><?PHP echo $blessing->token(1,'effect') ?></textarea>
          </div>

          <div class="span3 panel panel-default">
            Count:  <input    name= "token_count[2]" value="<?PHP echo $blessing->token(2,'count') ?>"  type="number" /><br/>
            Target: <input    name="token_target[2]" value="<?PHP echo $blessing->token(2,'target') ?>" type="text" class="character_search" placeholder="eg. Name [PID], or 'Persian Champion'"/><br/>
            Effect: <textarea name="token_effect[2]"       ><?PHP echo $blessing->token(2,'effect') ?></textarea>
          </div>

          <div class="span3 panel panel-default">
            Count:  <input    name= "token_count[3]" value="<?PHP echo $blessing->token(3,'count') ?>"  type="number" /><br/>
            Target: <input    name="token_target[3]" value="<?PHP echo $blessing->token(3,'target') ?>" type="text" class="character_search" placeholder="eg. Name [PID], or 'Persian Champion'"/><br/>
            Effect: <textarea name="token_effect[3]"       ><?PHP echo $blessing->token(3,'effect') ?></textarea>
          </div>

          <div class="span3 panel panel-default">
            Count:  <input    name= "token_count[4]" value="<?PHP echo $blessing->token(4,'count') ?>"  type="number" /><br/>
            Target: <input    name="token_target[4]" value="<?PHP echo $blessing->token(4,'target') ?>" type="text" class="character_search" placeholder="eg. Name [PID], or 'Persian Champion'"/><br/>
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

Blesser = {

    add_init : function(){

        $("textarea").keyup(function(e) {
            while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
                $(this).height($(this).height()+1);
            };
        });

        $("textarea").each(function(e) {
            while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
                $(this).height($(this).height()+1);
            };
        });

        // Typeahead Options
        var options = {
          hint : true,
          minlength : 0,
          classNames: {
              input: 'Typeahead-input',
              hint: 'Typeahead-hint',
              selectable: 'Typeahead-selectable'
            }
        }


        // Setup Priest Search

        $('#inputSearch').twtypeahead(options, {
          name: 'players',
          source: players
        });

        $('.character_search').twtypeahead(options, {
          name: 'players',
          source: players
        });


        $('#inputSearch').bind('typeahead:select', function(ev, suggestion) {
          player = Mimir.players[suggestion]
          $('#inputPID').val(player.pid);
          $('#inputCharacter').val(player.character_name);
          $('#inputGroup').val(player.group);
          $('#inputNation').val(player.nation.toLowerCase());
          if(player.path !== "Priest"){
            $('#priestWarning').removeClass('hidden');
          } else {
            $('#priestWarning').addClass('hidden');
          }
        });

        $('#inputSearch').click(function(){$('#inputSearch').val("")});

        // Setup Duration Autocomplete

        
        var durations = [
            'Until next Sunrise or Sunset (Soonist)',
            'Until next Sunrise or Sunset (Latest)',
            'End of the Annual',
            'Next Arena Battle or Quest this Annual',
            'Any Arena Battle or Quest this Annual',
            "Until Told Otherwise",
            'Until the stars go out',
            'Until Revoked',
            'Until Death',
            'Until Resolved'];

        var durations = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.whitespace,
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          // `states` is an array of state names defined in "The Basics"
          local: durations
        });

        $('#inputDuration').twtypeahead(options, {
          name: 'durations',
          source: durations
        });

    }
}

$(document).ready(Blesser.add_init)
</script>


Altar = {
    
    // Kudos Add
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
    
    add_init : function(){

        // Calculations
        $(".kudossrc").change(Altar.recalculate_total);
        $("#lives").change(Altar.recalculate_life_bonus);
        
        // Typeahead Options
        var options = {
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


        // Setup Champion Search
        $('#inputChampionSearch').twtypeahead(options, {
          name: 'players',
          source: players
        });

        $('#inputChampionSearch').bind('typeahead:select', function(ev, suggestion) {
          player = Mimir.players[suggestion]
          $('#inputChampPID').val(player.pid);
          $('#inputChamption').val(player.character_name);
          if(player.path !== "Champion"){
            $('#champWarning').removeClass('hidden');
          } else {
            $('#champWarning').addClass('hidden');
          }
        });

        $('#inputChampionSearch').click(function(){$('#inputSearch').val("")});
        
    },

    // Alter recent 


    make_table_sortable : function(){
        // With customizations
        $("table").tablesorter();
        $("table").stickyTableHeaders();
    },

    toggle_details: function(){
        $('.detailcolumn').toggle();
    },
      
    recent_init : function(){
        Altar.make_table_sortable();
        $('.detailcolumn').hide();
        $('.toggledetailcolumn').click(Altar.toggle_details);
    }
    
}
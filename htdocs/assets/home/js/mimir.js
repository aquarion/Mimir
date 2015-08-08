
var twtypeahead = jQuery.fn.typeahead.noConflict();
jQuery.fn.twtypeahead = twtypeahead;


Mimir = {


    players : {},

    transform : function(request){
      output = []
      $(request).each(function(i){
          line = request[i]
          out = line.pid + " - " + line.character_name + " (" + line.group + ")"
          output.push(out);
          Mimir.players[out] = line;
      });
      return output;
    },
}

var players = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: { 'url': '/players/alljson', 'ttl' : 60*60, 'transform' : Mimir.transform }
});
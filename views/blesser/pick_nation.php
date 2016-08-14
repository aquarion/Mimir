<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span6">
        <h1 class="pull-right">Blurses</h1>
    </div>
  </div>
  <div class="row-fluid">
      <div class="span12 ">
        <ul class="thumbnails">
          <li class="thumbnail centered span3">
              <a href="/blesser/all" >
                  <img src="/assets/home/img/blesser/infinity_large_filled-100.png" />
                  <div class="caption">All blessings for this event</div >
              </a>
          </li>
          <li class="thumbnail centered span3">
              <a href="/blesser/review" >
                  <img src="/assets/home/img/blesser/todo_list-100.png" />
                  <div class="caption">Approval Queue</div >
              </a>
          </li>
            <li class="thumbnail centered span3">
                <a href="/blesser/printqueue" >
                    <img src="/assets/home/img/blesser/print-100.png" />
                    <div class="caption">Print Queue</div >
                </a>
            </li>
            <li class="thumbnail centered span3">
                <a href="/blesser/deity" >
                    <img src="/assets/home/img/blesser/lightning_bolt_filled-100.png"/>
                    <div class="caption">Blessings By Issuer</div >
                </a>
            </li>
      </ul>
  </div>
  <div class="row-fluid">
      <div class="span12 ">
        <ul class="thumbnails">
          <li class="thumbnail centered span3">

          <div style="margin-top: 20px; margin-bottom: 20px">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-search"></i></span>
              <input type="search" id="inputSearch" placeholder="Search"><br/>
              <p>Note this searches booked players</p>
            </div>
          </div>
                  <div class="caption">Blessings for Player</div >
          </li>
          <li class="thumbnail centered span3">
              <a href="/blesser/create" >
                    <img src="/assets/home/img/blesser/create_new-100.png"/>
                  <div class="caption">Create New</div >
              </a>
          </li>
            <li class="thumbnail centered span2">
                <a href="/blesser/export" >
                    <img src="/assets/home/img/blesser/export-100.png" style="height: 100px;"/>
                    <div class="caption">Export CSV</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/blesser/import" >
                    <img src="/assets/home/img/blesser/excel-100.png" style="height: 100px;"/>
                    <div class="caption">Import Spreadsheet</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/blesser/namecheck" >
                    <img src="/assets/home/img/blesser/business-contact-100.png" style="height: 100px;"/>
                    <div class="caption">Reconcile</div >
                </a>
            </li>
        </ul>
    </div>
  <!-- <div class="row-fluid">
    <div class="span12 ">
        <ul class="thumbnails">
            <li class="thumbnail centered span2" >
                <a href="/blesser/nation/carthage" >
                    <img src="/assets/home/img/nations/smaller/carthage.png" />
                    <div class="caption">Carthage</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/blesser/nation/egypt" >
                    <img src="/assets/home/img/nations/smaller/egypt.png" />
                    <div class="caption">Egypt</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/blesser/nation/greece" >
                    <img src="/assets/home/img/nations/smaller/greece.png" />
                    <div class="caption">Greece</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/blesser/nation/hellasphoenicia" >
                    <img src="/assets/home/img/nations/smaller/hellasphoenicia.png" />
                    <div class="caption">Hellas Phoenicia</div>
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/blesser/nation/persia" >
                    <img src="/assets/home/img/nations/smaller/persia.png" />
                    <div class="caption">Persia</div>
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/blesser/nation/rome" >
                    <img src="/assets/home/img/nations/smaller/rome.png" />
                    <div class="caption">Rome</div>
                </a>
            </li>
        </ul>
    </div> -->
  </div>
</div>

</div>

<script type="text/javascript">

Blesser = {

    add_init : function(){

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

        $('.character_search').twtypeahead(options, {
          name: 'players',
          source: players
        });


        $('#inputSearch').bind('typeahead:select', function(ev, suggestion) {
          player = Mimir.players[suggestion]
          console.log(player)
          console.log(suggestion)
          window.location.href = '/blesser/character/'+player.pid+':'+player.character_name;
        });

        $('#inputSearch').click(function(){$('#inputSearch').val("")});

    }
}

$(document).ready(Blesser.add_init)
</script>

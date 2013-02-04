<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Kudos by Nation sacrificing</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12 ">
        <ul class="thumbnails">
            <li class="thumbnail centered span2" >
                <a href="/stats/carthage/" >
                    <img src="/assets/home/img/nations/smaller/carthage.png" />
                    <div class="caption">Carthage</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/stats/egypt" >
                    <img src="/assets/home/img/nations/smaller/egypt.png" />
                    <div class="caption">Egypt</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/stats/greece" >
                    <img src="/assets/home/img/nations/smaller/greece.png" />
                    <div class="caption">Greece</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/stats/hellasphoenicia" >
                    <img src="/assets/home/img/nations/smaller/hellasphoenicia.png" />
                    <div class="caption">Hellas Phoenicia</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/stats/persia" >
                    <img src="/assets/home/img/nations/smaller/persia.png" />
                    <div class="caption">Persia</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/stats/rome" >
                    <img src="/assets/home/img/nations/smaller/rome.png" />
                    <div class="caption">Rome</div >
                </a>
            </li>
        </ul>
    </div>
  </div>

<?PHP
    $results = array(
        'Carthage' => 0,
        'Egypt' => 0,
        'Greece' => 0,
        'Hellas Phoenicia' => 0,
        'Persia' => 0,
        'Rome' => 0
    );
    foreach($totals as $line){
       $results[$line->nation] = $line->totalize;
    }
    asort($results);
?>
  <div class="row-fluid">
    <div class="span2 centered" style="font-size: xx-large"><?PHP echo $results['Carthage'] ?></div>
    <div class="span2 centered" style="font-size: xx-large"><?PHP echo $results['Egypt'] ?></div>
    <div class="span2 centered" style="font-size: xx-large"><?PHP echo $results['Greece'] ?></div>
    <div class="span2 centered" style="font-size: xx-large"><?PHP echo $results['Hellas Phoenicia'] ?></div>
    <div class="span2 centered" style="font-size: xx-large"><?PHP echo $results['Persia'] ?></div>
    <div class="span2 centered" style="font-size: xx-large"><?PHP echo $results['Rome'] ?></div>
  </div>
    
  </div>
    <div class="span8" id="chartLocation">
        <table class="table hidden" id="kudostotal">
	<caption>Kudos Total</caption>
	<thead>
            <tr>
                <th scope="col">Nation</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
        <?PHP
         foreach($totals as $line){
               echo '<tr><th scope="row">'.$line->nation.'</th><td>'.$line->totalize."</td></tr>";
            }
        ?>
        </tbody>
        </table>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#kudostotal').visualize({type: 'pie', width: "600px", height: "600px"}).appendTo("#chartLocation");
    
});

</script>
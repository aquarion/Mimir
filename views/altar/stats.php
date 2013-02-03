<?PHP
    $results = Nation::nations_array();
       
    foreach($totals as $line){
       $results[$line->nation] = $line->totalize;
    }
    asort($results);
?>
<style type="text/css">
    .nation_total {
        font-size: xx-large; padding-bottom: .4em;
    }
    
    .visualize {
        margin: auto;
    }
</style>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Kudos by Nation Sacrificing</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12 ">
        <ul class="thumbnails">
            <li class="thumbnail centered span2" >
                <a href="/altar/stats/carthage" >
                    <img src="/assets/home/img/nations/smaller/carthage.png" />
                    <div class="caption">Carthage</div >
                </a>
                <div class="centered nation_total"><?PHP echo $results['carthage'] ?></div>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/egypt" >
                    <img src="/assets/home/img/nations/smaller/egypt.png" />
                    <div class="caption">Egypt</div >
                </a>
                <div class="centered nation_total"><?PHP echo $results['egypt'] ?></div>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/greece" >
                    <img src="/assets/home/img/nations/smaller/greece.png" />
                    <div class="caption">Greece</div >
                </a>
                <div class="centered nation_total"><?PHP echo $results['greece'] ?></div>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/hellasphoenicia" >
                    <img src="/assets/home/img/nations/smaller/hellasphoenicia.png" />
                    <div class="caption">Hellas Phoenicia</div >
                </a>
                <div class="centered nation_total"><?PHP echo $results['hellasphoenicia'] ?></div>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/persia" >
                    <img src="/assets/home/img/nations/smaller/persia.png" />
                    <div class="caption">Persia</div >
                </a>
                <div class="centered nation_total"><?PHP echo $results['persia'] ?></div>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/rome" >
                    <img src="/assets/home/img/nations/smaller/rome.png" />
                    <div class="caption">Rome</div >
                </a>
                <div class="centered nation_total"><?PHP echo $results['rome'] ?></div>
            </li>
        </ul>
    </div>
  </div>
    
  <div class="row-fluid">
    <div class="span12" style="margin-top: 2em;"  id="chartLocation">
        <table class="table hidden" id="kudostotal" align="center">
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

  <div class="row-fluid">
    <div class="span6 offset2" style="margin-top: 2em;" id="progressLocation">
        <table class="table hidden" id="kudosprogress">
	<caption>Kudos Progress</caption>
	<thead>
            <tr>
                <th scope="col">Nation</th>
                <?PHP
                $columns = array_keys($progress);
                $nations = Nation::nations_array(array());
                $running = Nation::nations_array();
                
                foreach($columns as $column){
                    foreach(array_keys($nations) as $nation){
                        $running[$nation] += $progress[$column][$nation];
                        $nations[$nation][] = $running[$nation];
                    }
                    echo '<th scope="col">'.$progress[$column]['date'].'</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
        <?PHP

        foreach($nations as $nation => $data){
            
            echo '<tr><th scope="col">'.Nation::name($nation).'</th>';
            foreach($data as $datum){
                 echo '<td>'.$datum.'</td>';
            }
            echo "</tr>";
        }
        
        ?>
        </table>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#kudostotal').visualize({type: 'pie', width: "600px", height: "600px"}).appendTo("#chartLocation");
    $('#kudosprogress').visualize({type: 'line', width: "1000px", height: "800px"}).appendTo("#progressLocation");
    
});

</script>

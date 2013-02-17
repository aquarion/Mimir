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
                <a href="/altar/stats/carthage/" >
                    <img src="/assets/home/img/nations/smaller/carthage.png" />
                    <div class="caption">Carthage</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/egypt" >
                    <img src="/assets/home/img/nations/smaller/egypt.png" />
                    <div class="caption">Egypt</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/greece" >
                    <img src="/assets/home/img/nations/smaller/greece.png" />
                    <div class="caption">Greece</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/hellasphoenicia" >
                    <img src="/assets/home/img/nations/smaller/hellasphoenicia.png" />
                    <div class="caption">Hellas Phoenicia</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/persia" >
                    <img src="/assets/home/img/nations/smaller/persia.png" />
                    <div class="caption">Persia</div >
                </a>
            </li>
            <li class="thumbnail centered span2">
                <a href="/altar/stats/rome" >
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
    <div class="span8" style="margin-top: 2em;"  id="chartLocation">
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

    <div class="span12" style="margin-top: 2em;" id="progressLocation">
        <table class="table hidden" id="kudosprogress">
	<caption>Kudos Progress</caption>
	<thead>
            <tr>
                <th scope="col">Nation</th>
                <?PHP
                $columns = array_keys($progress);
                $nations = array(
                    'Carthage' => array(),
                    'Egypt' => array(),
                    'Greece' => array(),
                    'Hellas Phoenicia' => array(),
                    'Rome' => array(),
                    'Persia' => array()
                );
                $running = array(
                    'Carthage' => 0,
                    'Egypt' => 0,
                    'Greece' => 0,
                    'Hellas Phoenicia' => 0,
                    'Rome' => 0,
                    'Persia' => 0
                );
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
            
            echo '<tr><th scope="col">'.$nation.'</th>';
            foreach($data as $datum){
                 echo '<td>'.$datum.'</td>';
            }
            echo "</tr>";
        }
        
        ?>
        </table>
    </div>

    <?PHP /*<div class="span8" id="progressLocation">
        <table class="table hidden" id="kudosprogress">
	<caption>Kudos Progress</caption>
	<thead>
            <tr>
                <th scope="col">Date</th>
                <?PHP foreach(array_keys($results) as $nation){
                    echo '<th scope="col">'.$nation.'</th>';
                }?>
            </tr>
        </thead>
        <tbody>
        <?PHP

        $running = array(
            'Carthage' => 0,
            'Egypt' => 0,
            'Greece' => 0,
            'Hellas Phoenicia' => 0,
            'Rome' => 0,
            'Persia' => 0
        );
         foreach($progress as $index => $line){
               echo '<tr><th scope="row">'.$line['date'].'</th>';
               foreach(array_keys($results) as $nation){
                   if($line[$nation] !== 0){
                       $running[$nation] += $line[$nation];
                   }
                    echo '<td scope="col">'.$running[$nation].'</td>';
               }
               echo "</tr>";
            }
        ?>
        </tbody>
        </table>
    </div> */?>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#kudostotal').visualize({type: 'pie', width: "600px", height: "600px"}).appendTo("#chartLocation");
    $('#kudosprogress').visualize({type: 'line', width: "1000px", height: "800px"}).appendTo("#progressLocation");
    
});

</script>
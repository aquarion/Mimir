<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1">
       
    </div>
    <div class="span10">
        <?PHP include("navigation.php"); ?>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2 ">
        <ul class="thumbnails">
            <li>
                <a href="" class="thumbnail centered active" >
                    <img src="/assets/home/img/nations/rome.png" />
                    <div class="caption">Rome</div >
                </a>
            </li>
            <li>
                <a href="" class="thumbnail centered" >
                    <img src="/assets/home/img/nations/persia.png" />
                    <div class="caption">Persia</div >
                </a>
            </li>
            <li>
                <a href="" class="thumbnail centered" >
                    <img src="/assets/home/img/nations/hellasphoenicia.png" />
                    <div class="caption">Hellas Phoenicia</div >
                </a>
            </li>
            <li>
                <a href="" class="thumbnail centered" >
                    <img src="/assets/home/img/nations/greece.png" />
                    <div class="caption">Greece</div >
                </a>
            </li>
            <li>
                <a href="" class="thumbnail centered" >
                    <img src="/assets/home/img/nations/egypt.png" />
                    <div class="caption">Egypt</div >
                </a>
            </li>
            <li>
                <a href="" class="thumbnail centered" >
                    <img src="/assets/home/img/nations/carthage.png" />
                    <div class="caption">Carthage</div >
                </a>
            </li>
        </ul>
    </div>
    <div class="span8">
        <table class="table" id="kudostotal">
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
    $('#kudostotal').visualize({type: 'pie'});
    
});

</script>
<?PHP
$path = realpath(VIEWS_LOC."/fragments/");
require($path."/header.php");
?>

<style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
  }

  .hero-unit {
      background: url("/assets/home/img/error/a2.jpg");
      background-size: cover;
      background-position: center center;
      color: white;
      text-shadow: #000 2px 2px 4px;

  }
</style>
<div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Bother.</h1>
        <p>This is a 404. I've not been able to locate the thing you're after, sorry.</p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span12">
          <h2>Couldn't find <?PHP echo $page ?></h2>
          <p><?PHP if(isset($message)){ echo $message; } ?></p>
          
          <?PHP if(isset($exception)){ ?>
          
          <h2> <?PHP echo $exception->getMessage() ?></h2>
          <p>Error <?PHP echo $exception->getCode() ?> </p>
          <p>In <?PHP
          
 function replaceFilePaths($string){
     $string = str_ireplace(realpath(APP_LOC), "[APP]", $string);
     $string = str_ireplace(realpath(FRAME_LOC), "[FRAME]", $string);
     $string = str_ireplace(realpath(VIEWS_LOC), "[VIEWS]/", $string);
     return $string;
     
 }
            echo replaceFilePaths($exception->getFile());
            echo " line ".$exception->getLine();
          ?></p>
          <table id="trace" style="display: hidden;" class="table">
          <tr>
              <th>File</th>
              <th>Line</th>
              <th>Function/Method</th>
              <th>Class</th>
              <th>Type</th>
              <th>Arguments</th>
          </tr>
          <?PHP 
          
          $tpl = "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>";
          foreach($exception->getTrace() as $line){
              $arguments = '';
              $n = 0;
              foreach($line['args'] as $argument){
                  $n++;
                  if(is_array($argument)){
                      $arguments .= $n.":Array(".count($argument).")<br/>";
                  } elseif(is_object($argument)){
                      $arguments .= $n.":".get_class($argument)."<br/>";
                  } else {
                      $arguments .= $n.":".$argument."<br/>";
                  }
              }
              $file = isset($line['file']) ? replaceFilePaths($line['file']) : '';
              $linenum = isset($line['line']) ? $line['line'] : '';
              $class = isset($line['class']) ? $line['class'] : '';
              $type = isset($line['type']) ? $line['type'] : '';
              printf($tpl, $file, $linenum, $line['function'], $class, $type, $arguments);
          }
          
          #var_dump($exception);
          ?>
          </table>
          <p><a class="btn" href="#" id="showtrace">Toggle Details &raquo;</a></p>
          <?PHP } //endif Exception ?>
          
        </div>
      </div>

      <hr>


    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/away/jquery/jquery.min.js"></script>
<script type="text/javascript">

FiveHundredInit= function(){
    $('#trace').hide();
    $('#showtrace').click(function(){ $('#trace').toggle("slow") } );
}
    
    $(document).ready(FiveHundredInit);
</script>
<?PHP

require($path."/footer.php");
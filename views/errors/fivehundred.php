
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mimir - Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/assets/away/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      
      .hero-unit {
          background: url("/assets/home/img/error/3d-explosion.jpg");
          background-size: cover;
          background-position: center center;
          color: white;
          text-shadow: #000 2px 2px 4px;
          
      }
    </style>
    <link href="/assets/away/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/away/bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/away/bootstrap/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/away/bootstrap/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="/assets/away/bootstrap/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="/assets/away/bootstrap/ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">Mimir</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="/altar">Altar</a></li>
              <li><a href="/blessr">Blessr</a></li>
              <li><a href="/journals">Journals</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Oh hell.</h1>
        <p>Something's gone drastically wrong. My advice is to find Aquarion.</p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span12">
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
  </body>
</html>

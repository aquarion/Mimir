<?PHP 
if(!isset($gnav_active)){ $gactive = ""; } else { $gactive = $gnav_active; } 

              $sections = array(
                'altar' => "Kudos",
                'blesser' => "Blessings",
                'players' => "Players",
                'mysterious' => "Greater Mysteries",
                'cauldron' => "Lesser Mysteries",
                'warehouse' => "Artefacts",
                'journals' => "Journals",
                'briefencounter' => "Briefings",
              );

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mímir
	<?PHP echo isset($sections[$gactive]) ? ' - '.$sections[$gactive] : '' ?>
	<?PHP echo $lnav_active ? ' - '.ucwords($lnav_active) : '' ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- JQuery -->
    <script src="/assets/away/jquery/jquery.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="/assets/away/bootstrap/js/bootstrap.js"></script>
    <link href="/assets/away/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/away/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    
    <!-- Visualise -->
    <script src="/assets/away/graphs/js/visualize.jQuery.js"></script>
    <link href="/assets/away/graphs/css/visualize.css" rel="stylesheet">
    
    <!-- Tablecloth -->
    <script src="/assets/away/tablecloth/js/jquery.tablecloth.js"></script>
    <script src="/assets/away/tablecloth/js/jquery.tablesorter.js"></script>
    <link href="/assets/away/tablecloth/css/tablecloth.css" rel="stylesheet">
    
    <!-- Markdown -->
    <script type="text/javascript" src="/assets/away/pagedown/Markdown.Converter.js"></script>
    <script type="text/javascript" src="/assets/away/pagedown/Markdown.Sanitizer.js"></script>
    <script type="text/javascript" src="/assets/away/pagedown/Markdown.Editor.js"></script>
    

    <!-- Typeahead -->
    <script src="/assets/away/typeahead.js/typeahead.bundle.js"></script>


    <!-- Local -->
    <script type="text/javascript" src="/assets/home/js/mimir.js"></script>

    <script type="text/javascript" >
var twtypeahead = jQuery.fn.typeahead.noConflict();
jQuery.fn.twtypeahead = twtypeahead;
</script>
    <script src="/assets/home/js/sticky_headers.js"></script>
    <link href="/assets/home/css/style.css" rel="stylesheet">

  </head>

  <body>
    <div class="navbar navbar-inverse ">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/" class="<?PHP echo $gactive === "" ? "active" : ''; ?>">Mímir</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="dropdown">
              <?PHP
                $template = '<li><a href="/%1$s">%2$s</a></li>';
                if($gactive){
                  $gactive_title = $sections[$gactive];
                  //printf($template, $gactive, $sections[$gactive], 'dropdown-toggle" data-toggle="dropdown');
                  unset($sections['gactive']);
                } else {
                  $gactive_title = "Departments";
                }
                print '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$gactive_title.'<b class="caret"></b></a>';
                  print "\n";
                print '<ul class="dropdown-menu">';
                  print "\n";
                foreach($sections as $link => $title){
                  printf($template, $link, $title);
                  print "\n";
                }
                print "</ul>\n";
              ?>
              </li>
              <!--li><a href="/odysseywiki/">Story Wiki</a></li>
              <li><a href="http://odyssey.crew.profounddecisions.co.uk/stagingwiki/">Staging Wiki</a></li -->
              
            </ul>
            <ul class="nav pull-right">
		<li style="line-height: 40px;"><img src="/assets/home/img/signs/<?PHP
		echo Event::lattr('sign');
		 ?>-32_invert.png"
			title="Sign is <?PHP echo Event::current_attribute('sign') ?>"
			>&nbsp;</li>
		<li style="line-height: 40px;"><img src="/assets/home/img/elements/icons/<?PHP
		echo Event::lattr('element');
		 ?>_element-32_invert.png" 
			title="Element is <?PHP echo Event::current_attribute('element') ?>"></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?PHP echo Event::current() ?>: <?PHP echo Event::title() ?>
                    <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <?PHP
                    foreach(Event::options() as $index => $value){
                  			if($index == Event::current){
                  				$value = "<b>$value</b>";
                  			}
                        echo '<li>'
				.'<a href="/auth/set_event/'.$index.'">'
				//.'<img src="/assets/home/img/signs/'.Event::lattr('sign',$index).'-25.png" style="float: left"; />'
				.$value
				.'</a>'
				.'</li>';
                    }
                    ?>
                  </ul>
                </li>
                <?PHP
                if (isset($_SESSION['authentication'])) { ?>
                  <li><a href="/auth/logout" title="Logout"><i class="icon-off icon-white"></i></a></li>
                <?PHP 
                  }  /* else { ?>
                  <li><a href="/auth/login?redirect=<?PHP echo urlencode($_SERVER['REQUEST_URI']); ?>">Login</a></li>
                <?PHP }*/ ?>
              </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <?PHP
    if(Event::current() != Event::latest_event()){
	$reftime = Event::current() > Event::latest_event() ? "future" : "previous";
 ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6 offset3">
      <div class="alert warning">Beware: You're viewing data for a <?PHP echo $reftime ?> Odyssey event.</div>
    </div>
  </div>
</div>
    <?PHP } ?>

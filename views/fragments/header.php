<?PHP if(!isset($gnav_active)){ $gactive = ""; } else { $gactive = $gnav_active; } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mímir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- JQuery -->
    <script src="/assets/away/jquery/jquery.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="/assets/away/bootstrap/js/bootstrap.js"></script>
    <link href="/assets/away/bootstrap/css/bootstrap.css" rel="stylesheet">
    
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
    
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      
      .centered {
          text-align: center;
      }
      
      .notyet {
            opacity:0.4;
            filter:alpha(opacity=40); /* For IE8 and earlier */    
      }
      
      
.icon-link,
.icon-blockquote,
.icon-code,
.icon-bullet-list,
.icon-list,
.icon-header,
.icon-hr-line,
.icon-undo {
	background-image: url("/assets/away/pagedown/Markdown.Editor.Icons.png");
}
.icon-link              { background-position: 0      0; }
.icon-blockquote        { background-position: -24px  0; }
.icon-code              { background-position: -48px  0; }
.icon-bullet-list       { background-position: -72px  0; }
.icon-list              { background-position: -96px  0; }
.icon-header            { background-position: -120px 0; }
.icon-hr-line           { background-position: -144px 0; }
.icon-undo               { background-position: -168px 0; }

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
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
          <a class="brand" href="/" class="<?PHP echo $gactive === "" ? "active" : ''; ?>">Mímir</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="dropdown">
              <?PHP
              $sections = array(
                'altar' => "Kudos",
                'blesser' => "Blessings",
                'players' => "Players",
                'mysterious' => "Greater Mysteries",
                'cauldron' => "Lesser Mysteries",
                'artifacts' => "Artifacts",
                'journals' => "Journals",
              );
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
              <li><a href="/forum/">Forum</a></li>
              <li><a href="/odysseywiki/">Story Wiki</a></li>
              
            </ul>
            <ul class="nav pull-right">
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
                        echo '<li><a href="/auth/set_event/'.$index.'">'.$value.'</a></li>';
                    }
                    ?>
                  </ul>
                </li>
                <?PHP
                if (isset($_SESSION['authentication'])) { ?>
                  <li><a href="/auth/logout">Logout</a></li>
                <?PHP } else { ?>
                  <li><a href="/auth/login?redirect=<?PHP echo urlencode($_SERVER['REQUEST_URI']); ?>">Login</a></li>
                <?PHP } ?>
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

<?PHP if(!isset($lnav_active)){ $active = ""; } else { $active = $lnav_active; }


?>

<ul class="nav nav-pills">
  	<li class="<?PHP echo $active == "players"  ? "active" : ''; ?>"><a href="/players/"     >Players</a></li>
  	<li class="<?PHP echo $active == "import"   ? "active" : ''; ?>"><a href="/players/import"  >Import Players</a></li>
</ul>
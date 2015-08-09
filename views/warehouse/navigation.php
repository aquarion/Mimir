<?PHP if(!isset($lnav_active)){ $active = ""; } else { $active = $lnav_active; }


?>

<ul class="nav nav-pills">
	<li class="<?PHP echo $active == "all"   ? "active" : ''; ?>"><a href="/warehouse/all" >All Items</a></li>
</ul>
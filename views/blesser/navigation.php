
<?PHP if(!isset($lnav_active)){ $active = ""; } else { $active = $lnav_active; } ?>

<ul class="nav nav-pills">
	<li class="<?PHP echo $active == "index" ? "active" : ''; ?>"><a href="/blesser/"     >Menu</a></li>
	<li class="<?PHP echo $active == "all"   ? "active" : ''; ?>"><a href="/blesser/all" >All</a></li>
	<li class="<?PHP echo $active == "add"   ? "active" : ''; ?>"><a href="/blesser/create" >Create</a></li>
	<li class="<?PHP echo $active == "review"   ? "active" : ''; ?>"><a href="/blesser/review" >Approvals</a></li>
	<li class="<?PHP echo $active == "print"   ? "active" : ''; ?>"><a href="/blesser/printqueue" >Print</a></li>
</ul>
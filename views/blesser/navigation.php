<div class="alert alert-error centered">
    <b>Under Construction &amp; Underconstructed</b><br/>
    Adding works, Reviewing works, Printing &amp; searching under development
</div>
<?PHP if(!isset($lnav_active)){ $active = ""; } else { $active = $lnav_active; } ?>

<ul class="nav nav-pills">
	<li class="<?PHP echo $active == "index" ? "active" : ''; ?>"><a href="/blesser/"     >Menu</a></li>
	<li class="<?PHP echo $active == "all"   ? "active" : ''; ?>"><a href="/blesser/all" >All Blessings</a></li>
	<li class="<?PHP echo $active == "add"   ? "active" : ''; ?>"><a href="/blesser/create" >Create Blessing</a></li>
	<li class="<?PHP echo $active == "review"   ? "active" : ''; ?>"><a href="/blesser/review" >Approval Queue</a></li>
</ul>
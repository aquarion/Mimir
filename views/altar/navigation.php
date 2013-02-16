<?PHP if(!isset($lnav_active)){ $active = ""; } else { $active = $lnav_active; } ?>

<ul class="nav nav-pills">
          <li class="<?PHP echo $active == "recent" ? "active" : ''; ?>"><a href="/altar/"     >Recent</a></li>
          <li class="<?PHP echo $active == "add"    ? "active" : ''; ?>"><a href="/altar/add"  >Add New Thing</a></li>
          <li class="<?PHP echo $active == "stats"  ? "active" : ''; ?>"><a href="/altar/stats">Statistics</a></li>
        </ul>
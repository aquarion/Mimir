<?PHP if(!isset($lnav_active)){ $active = ""; } else { $active = $lnav_active; } ?>

<script src="/assets/home/js/altar.js"></script>

<ul class="nav nav-pills">
          <li class="<?PHP echo $active == "recent" ? "active" : ''; ?>"><a href="/altar/"     >Tracker</a></li>
          <li class="<?PHP echo $active == "add"    ? "active" : ''; ?>"><a href="/altar/add"  >Add Kudos</a></li>
          <li class="<?PHP echo $active == "stats"  ? "active" : ''; ?>"><a href="/altar/stats">Statistics</a></li>
        </ul>
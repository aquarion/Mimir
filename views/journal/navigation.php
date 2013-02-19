<?PHP if(!isset($lnav_active)){ $active = ""; } else { $active = $lnav_active; } ?>

<ul class="nav nav-pills">
          <li class="<?PHP echo $active == "journals" ? "active" : ''; ?>"><a href="/journals/"     >Journals</a></li>
          <li class="<?PHP echo $active == "add"      ? "active" : ''; ?>"><a href="/journals/add"  >New Journal</a></li>
          <li class="<?PHP echo $active == "recent"   ? "active" : ''; ?>"><a href="/journals/attention">Flagged for Attention</a></li>
        </ul>
<?PHP if(!isset($lnav_active)){ $active = ""; } else { $active = $lnav_active; } ?>

<ul class="nav nav-pills">
          <li class="<?PHP echo $active == "index" ? "active" : ''; ?>"><a href="/mysterious/"     >List Mysteries</a></li>
          <li class="<?PHP echo $active == "add"   ? "active" : ''; ?>"><a href="/mysterious/add" >Add Mystery</a></li
        </ul>
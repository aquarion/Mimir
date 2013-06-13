<?PHP if(!isset($lnav_active)){ $active = ""; } else { $active = $lnav_active; }


?>

<ul class="nav nav-pills">
          	<li class="<?PHP echo $active == "journals"  ? "active" : ''; ?>"><a href="/journals/"     >Journals</a></li>
          	<li class="<?PHP echo $active == "add"       ? "active" : ''; ?>"><a href="/journals/add"  >Create Journal</a></li>
          	<?PHP if($this->is_allowed()){ ?>
          	<li class="<?PHP echo $active == "attention" ? "active" : ''; ?>"><a href="/journals/attention">Flagged for Attention
              <span class="badge badge-important" title="" id="flagged_count"><?PHP $this->attention_count() ?></span></a></li>
        	<?PHP } ?>
        </ul>
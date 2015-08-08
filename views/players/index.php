<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Booked Players</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span10 offset1">      
<table class="table-striped table-bordered " width="100%">
<thead>
  <tr>
    <th>PID</th>  
    <th>Player</th>
    <th>Location</th>
    <th>Character Name</th>
    <th>Group</th>
    <th>Nation</th>
    <th>Path</th>
    <!-- <th>Kit</th> -->
</thead>
<tbody>
<?PHP foreach($players as $player){ ?>
<tr>
       <td><?PHP echo $player->pid; ?></td>
       <td><?PHP echo $player->player; ?></td>
       <td><?PHP echo $player->location; ?></td>
       <td><?PHP echo $player->character_name; ?></td>
       <td><?PHP echo $player->group; ?></td>
       <td><?PHP echo $player->nation; ?></td>
       <td><?PHP $bang = explode(" ", $player->path); echo $bang[0]; ?></td>
       <!-- <td><?PHP echo $player->kit ? 'Yes' : 'No'; ?></td> -->
</tr>
<?PHP } ?>
</tbody>
</table>

<script type="text/javascript">


$(document).ready(function(){
      $("table").tablesorter();

})


</script>

    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1">
       
    </div>
    <div class="span10">
        <?PHP include("navigation.php"); ?>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span10">
            <table class="table-striped">
                
        <tr>
            <th>Type</th>
            <th>Priest</th>
            <th>Group</th>
            <th>Nation</th>
            <th>Feity</th>
            <th>Lives</th>
            <th>Bonus</th>
            <th>Arena</th>
            <th>Clk</th>
            <th>Obol</th>
            <th>Drac</th>
            <th>5/Drac</th>
            <th>Mina</th>
            <th>Earth</th>
            <th>Air</th>
            <th>Fire</th>
            <th>Water</th>
            <th>Total</th>
        </tr>

        
        <?PHP
        foreach($recent as $line){
            $data = $line->as_array();
            $id = $data['id'];
            unset($data['id']);
            unset($data['notes']);
            $data['priest_name'] = $data['priest_name']." (".$data['priest_id'].")";
            unset($data['priest_id']);
            echo '<tr><td>'.implode("</td><td>",array_values($data)).'</td>';
            
            echo '<td><a href="/edit/kudos/'.$id.'">Edit</a></td>';
            
            echo '</tr>';
        }
        ?>
        </table>
    </div>
  </div>
</div>
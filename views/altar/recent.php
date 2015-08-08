<?PHP
if (count($_GET)) {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $q = $url['query'] . "&";
    parse_str($url['query'], $query_index);
} else {
    $q = false;
}

?>
<style type="text/css">
    .detailcolumn {
        display: none;
    }
    
    th {
        cursor: pointer;
    }
</style>
<div class="container-fluid">
    <div class="row-fluid">
	<div class="span5">
	    <?PHP include("navigation.php"); ?>
	</div>
	<div class="span7">
	    <h1 class="pull-right">Kudos Tracker</h1>
	</div>
    </div>
    <div class="row-fluid">
	<div class="span12">

	    <?PHP
	    echo isset($page_title) ? $page_title : '';

	    if (isset($query_data)) {
		echo '<h3>Remove Filters:</h3> <ul class="unstyled">';
		foreach ($query_data as $name => $value) {
		    $query_copy = $query_data;
		    unset($query_copy[$name]);
		    $query = implode("&", $query_copy);
		    echo '<li><i class="icon-remove-sign"></i> <a href="/altar?' . $query . '"><q>' . $name . '</q></a></li>';
		}
		echo '</ul>
            <h3>Sacrifices</h3>   
            ';
	    }
	    ?>


	    <p>Click a row heading to sort the table, or a <i class="icon-search"></i> search link to search the table for that thing.
                <?PHP  if ($q) { ?>
                Click a <i class="icon-filter"></i> filter link to add that to the search criteria. 
                <?PHP } ?>
                You can also <a href="#" class="toggledetailcolumn">toggle the detail columns</a>. </p>

            <table class="table-striped table-bordered " width="100%">
		<thead>        
		    <tr style="">
			<th>Type</th>
			<th>Priest</th>
			<th>Group</th>
			<th>Nation</th>
			<th>Deity</th>
			<th>Lives</th>
			<th class="detailcolumn">Bonus</th>
			<th class="detailcolumn">Arena</th>
			<th class="detailcolumn">Clk</th>
			<th class="detailcolumn">Obol</th>
			<th class="detailcolumn">Drac</th>
			<th class="detailcolumn">5/Drac</th>
			<th class="detailcolumn">Mina</th>
			<th class="detailcolumn">Earth</th>
			<th class="detailcolumn">Air</th>
			<th class="detailcolumn">Fire</th>
			<th class="detailcolumn">Water</th>
			<th class="detailcolumn">Champion</th>
			<th>Total</th>
			<th>Actions</th>
		    </tr>
		</thead>
		<tbody>

		    <?PHP
		    foreach ($recent as $line) {
			$data = $line->as_array();
			#$data['priest_name'] = $data['priest_name']." (".$data['priest_id'].")";
			echo '<tr>';
                        
			foreach ($data as $index => $value) {
                            unset($field);
			    switch ($index) {
				case "id":
				case "notes":
				case "priest_id":
				case "event_id":
				case "champion_id":
				case "date_created":
				    break;

				case "priest_name":
                                    $field = isset($field) ? $field : "priest/".urlencode($value);
				case "group_name":
                                    $field = isset($field) ? $field : "group/".urlencode($value);
				case "nation":
                                    $field = isset($field) ? $field : "";
				case "deity":
                                    $field  = isset($field) ? $field : "deity/".urlencode($value);
                                    $nation = strtolower($line->nation); 
				    echo '<td>';
                                    printf('<a href="/altar/stats/%s/%s" title="Show data tables">%s</a> ', $nation, $field, ($value ? $value : '&nbsp;'));
                                    if(!isset($query_index[$index])){
                                        echo '<a href="/altar?' . $index . '=' . $value . '" title="Search for '.$index.' = '.$value.'"><i class="icon-search"></i></a>';
                                        if ($q) {
                                            echo ' <a href="/altar?' . $q . $index . '=' . $value . '" title="Add to Filter"><i class="icon-filter"></i></a>';
                                        }
                                    } 
				    echo '</td>';
				    break;

				case "lives":
				    echo '<td class="centered"><span class="hidden">' . $value . '</span>';
				    for ($i = 0; $i < $value; $i++) {
					echo '<i class="icon-heart"></i>';
				    }
				    echo '</td>';
				    break;
				case "total":
				case "sacrifice_type":
				    echo '<td>' . ($value ? $value : '&nbsp;') . '</td>';
                                    break;
				default:
				    echo '<td class="detailcolumn">' . ($value ? $value : '&nbsp;') . '</td>';
			    }
			}

			echo '<td><a href="/edit/kudos/' . $data['id'] . '">Edit</a></td>';

			echo "</tr>\n";
		    }
		    ?>
		</tbody>
	    </table>
	</div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(Altar.recent_init)
</script>

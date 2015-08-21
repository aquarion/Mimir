<style >
.notyet {
  display: none;

}

.span3 h2 {
  height: 2em;
}
</style>

    <div class="container-fluid">

      <!-- Three columns of text below the carousel -->
      <div class="row-fluid">
        <div class="span12">
          <h2>Recent Changes</h2>

<dl>
<?PHP
foreach($commits as $commit){
	print '<dt><a href="https://github.com/aquarion/Mimir/commit/'.$commit->sha.'">'.date("Y-m-d H:i", $commit->date).'</a>';
	print ' &mdash; '.array_shift($commit->log).'</dt>';
	print '<dd>'.implode("<br/>", $commit->log).'</dd><br/>';
}
 //var_dump($commits);
 ?>
</dl>
        </div><!-- /.span3 -->

    </div> <!-- /row -->
</div> <!-- /container -->

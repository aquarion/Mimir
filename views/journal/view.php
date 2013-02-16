<?PHP
use \Michelf\Markdown;
$journal_type = preg_replace('/\s+/', '', $journal->journal_type);
$posts = $journal->posts()->find_many();
?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1 centered">
      <img src="/assets/home/img/section-icons/pabodie-field-notes-icon.png" width="50em"/>
    </div>
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span7">
        <h1 class="pull-right">View Journal</h1>
    </div>
  </div>
  <div class="row-fluid">
  
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="/journals">Journals</a> <span class="divider">/</span></li>
            <li><a href="/journals/#<?PHP echo urlencode($journal_type) ?>"><?PHP echo $journal->journal_type ?></a> <span class="divider">/</span></li>
            <li class="active"><?PHP echo $journal->title ?></li>
        </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span9">
            <h2><?PHP echo $journal->title ?></h2>
    </div>
    <div class="span3">
      <form class="form-search input-prepend">
          <span class="add-on"><i class="icon-search"> </i></span>
          <input type="text" class="input-medium" name="q">
          <input type="hidden" name="journal_id" value="<?PHP echo $journal->id ?>">
          <button type="submit" class="btn">Search</button>
      </form>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2">
        <p><a href="/journals/add_entry/<?PHP echo $journal->id ?>" class="btn btn-large">Add Entry</a></p>
        
        
        <ul class="nav nav-list sidebar" id="sidebar"  >
        <?PHP
        
        $event = null;
        foreach($posts as $post){ 
            if($event !== $post->event){
                echo '<li class="nav-header">'.Event::title($post->event)."</li>\n";
                $event = $post->event;
            }
            printf('<li><a href="#post-%d"><i class="icon-chevron-right"></i>%s</a></li>', $post->id, $post->title);
            echo "\n";
        }
        ?>
        </ul>

        
    </div>
    <div class="span7">
        <?PHP 
        $event = null;
        foreach($posts as $post){ 
        if($event !== $post->event){
            echo "<h2>".Event::title($post->event)."</h2>";
        }
        ?>
        <section id="post-<?PHP echo $post->id ?>">
        <h3><a href='#post-<?PHP echo $post->id ?>'><?PHP echo $post->title ?></a></h3>
        <?PHP echo Markdown::defaultTransform($post->content); ?>
        <div class="well well-small">
            Posted by <?PHP echo $post->author ?>
            <?PHP if($post->author != $post->physrep){ echo ' for '.$post->physrep; }?>
            on <?PHP echo date("D M jS @ H:i", strtotime($post->date_created))?>
        </div>
        </section>
        <hr/>
        <?PHP } ?>
        
    </div>
  </div>
</div>
<script type="text/javascript">

var originalpos  = null;
var originalleft = null;

$(document).ready(function(){
   
   var originaltop  = $('#sidebar').offset().top;
   var originalleft = $('#sidebar').offset().left;
    
   spy = $('body').scrollspy() 
   
   $(window).scroll( function(){
       navpos = $('#sidebar').offset().top+40;
       winpos = $(window).scrollTop()+40;
       if(winpos > originaltop){
           $('#sidebar').offset({ top: winpos, left: originalleft});
       }
   });
});
</script>
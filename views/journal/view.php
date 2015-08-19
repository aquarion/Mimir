<?PHP
use \Michelf\Markdown;
$journal_type = $journal->journal_type_title($journal->journal_type);
$posts = $journal->posts()->where("event", Event::current())->find_many();
?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1 centered">
      <img src="/assets/home/img/section-icons/Literature-100.png"/>
    </div>
    <div class="span5">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span6">
        <h1 class="pull-right">View Journal</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="/journals">Journals</a> <span class="divider">/</span></li>
            <li><a href="/journals/#<?PHP echo $journal->journal_type ?>"><?PHP echo $journal_type ?></a> <span class="divider">/</span></li>
            <li class="active"><?PHP echo $journal->title ?></li>
        </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span9">
            <h2><?PHP echo $journal->title ?></h2>
    </div>
    <div class="span3">
      <form class="form-search input-prepend" method="GET" action="/journals/search">
          <span class="add-on"><i class="icon-search"> </i></span>
          <input type="text" class="input-medium" name="q">
          <input type="hidden" name="jid" value="<?PHP echo $journal->id ?>">
          <button type="submit" class="btn">Search</button>
      </form>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2 ">
        <div class="centered">
        <p><a href="/journals/add_entry/<?PHP echo $journal->id ?>" class="btn btn-large btn-primary">Add Entry</a></p>
        <p><a href="/edit/journal/<?PHP echo $journal->id ?>" class="btn btn-small ">Edit Journal</a></p>
        </div>
        
        <ul class="nav nav-list sidebar" id="sidebar"  >
        <?PHP
        
        $sidebar_event = null;
        foreach($posts as $post){ 
            if($sidebar_event !== $post->event){
                echo '<li class="nav-header">'.Event::title($post->event)."</li>\n";
                $sidebar_event = $post->event;
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
        if(count($posts) == 0){
            echo "<p>No entries found in this journal for ".Event::title()."</p>";
        }
        foreach($posts as $post){ 
            if($event !== $post->event){
                echo "<h2>".Event::title($post->event)."</h2>";
                    $event = $post->event;
            }
            ?>
            <section id="post-<?PHP echo $post->id ?>">
            <h3><a href='#post-<?PHP echo $post->id ?>'><?PHP echo $post->title ?></a></h3>
            <?PHP echo Markdown::defaultTransform($post->content); ?>
            <div class="well well-small">
                <div class="btn-group">
                    <?PHP 

                    if($this->is_allowed()){
                      if($post->attention_flag){
                          ?><button class="btn btn-danger markunflag" id="flag-<?PHP echo $post->id ?>" title="Toggle Flag"><i class="icon-flag icon-white"></i></button><?PHP
                      } else {
                          ?><button class="btn markflag" id="flag-<?PHP echo $post->id ?>" title="Toggle flag for Story followup"><i class="icon-flag"></i></button><?PHP
                      }
                      ?>
                      <?PHP if($post->unread_by_story){
                          ?><button class="btn btn-primary markread" id="read-<?PHP echo $post->id ?>">Mark Read By Story</button><?PHP
                      } else {
                          ?><button class="btn markunread" id="read-<?PHP echo $post->id ?>">Mark Unread</button><?PHP
                      }
                    }

                    ?>
                    <a class="btn" href="/edit/entry/<?PHP echo $post->id ?>">Edit</a>
                </div>
                <p class="pull-right">
                Posted by <?PHP echo $post->author ?>
                <?PHP if($post->author != $post->physrep){ echo ' for '.$post->physrep; }?>
                on <?PHP //echo date("D M jS @ H:i", strtotime($post->date_created));

		echo $post->date_created;
		?>
                </p>
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

Journal = {
    markflag : function(){
        data = {id : $(this).attr("id")}
        $(this).off("click", Journal.markflag);
        $.post("/journals/ajax/markflag", data, Journal.success, "json");
        
    },
    markunflag : function(){
        data = {id : $(this).attr("id")}
        $(this).off("click", Journal.markunflag);
        $.post("/journals/ajax/markunflag", data, Journal.success, "json");
    },
    markread : function(){
        data = {id : $(this).attr("id")}
        $(this).off("click", Journal.markread);
        $.post("/journals/ajax/markread", data, Journal.success, "json");
    },
    markunread : function(){
        data = {id : $(this).attr("id")}
        $(this).off("click", Journal.markunread);
        $.post("/journals/ajax/markunread", data, Journal.success, "json");
    },
    success : function(data, textStatus, jqXHR){
        if(data.error){
            $('<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
                +'<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'
                +'<h3 id="myModalLabel">An error has occoured</h3></div><div class="modal-body">'
               +data.error
               +'</div></div>').modal()
        }
        item = $('#'+data.htmlid);
        if(data.addclass){
            item.addClass(data.addclass)
        }
        if(data.removeclass){
            item.removeClass(data.removeclass)
        }
        if(data.addevent){
            item.on("click", window["Journal"][data.addevent]);
        }
        if(data.content){
            item.html(data.content)
        }
        if(data.attention){
            $('#flagged_count').html(data.attention)
        }
    },
    
    update_counts_tick : function(){
        $.post("/journals/attention_count", {}, Journal.update_counts_ajax);
    },
    
    update_counts_ajax :function(data){
        $('#flagged_count').html(data)
    }
    
};

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
   
   $('.markflag').on("click", Journal.markflag);
   $('.markunflag').on("click", Journal.markunflag);
   $('.markread').on("click", Journal.markread);
   $('.markunread').on("click", Journal.markunread);
   
   Journal.update_counts_tick();
   setInterval(Journal.update_counts_tick, 30000);
});
</script>

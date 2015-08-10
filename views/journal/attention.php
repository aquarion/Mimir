<?PHP
use \Michelf\Markdown;
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
        <h1 class="pull-right">Flagged for Attention</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="/journals">Journals</a> <span class="divider">/</span></li>
            <li class="active">Attention</li>
        </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span7 offset2">
        <?PHP 
        if(count($posts) == 0){
            echo "<p>No entries requiring attention for ".Event::title()."</p>";
        }
        foreach($posts as $post){ 
            ?>
            <section id="post-<?PHP echo $post->id ?>" class="post">
            <h3>
                <?PHP echo $post->journal()->find_one()->title ?> &ndash;
                <a href='#post-<?PHP echo $post->id ?>'><?PHP echo $post->title ?></a>
            </h3>
            <?PHP echo Markdown::defaultTransform($post->content); ?>
            <div class="well well-small">
                <div class="btn-group">
                    <?PHP if($post->attention_flag){
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
                    ?>
                    <a class="btn" href="/edit/journal/<?PHP echo $post->id ?>">Edit</a>
                </div>
                <p class="pull-right">
                Posted by <?PHP echo $post->author ?>
                <?PHP if($post->author != $post->physrep){ echo ' for '.$post->physrep; }?>
                on <?PHP echo date("D M jS @ H:i", strtotime($post->date_created))?>
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
        console.log("Mark unread!");
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
            console.log("Attention: "+data.attention);
            $('#flagged_count').html(data.attention)
        }
    }
    
};

$(document).ready(function(){   
   $('.markflag').on("click", Journal.markflag);
   $('.markunflag').on("click", Journal.markunflag);
   $('.markread').on("click", Journal.markread);
   $('.markunread').on("click", Journal.markunread);
});
</script>
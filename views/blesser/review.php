<?PHP 
use \Michelf\Markdown;
$print = array();
?>
<style type="text/css">
.panel {
  border: 1px solid #666;
  border-radius: 7px;
  padding: 1em;
  margin-bottom: 1em;
}
</style>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span6">
        <h1 class="pull-right"><?PHP 
        if (isset($lnav_active)){
          echo ucwords($lnav_active);
        } else {
          echo 'View';
          $lnav_active = '';
        }
        ?> Blessings</h1>

        <?PHP if($lnav_active == 'review') { ?>
          <p>There is no coming back from clicking one of these buttons unless you're supposed to. 
          You are being watched, and those who watch will wait.</p>
        <?PHP } ?>
    </div>
  </div>

<?PHP

if(!count($blessings)){
  ?><div class="alert">
    Sorry, No blessings found
  </div> <?PHP
}


foreach($blessings as $blessing){ 
  $print[] = $blessing->target_id .':'. $blessing->target_name;

  ?>
<div class="panel">
  <div class="row-fluid">
    <div class="span2">
      <p class="text-center">
        <b><a href="/blesser/character/<?PHP echo $blessing->target_id.':'.$blessing->target_name ?>">
        <?PHP echo $blessing->target_id ?><br/>
        <?PHP echo $blessing->target_name ?></a></b>
      </p>
    </div>
    <div class="span2">
      <p class="text-center">
        From<br/>
        <b><?PHP echo $blessing->from_type ?> &mdash; <?PHP echo $blessing->issuer ?></b><br/>
        For <b><?PHP echo $blessing->reason ?></b>
      </p>
    </div>
    <div class="span3">
      <p class="text-center">
        Duration:<br/> <b><?PHP echo $blessing->duration ?> </b><br/>
        Author: <b><?PHP echo $blessing->author ?> </b><br/>
      </p>
    </div>
    <div class="span3">
      <p class="text-center">
        Review<br/>
        <div class="btn-group">
          <button class="btn <?PHP echo $blessing->review_ref  ? 'btn-primary unreview' : 'review' ?>" id="refreview-<?PHP echo $blessing->id ?>">Aquarion</button>
          <button class="btn <?PHP echo $blessing->review_plot ? 'btn-warning unreview' : 'review' ?>" id="plotreview-<?PHP echo $blessing->id ?>">Story</button>
          <button class="btn <?PHP echo $blessing->review_sane ? 'btn-inverse unreview' : 'review' ?>" id="sanityreview-<?PHP echo $blessing->id ?>">Sanity Check</button>
        </div>
        <?PHP if ($blessing->date_printed){
          print "<br/>Last printed: ".$blessing->date_printed;
        } else {
          print "<br/>Not printed: ";
          print '<label class="checkbox" for="canprint-'.$blessing->id.'">'
            .'<input type="checkbox" id="canprint-'.$blessing->id.'"'
            .($blessing->can_print ? 'CHECKED="CHECKED" class="disableprint" ' : ' class="enableprint"')
            .'>Can Print?</label>'; 
        } ?>
      </p>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <h3>IC Description</h3>
      <?PHP echo Markdown::defaultTransform($blessing->description); ?>
    <hr/>
      <h3>Game Effect</h3>
      <?PHP echo Markdown::defaultTransform($blessing->effect); ?>
    </div>
  </div>
  <?PHP if ($blessing->has_tokens()){ ?>
    <div class="row-fluid">
    <h3>Splash Tokens</h3>
    </div>
    <div class="row-fluid">
    <?PHP for ($i=1; $i <= 4; $i++) {  ?>
      <div class="span3 panel panel-default">
        <?PHP echo $blessing->token($i,'count') ?>&times; <b><?PHP echo $blessing->token($i,'target') ?></b><br/>
         <p><?PHP echo Markdown::defaultTransform($blessing->token($i,'effect')); ?></p>
      </div>
    <?PHP } ?>


    </div>
  <?PHP } ?>
  <a href="/blesser/create?id=<?PHP echo $blessing->id ?>" class="btn"><i class="icon-trash icon-edit"></i> Edit</a>
  <button  data-href="/blesser/delete?id=<?PHP echo $blessing->id ?>" class="btn btn-danger pull-right deleteblessing"><i class="icon-trash icon-white"></i> Delete</a>
</div>

<?PHP } 

if(count($print)){
  $print = implode("%%",array_unique($print));
  ?>
  <form method="POST" action="/blesser/printpdf">
    <input name="print" value="<?PHP echo $print ?>" />
    <button class="btn btn-primary" href="#"><i class="icon-print icon-white"></i> Print</button>
  </form>
  <?PHP
}


?>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete Blessing
            </div>
            <div class="modal-body" id="deleteBlessingText">
                Sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

var originalpos  = null;
var originalleft = null;

BlessingReview = {
    review : function(){
        data = {id : $(this).attr("id") }
        $(this).off("click", BlessingReview.review);
        $.post("/blesser/ajax/review", data, BlessingReview.success, "json");

    },
    unreview : function(){
        data = {id : $(this).attr("id") }
        $(this).off("click", BlessingReview.unreview);
        $.post("/blesser/ajax/unreview", data, BlessingReview.success, "json");
    },

    enableprint : function(){
       console.log('canprint');
        data = {id : $(this).attr("id") }
        $(this).off("click", BlessingReview.canprint);
        this.checked = true;
        $.post("/blesser/ajax/enableprint", data, BlessingReview.success, "json");
    },

    disableprint : function(){
       console.log('cannotprint');
        data = {id : $(this).attr("id") }
        $(this).off("click", BlessingReview.cannotprint);
        this.checked = false;
        $.post("/blesser/ajax/disableprint", data, BlessingReview.success, "json");
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
            item.on("click", window["BlessingReview"][data.addevent]);
        }
        if(data.content){
            item.html(data.content)
        }
        if(data.attention){
            $('#flagged_count').html(data.attention)
        }
    },


    
};

$(document).ready(function(){
    
   $('.review').on("click", BlessingReview.review);
   $('.unreview').on("click", BlessingReview.unreview);
    
   $('.enableprint').on("click", BlessingReview.enableprint);
   $('.disableprint').on("click", BlessingReview.disableprint);

   $('.deleteblessing').click(function(object){
      href = $(this).data('href');
      $('#confirm-delete a').attr('href', href);
      $('#confirm-delete').modal('show');
   })

   
});
</script>

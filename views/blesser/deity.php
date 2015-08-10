<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span6">
        <h1 class="pull-right">By Issuer</h1>
    </div>
  </div>

  <div class="row-fluid">
    <div class="span6 offset1">
    <ul>
<?PHP

foreach($issuers as $issuer){?> 
        <li><a href="/blesser/deity/<?PHP echo urlencode($issuer); ?>"><?PHP echo $issuer; ?></a></li>
<?PHP } 

?></ul></div>
    </div>
  </div>
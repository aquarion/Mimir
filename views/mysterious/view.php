<?PHP
use \Michelf\Markdown;
?><div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span9">
        <h1 class="pull-right">Greater Mysteries</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span10 offset1">

      <h1 class="pull-center"><?PHP echo $mystery->name ?> <a href="/mysterious/edit/<?PHP echo $mystery->id ?>" class="btn">Edit</a></h1>
      <p><?PHP echo Markdown::defaultTransform($mystery->short_desc); ?></p>
     
      <blockquote><?PHP echo Markdown::defaultTransform($mystery->flavour); ?></blockquote>

      <h2>Casting</h2>
      <table class="table">
        <tr>
          <th>Drachma</th>
          <th>Earth</th>
          <th>Air</th>
          <th>Fire</th>
          <th>Water</th>
          <th>Blood</th>
        </tr>
        <tr>
          <td><?PHP echo $mystery->drachma ?></td>
          <td><?PHP echo $mystery->quin_earth ?></td>
          <td><?PHP echo $mystery->quin_air ?></td>
          <td><?PHP echo $mystery->quin_fire ?></td>
          <td><?PHP echo $mystery->quin_water ?></td>
          <td><?PHP echo $mystery->blood ?></td>
        </tr>
      </table>
      <?PHP if($mystery->extra_requirements){ ?>
        <p><?PHP echo Markdown::defaultTransform($mystery->extra_requirements); ?></p>
      <?PHP } ?>

      <h2>Effect</h2>
        <p><?PHP echo Markdown::defaultTransform($mystery->effect); ?></p>


      <p>This mystery can only be cast at an event under the sign of <b><?PHP echo $mystery->sign_requirement ?></b></p>

      <?PHP if($mystery->enhancements){ ?>
        <h3>Enhancements</h3>
        <p><?PHP echo Markdown::defaultTransform($mystery->enhancements); ?></p>
      <?PHP } ?>

    </div>
  </div>
</div>
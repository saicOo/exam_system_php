<?php
session_start();

function __autoload($class){
    require "Controllers/".$class.".php";
}
include_once  "./init.php";
new Auth;
$traffic = new Traffic;
$trafficCount = $traffic->show();
$subscribe = new Subscribe;
$disblayMessage = $subscribe->display();


        // start header area
require_once "./layouts/header.php"; 
?>

<section>
<div class="container">
    <br>
    <h2>Traffic Count : <?php echo $trafficCount['traffic_count'] ?></h2>
<div class="card text-white bg-dark">
  <h5 class="card-header">Display Subscribe Messages</h5>
  <div class="card-body">
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Messages</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach($disblayMessage as $index => $item): ?>
            <tr>
            <td><?php echo $index + 1 ?></td>
            <td><?php echo $item['message'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        </table>
</div>
</div>
</div>
</section>


<?php
 //start footer area 
require_once "./layouts/footer.php"; ?>
       

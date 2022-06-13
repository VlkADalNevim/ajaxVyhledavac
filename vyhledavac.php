<?php

$dbservername = 'sql106.epizy.com';
$dbusername = 'epiz_31545781';
$dbpassword = 'Z7RvVFGykf';
$dbname = "epiz_31545781_phplogin";
$connection = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if(!$connection){
    die('Database connection error : ' .mysql_error());
}

  if (isset($_POST['query'])) {
      $search = mysqli_real_escape_string($connection, $_POST["query"]);
      $query = "SELECT autori.jmeno, citaty.obsah FROM citaty INNER JOIN autori ON citaty.autori_ID = autori.id WHERE autori.jmeno LIKE '%{$_POST['query']}%' or citaty.obsah LIKE '%{$_POST['query']}%' LIMIT 5";
      $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($res = mysqli_fetch_array($result)) {
        ?>
            <div class="movieHrefContent">
              <td><?php echo $res['jmeno']?>: <?php echo $res['obsah']?></td>
            </div>
        <?php
      }
    } else {
      ?>
        <div class='alert alert-danger mt-3 text-center' role='alert'>
          <div class="noNewResult">
            <a class="noResult"> No results </a> 
          </div>
        </div>
      <?php
      ;
    }
  }
?>
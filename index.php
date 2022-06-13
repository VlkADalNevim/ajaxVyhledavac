<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body>
				<a href="insert.php">CSV Insert</a>

			<div class="searchArea">
				<form action="index.php" method="post">
					<input type="text" class="search" id="hledat" name="search" placeholder="Search... ">
				</form>
			</div>

			<div id="result">
				<a>Search...</a>
			</div>

	</body>
</html>

<script>
	$(document).ready(function(){
		load_data();
		function load_data(query)
		{
			$.ajax({
			url:"vyhledavac.php",
			method:"POST",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
			});
		}
		$('#hledat').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();
		}
		});
	});
</script>

<?php

$dbservername = 'sql106.epizy.com';
$dbusername = 'epiz_31545781';
$dbpassword = 'Z7RvVFGykf';
$dbname = "epiz_31545781_phplogin";
$connection = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if(!$connection){
    die('Database connection error : ' .mysql_error());
}

  if (isset($_POST['search'])) {
      $search = mysqli_real_escape_string($connection, $_POST["query"]);
      $query = "SELECT autori.jmeno, citaty.obsah FROM citaty INNER JOIN autori ON citaty.autori_ID = autori.id WHERE autori.jmeno LIKE '%{$_POST['query']}%' or citaty.obsah LIKE '%{$_POST['query']}%' LIMIT 20";
      $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($res = mysqli_fetch_array($result)) {
        ?>
            <div class="movieHrefContent">
              <td><?php echo $res['jmeno']?>: <?php echo $res['obsah']?></td>
            </div>
        <?php
      }
    }
  }
?>

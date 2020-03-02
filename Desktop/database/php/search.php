<?php
	$chro = array();
	$prext = array();

	$maximum = $_GET["maximum"];
	$minimum = $_GET["minimum"];
	$chro = $_GET['chr'];
	$signal = $_GET['signal'];
	$prext = $_GET['prext'];

	$chrostr = implode(",", $chro);
	$prextstr = implode(",", $prext);

	if ($minimum == ''){
		$minimum = 1;
	}
	if ($maximum == ''){
		$maximum = 200;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SPAT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Description" lang="en" content="ADD SITE DESCRIPTION">
        <meta name="author" content="ADD AUTHOR INFORMATION">
        <meta name="robots" content="index, follow">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">-->
    <!-- required for dropdown menu on navigation toolbar-->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->

        <!-- Bootstrap Core CSS file -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="static/bootstrap-table/bootstrap-table.min.css">
        <!-- Override CSS file - add your own CSS rules -->
        <link rel="stylesheet" href="static/style.css">
</head>
<body>
            <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <!--<div class="navbar-header">-->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.html"><b><font color=#0089A7>SPAT</font></b></a>
                <!--</div> -->
                <!-- /.navbar-header -->
                <!-- Collect the nav links, forms, and other content for toggling -->
                <!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="home.html"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="search.html"><span class="glyphicon glyphicon-search"></span> Search</a></li>
                    <li><a href="aboutus.html">About us</a></li>
                    <li><a href="help.html">Help</a></li>
                    <li><a href="contactus.html">Contact Us</a></li>
                </ul>
            </nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <!-- Page content 1 -->
            <div class="container" style="width:100%">
                <br>
                </div>
                <div>
                	Search Conditions:<br>
                	Maximum: <?php echo $maximum ?><br>
                	Minimum: <?php echo $minimum ?><br>
                	Chromosome: <?php echo $chrostr ?><br>
                	With Signal Sequence: 
                	<?php 
                	if($signal =="sigseq") {echo "Yes";} 
                	else {echo "No";} 
                	?><br>
                	Protein Existence: <?php echo $prextstr ?><br>
                </div>
                 <!-- <p><b>Download(CSV)</b><a href="download.php"><span class="glyphicon glyphicon-download-alt" style="margin-left: 1%"></span></a></p> -->
                <table class="table table-striped table-bordered" style="table-layout:fixed;word-break:break-all; word-wrap:break-all;font-family: Arial">     
                <thead>　　　　　　　　　　　　　　　　
                    <tr>　　　　
                        <th style="width:20%">ID</th>　　　　　　　　　　
                        <th style="width:70%">Peptide Sequence</th>
                        <th style="width:10% ">Length</th>
                    </tr>
                </thead>

				<?php
				$num_rec_per_page=10;
				$servername = "localhost";
				$username = "ZhuLiangquan";
				$password = "zhuliangquan";
				$database = "spat";
				if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
				$start_from = ($page-1) * $num_rec_per_page; 
				 
				// 创建连接
				$conn = new mysqli($servername, $username, $password,$database);
				 
				// 检测连接
				if ($conn->connect_error) {
				    die("Connection Failed:" . $conn->connect_error);
				} 

                if ($chrostr!=""){
                    $chrosql = " and chro in ($chrostr)";
                }
                else{
                    $chrosql = "";
                }

                if ($signal == "sigseq"){
                    $sigsql = " and signal_seq is not NULL";
                }
                else{
                    $sigseq = "";
                }

                if ($prextstr != ""){
                    $prexstsql = " and pr_existence in ($prextstr)";
                }
                else{
                    $prexstsql = "";
                }

                // echo $chrosql;
                // echo $prexstsql;

                $sql = "select * from pep_mipep where seq_len < {$maximum} and seq_len > {$minimum}" . $chrosql .$sigsql .$prexstsql . " LIMIT {$start_from}, {$num_rec_per_page}";

				$result = $conn->query($sql);

				if($result === false){//执行失败
				    echo $mysqli->error;
				    echo $mysqli->errno;
				}

                $total_sql = "select * from pep_mipep where seq_len < {$maximum} and seq_len > {$minimum}" . $chrosql .$sigsql .$prexstsql ;

				// if ($signal=="sigseq"){
				// 	$total_sql = "select * from pep_mipep where seq_len < {$maximum} and seq_len > {$minimum} and chro in ($chrostr) and pr_existence in ($prextstr) and  signal_seq is not NULL ";
				// }
				// else {
				// 	$total_sql = "select * from pep_mipep where seq_len < {$maximum} and seq_len > {$minimum} and chro in ($chrostr) and prext in ($prextstr) ";
				// }
				$total_result = $conn->query($total_sql);
				$total_records = $total_result->num_rows;
				$total_pages = ceil($total_records / $num_rec_per_page);
                // echo "aaa".$total_records;

				$myfile = fopen('static/tmp.csv',"w");

				if ($result->num_rows > 0) {	
					echo "<tbody>";
				    while($row = $result->fetch_assoc()) {
				    	echo "<tr>";
				    	$mipep_id = $row["mipep_id"];
				        echo "<td><a href='getseq.php?mipep_id={$mipep_id}'}>{$mipep_id}</a></td>";
				        echo "<td>{$row["pep_seq"]}</td>";
				        echo "<td>{$row["seq_len"]}</td>";
				        echo "</tr>";

				        $csv = $mipep_id.",".$row["pep_seq"].",".$row["seq_len"];
				        fwrite($myfile,$csv);
				    }
				    echo "</tbody>";
				} else {	
				    echo "0 Result";
				}
				fclose($myfile);
				$conn->close();
				?>
                </table>


                 <div id="pages" class="text-center" >
                    <nav>
                        <ul class="pagination">
                        	<li class="step-links">
                        	<?php
                        		$url = $_SERVER["QUERY_STRING"];
                        		$prev_page = $page -1;
                        		if ($page!=1){
                        			echo "<a class='active' href='search.php?{$url}&page={$prev_page}'>Previous</a>";
                        		}
                            ?>
                            <span class="current">
                                <?php
                                echo "Page {$page} of {$total_pages}";
                                ?>
                            </span>
                            <?php
                        		$next_page = $page + 1;
                        		if ($page<$total_pages){
                        			echo "<a class='active' href='search.php?{$url}&page={$next_page}'>Next</a>";
                        		}
                            ?>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div align = "center" id="footer" class="footer">
                    <p>Copyright &#169; <a href="http://cbb.sjtu.edu.cn/~jingli/">Jing Li's group</a>,
                    SJTU. All rights reserved.</p>
              </div>
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
            <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
<script src="static/bootstrap-table/bootstrap-table.min.js"></script>
</body>
</html>



<?php

$servername = "localhost";
$username = "ZhuLiangquan";
$password = "zhuliangquan";
$database = "spat";
 
// 创建连接
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection Failed:" . $conn->connect_error);
} 

$mipep_id = $_GET["mipep_id"];
// echo $mipep_id;
$sql = "select * from pep_mipep where mipep_id = '{$mipep_id}'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
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
                <h2><b> ID:&nbsp<?php echo $row["mipep_id"]?> <b></h2>
                <br>
                <h5 class="bg-info text-uppercase">General information</h5>
                <table class="table table-striped table-bordered" style="table-layout:fixed;word-break:break-all; word-wrap:break-all;font-family: Arial">     
                <thead>　　　　　　　　　　　　　　　　
                    <tr>　　　　
                        <th style="width:15%">ID</th>　　　　　　　　　　
                        <th style="width:5%">Chr</th>
                        <th style="width:8%">Direction</th>
                        <th style="width:15%">Chr Left(TAIR 10)</th>
                        <th style="width:15%">Chr Right(TAIR 10)</th>
                        <th style="width:8%">Length</th>
                        <th style="width:15%">Protein Existence</th>
                        <th style="width: 21%">Positional Relation</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo $row["mipep_id"]?></td>
                            <td><?php echo $row["chro"]?></td>
                            <td><?php echo $row["direction"]?></td>
                            <td><?php echo $row["chr_left"]?></td>
                            <td><?php echo $row["chr_right"]?></td>
                            <td><?php echo $row["seq_len"]?></td>
                            <td><?php echo $row["pr_existence"]?></td>
                            <td><?php echo $row["posrelation"]?></td>
                            <!-- <td>{{ customer.customer_note|truncatechars:30}}</td>　　　＃｜truncatechars:30 默认在页面只显示30个字节 -->
                        </tr>
                </tbody>
                </table>
                <br>
                <h5 class="bg-info text-uppercase">Secretion Signals</h5>
                <table class="table table-striped table-bordered" style="table-layout:fixed;word-break:break-all; word-wrap:break-all;font-family: Arial">     
                <thead>　　　　　　　　　　　　　　　　
                    <tr>　　　　
                        <th style="width:10%">D Score</th>　　　　　　　　　　
                        <th style="width:10%">Signal Start</th>
                        <th style="width:10%">Signal Stop</th>
                        <th style="width:20%">Signal Peptide</th>
                        <th style="width:50%">Propeptide</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo $row["D_score"]?></td>
                            <td><?php echo $row["signal_start"]?></td>
                            <td><?php echo $row["signal_stop"]?></td>
                            <td><?php echo $row["signal_seq"]?></td>
                            <td><?php echo $row["propep"]?></td>
                        </tr>
                </tbody>
                </table>
                <br>
                <h5 class="bg-info text-uppercase">Details</h5>
                <table class="table table-striped table-bordered" style="table-layout:fixed;word-break:break-all; word-wrap:break-all;font-family: Arial">     
                <thead>　　　　　　　　　　　　　　　　
                    <tr>　　　　　　　　　　　　
                        <th style="width:25%">TAIR 10 Annotation</th>
                        <th style="width:25%">NCBI Annotation</th>
                        <th style="width:25%">Uniprot Annotation</th>
                        <th style="width:25%">Other Annotation</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo $row["tair10anno"]?></td>
                            <td><?php echo $row["nranno"]?></td>
                            <td><?php echo $row["unanno"]?></td>
                            <td><?php echo $row["other_anno"]?></td>
                        </tr>
                </tbody>
                </table>
                <h5 class="bg-info text-uppercase">Nucleotide Sequence</h5>
                <div>
                    <p style="word-break:break-all;"><?php echo $row["nuc_seq"]?></p>
                </div>
                <br>
                <h5 class="bg-info text-uppercase">Peptide Sequence</h5>
                <div>
                    <p style="word-break:break-all;"><?php echo $row["pep_seq"]?></p>
                </div>
                <br>
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

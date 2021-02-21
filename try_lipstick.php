<?php
include __DIR__ . '/vendor/autoload.php';
use HackSC\LipStick;
use HackSC\LipSticks;
use HackSC\UserSystem;
error_reporting(E_ERROR);
ini_set("display_errors", 1);
if(!UserSystem::$iscurrentSessionLogin){
    header('Location: signin.php?URL=try_lipstick.php',true,302);
    echo("<script>window.location.href='signin.php?URL=try_lipstick.php';</script>");
    exit("You must sign in before using this page, redirecting...");
}
$colorLimit = 8;
$defaultAlpha = 200;

$req_lipStick = $_POST['lipstick'];
$req_RGB = [$_POST['r'],$_POST['g'],$_POST['b']];
foreach($req_RGB as &$singleRGBA){
	$singleRGBA = intval($singleRGBA);
	if($singleRGBA < 0 || $singleRGBA > 255){
		header('Location: list.php',true,302);
		echo("<script>window.location.href='list.php';</script>");
		exit("You must choose a valid color before using this page, redirecting...");
	}
}
$lipStick = empty($req_lipStick) ? null : LipStick::desearialize(urldecode($req_lipStick));
$allColors = [
	[$req_RGB[0],$req_RGB[1],$req_RGB[2]]
];
if($lipStick !== null){
	$allLips = LipSticks::getLipstickLists();
	foreach($allLips as $otherLips){
		if(count($allColors) >= $colorLimit){
			break;
		}
		if($otherLips->brand == $lipStick->brand && $otherLips->series == $lipStick->series && $otherLips->r !== $lipStick->r && $otherLips->g !== $lipStick->g && $otherLips->b !== $lipStick->b){
			$allColors[] = [$otherLips->r,$otherLips->g,$otherLips->b];
		}
	}
}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Color Changing</title>
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>

		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<link rel="stylesheet" href="css/bubbleStyle.css">
	</head>
	<body>
		<!-- Loading -->
		<div id="loadingContainer" style="position:fixed;top:0px;left:0px;width:100%;height:100%;background-color:rgba(255,255,255,0.5);z-index:2;display:table">
			<div style="display:table-cell;vertical-align: middle;color:#000;text-align:center;">
				<h1 style="font-size:80px;">Loading...</h1>
			</div>
		</div>
		<!-- Wrapper -->
			<div class="wrapper style1">
					<!-- Header -->
					<div id="header" class="skel-panels-fixed">
						<div id="logo">
							<h1><a href="index.php">LIPSTICK STORE</a></h1>
							<h1> | Digital Makeup</h1>
							<span class="tag">by this->getTeamName()</span>
						</div>
						<nav id="nav">
							<ul>
								<li class="active"><a href="list.php">Back to list</a></li>
							</ul>
						</nav>
					</div>
					<!-- Page -->
					<div id="" class="container">
						<div class="row">
							<!-- Sidebar -->
							<div id="sidebar" class="5u">
								<section class="box">
									<header class="major">
										<h2>Your gf</h2>
									</header>
									<div class="row half" >
										<section>
											<ul class="default">
												<img id="pictureContainer" src="img/GF.jpg" width="100%" />
											</ul>
											<p id="msgBox" style="color:#f1f1f1"></p>
										</section>
									</div>
								</section>
							</div>
							
							<!-- Content -->
							<div id="content" style="color:#f1f1f1;" class="7u skel-cell-important">
								<section>
									<header class="major" align="middle">
										<h2>Try On Lipsticks!</h2>
										<span class="byline">pick a color under!</span>
									</header>
									<?php if($lipStick !== null){ ?>
									<p>You are currently trying the <?php echo $lipStick->series; ?> series from <?php echo $lipStick->brand; ?></p>
									<?php } ?>
									
									<div class="color-picker"></div>
									<script src="js/BubbleScript.js"></script>
									<script src="./js/axios.0.021.1.min.js"></script>
									<script src="./js/makeupAPI.js"></script>
									<script>
										function colorResponse(color){
											console.log(color);
											$("#loadingContainer").show();
											callToMakeUpAPI(
												color[0],
												color[1],
												color[2],
												<?php echo $defaultAlpha; ?>,
												function(originalPic, alteredPic){
													sourceStr = "data:image/jpeg;base64, " + alteredPic;
													$('#pictureContainer').attr('src',sourceStr);
													$("#loadingContainer").hide();
												},
												function(errCode, msg){
													$("#msgBox").html(msg);
													$("#loadingContainer").hide();
												}
											);
										}
										$("#loadingContainer").hide();
										baseColor = <?php echo json_encode($allColors); ?>;
										activeColor = <?php echo '[' . implode(',',$req_RGB) . ']'; ?>;
										//colorPicker.init();
										colorPicker.init(baseColor,activeColor,colorResponse);
									</script>
								</section>
							</div>
		
						</div>
					</div>

				<!-- /Page -->
				</div>
				<!-- Copyright -->
				<div id="copyright">
					<div class="container">
						<div class="copyright">
							<p>Design: <a href="">this->getTimeName()</a> Images: <a href="">Internet</a></p>
						</div>
					</div>
				</div>
				
	</body>
</html>
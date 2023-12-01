<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Track Order";
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/order-details.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>agora/vendor/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>agora/index.css">
</head>
<style>

</style> 

<body>
<?php include("include/navbar-brand.php"); ?>
	
	<main class="order-details-page">
		<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congratulations!</strong><span> You can invite others join this channel by click </span><a href="" target="_blank">here</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div id="success-alert-with-token" class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congratulations!</strong><span> Joined room successfully. </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div id="success-alert-with-token" class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congratulations!</strong><span> Joined room successfully. </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="container">
  <h5 class="mt-2">Video Call</h5>
    <form id="join-form">
      <div class="row join-info-group">
          <div class="col-sm" style="display:none">
            <p class="join-info-text">AppID</p>
            <input id="appid" type="text" value="2c35bc66b7364b47aefe72415b2f8cd3" placeholder="enter appid" required>
          </div>
          <div class="col-sm" style="display:none">
            <p class="join-info-text">Token(optional)</p>
            <input id="token" type="text" placeholder="enter token">
          </div>
          <div class="col-sm" style="display:none">
            <p class="join-info-text">Channel</p>
            <input id="channel" type="text" value="Rentzo" placeholder="enter channel name" required>
          </div>
      </div>

      <div class="button-group">
        <button id="leave" type="button" class="btn btn-primary btn-sm" disabled>Leave</button>
      </div>
    </form>

    <div class="row video-group">
      <div class="col">
        <p id="local-player-name" class="player-name"></p>
        <div id="local-player" class="player"></div>
      </div>
      <div class="w-100"></div>
      <div class="col">
        <div id="remote-playerlist"></div>
      </div>
    </div>
  </div>
	</main>

  <?php include("include/footer.php") ?>
  <?php include("include/script.php") ?>
  <script src="<?php echo base_url(); ?>agora/vendor/jquery-3.4.1.min.js"></script>
  <script src="<?php echo base_url(); ?>agora/vendor/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>agora/AgoraRTC_N-4.19.3.js"></script>
  <script src="<?php echo base_url(); ?>agora/index.js"></script>

</body>
</html>

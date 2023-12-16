<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Contact Replay";
    include("include/headTag.php") ?>
	<style>
	
	.form-container {
		background: #f1ecdf;
		border: #e2ddd2 1px solid;
		padding: 20px;
		border-radius: 2px;
	}

	.input-row {
		margin-bottom: 20px;
	}

	.input-row label {
		color: #75726c;
	}

	.input-field {
		width: 100%;
		border-radius: 2px;
		padding: 10px;
		border: #e0dfdf 1px solid;
		box-sizing: border-box;
		margin-top: 2px;
	}

	.span-field {
		font: Arial;
		font-size: small;
		text-decoration: none;
	}

	.btn-submit {
		padding: 10px 60px;
		background: #9e9a91;
		border: #8c8880 1px solid;
		color: #ffffff;
		font-size: 0.9em;
		border-radius: 2px;
		cursor: pointer;
	}

	.errorMessage {
		background-color: #e66262;
		border: #AA4502 1px solid;
		padding: 5px 10px;
		color: #FFFFFF;
		border-radius: 3px;
	}

	.successMessage {
		background-color: #9fd2a1;
		border: #91bf93 1px solid;
		padding: 5px 10px;
		color: #3d503d;
		border-radius: 3px;
		cursor: pointer;
		font-size: 0.9em;
	}

	.info {
		font-size: .8em;
		color: #e66262;
		letter-spacing: 2px;
		padding-left: 5px;
	}
	
	table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}
	
	</style>
	
	
</head>

<body>

    <?php
    include("include/loader.php")
    ?>
    <?php
    include("include/topbar.php")
    ?>
    <?php
    include("include/navbar.php")
    ?>
    <?php
    // include("include/navForMobile.php")
    ?>

    <main class="cart-page">


        <section id="privacy">

            <div class="container">

                <div class="row my-4">
                    <div class="col-8">
                        <h3 class="text-uppercase fw-bold">Contact Replay (<?php echo $ticket_id; ?>)</h3>
                    </div>
                </div>



            
			
			<div class="form-container mb-5 mt-5">
		<form name="frmContact" id="" frmContact"" method="post" action="<?php echo base_url();?>add_ticket_replay_form" enctype="multipart/form-data" onsubmit="return validateContactForm()">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">

			<div class="input-row">
				<label>Title</label> <span id="subject-info" class="info"></span><br />
				<input type="text" class="input-field" name="subject" id="subject" />
			</div>
			<div class="input-row">
				<label>Message</label> <span id="userMessage-info" class="info"></span><br />
				<textarea name="content" id="content" class="input-field" cols="60"
					rows="6"></textarea>
			</div>
			<div>
				<input type="submit" name="send" class="btn-submit" value="Send" />

				<div id="statusMessage"> 
                        <?php
                        if (! empty($message)) {
                            ?>
                            <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
                        <?php
                        }
                        ?>
                    </div>
			</div>
		</form>
	</div>
	
	<table class="mb-5">
	  <tr>
		<th>Ticket Id</th>
		<th>Title</th>
		<th>Description</th>
		<th>Send By</th>
		<th>Date</th>
	  </tr>
	  <?php foreach($get_ticket as $ticket_data) { ?>
	  <tr>
		<td><?php echo $ticket_data['ticket_id']; ?></td>
		<td><?php echo $ticket_data['subject']; ?></td>
		<td><?php echo $ticket_data['content']; ?></td>
		<td><?php echo $ticket_data['type']; ?></td>
		<td><?php echo date('d M Y h:i:s a',strtotime($ticket_data['create_at'])); ?></td>
	  </tr>
	  <?php } ?>
	  
	</table>
	
	</div>

        </section>

    </main>

    <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>
	
	<script>
		
		function validateContactForm() {
			var valid = true;

			$(".info").html("");
			$(".input-field").css('border', '#e0dfdf 1px solid');
			var subject = $("#subject").val();
			var content = $("#content").val();

			
			if (subject == "") {
				$("#subject-info").html("Required.");
				$("#subject").css('border', '#e66262 1px solid');
				valid = false;
			}
			if (content == "") {
				$("#userMessage-info").html("Required.");
				$("#content").css('border', '#e66262 1px solid');
				valid = false;
			}
			return valid;
		}
	</script>

</body>

</html>
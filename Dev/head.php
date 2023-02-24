<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="icon" href="../../Image/logo.png" />
	<link rel="stylesheet" href="../../Style/style.css">
	<link rel="stylesheet" href="../../Style/index.css">
	<link rel="stylesheet" href="../../Style/navbar.css">
	<link rel="stylesheet" href="../../Style/Dashboard/dashboard.css">
	<link rel="stylesheet" href="../../Style/Profile/profile.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js'></script>
	<script type="text/javascript">
		$(function() {
			$("#tab-container").on("click", ".tab-lbl", function() {
				var that = $(this);
				var tabid = that.data("tab");

				$(".tab").each(function(k, v) {
					$(this).hide();
				});

				$(tabid).show();
			});
		});
	</script>
</head>

</html>
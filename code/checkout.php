<html>
	<head>Checkout</head>
	<link rel="stylesheet" type="text/css" href="css/checkout.css">
	<body>
		<div class="wrapper">
			<div class="container">
				<div class="title">Checkout Form</div>
				<div class="input-form">
					<div class="section-1">
						<div class="items">
							<label class="label">Order details</label>
							<input type="text" class="input" readonly>
						</div>
					</div>
					<div class="section-2">
						<div class="items">
							<label class="label">Total</label>
							<input type="text" class="input" readonly>
						</div>
					</div>
					<div class="section-3">
						<div class="items">
							<label class="label">Name</label>
							<input type="text" class="input" placeholder="Coding Market">
						</div>
					</div>
					<div class="section-4">
						<div class="items">
							<label class="label">Total after taxes</label>
							<input type="text" class="input" readonly>
						</div>
					</div>
					<div class="btn">proceed</div>
				</div>
			</div>
		</div>
		<script>
			$(".btn").click(function(){
				$(".input").val("");
			});
		</script>
	</body>
</html>
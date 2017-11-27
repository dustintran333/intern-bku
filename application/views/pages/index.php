<header id="header" class="container-fluid">
	<div class="login-bar">
		<a href=""><img width="40" height="40" src="assets/images/logo.png" style="margin:5px 20px"></a>
		<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-xs btn-info radius-5" style="float:right; margin: 10px 15px; width:auto;display:flex;">Log in</button>
	</div>
</header>

<section class="">
	<div class="container-fluid main-background" style="padding: 0px 0px 30px 0px;">
		<img class="" srcset="http://via.placeholder.com/1500x500">
	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-sm-6">
				<div class="choice">
					<a href="">
						<div class="logo-container">
							<img src="assets/images/FPT_Logo.jpg">
						</div>

						<div class="company-name">
							<p class="text-center" style="padding: 0;">FPT</p>
						</div>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="choice">
					<a href="">
						<div class="logo-container">
							<img src="assets/images/2000px-Intel-logo.svg.png">
						</div>

						<div class="company-name">
							<p class="text-center" style="padding: 0;">Intel</p>
						</div>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="choice">
					<a href="">
						<div class="logo-container">
							<img src="assets/images/Logo-MangoAds.png">
						</div>

						<div class="company-name">
							<p class="text-center" style="padding: 0;">MangoAds</p>
						</div>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="choice">
					<a href="VNG.php">
						<div class="logo-container">
							<img src="assets/images/vng-logo-share-v2.jpg">
						</div>

						<div class="company-name">
							<p class="text-center" style="padding: 0;">VNG</p>
						</div>
					</a>
				</div>
			</div>
		</div>

		<div class="row mt-30">
			<div class="col-lg-3 col-sm-6">
				<div class="choice">
					<a href="">
						<div class="logo-container">
							<img src="assets/images/itemeditorimage_5850051dd903b.png">
						</div>

						<div class="company-name">
							<p class="text-center" style="padding: 0;">Microsoft</p>
						</div>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="choice">
					<a href="">
						<div class="logo-container">
							<img src="assets/images/2000px-Samsung_Logo.svg.png">
						</div>

						<div class="company-name">
							<p class="text-center" style="padding: 0;">Samsung</p>
						</div>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="choice">
					<a href="">
						<div class="logo-container">
							<img src="assets/images/Apple-Logo-black.png">
						</div>

						<div class="company-name">
							<p class="text-center" style="padding: 0;">Apple</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="id01" class="modal">
	<form class="radius-5 form-modified animate" action="/action_page.php">
		<div class="text-center mb-30" >
			<h2 class="font-w-300 fs-42 color-white ">Log in</h2>
			<p class="text-center color-gray fs-17 line-h ">Log in to BK intern management system</p>
		</div>

		<p class="m-0"><input class="input input-sm w-full radius-5 color-white mb-20" placeholder="Username" type="text" required></p>

		<p class="m-0"><input class="input input-sm w-full radius-5 color-white	mb-20" placeholder="Password" type="password" required></p>

		<div class="mb-20">
			<label class="checkbox">
				<input type="checkbox">
				<span></span>
				Remember me
			</label>
			<button type="submit" class="btn btn-sm btn-primary radius-5" style="width:40%;max-width:200px;float:right;">Log in</button>
		</div>
	</form>
</div>

<?php 
	include 'configs/global.php'; 
?>
<!DOCTYPE html>
<!--[if lt IE 8]> <html class="lt-ie10 lt-ie9 lt-ie8" lang="<?= $culture ?>"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie10 lt-ie9" lang="<?= $culture ?>"> <![endif]-->
<!--[if IE 9]>    <html class="lt-ie10" lang="<?= $culture ?>"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="<?= $culture ?>"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title><?= $t[$culture]['form']; ?> | AdFly </title>
	<meta name="description" property="og:description" content="Outils de création publicitaire pour les annonceurs de La Presse+." />
	<meta name="author" content="Jonathan Harvey, Simon Arnold" />
	<meta property="og:type" content="website"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" media="all" href="<?= URL ?>public/styles/form.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body class="no1">
	<header class="main-header">
		<div class="title">
			<h2><?= $t[$culture]['generalData']; ?></h2>
			<h2><?= $t[$culture]['offers']; ?></h2>
		</div>
		<?php if($culture == 'fr') { ?>
			<a href="<?= URL ?>en" class="action lang"></a>
		<?php } else { ?>
			<a href="<?= URL ?>fr" class="action lang"></a>
		<?php } ?>
	</header>

	<form method="post" action="ad.php" enctype="multipart/form-data" autocomplete="off" class="js-form form">

		<div class="steps">
			<!-- === Step 1 ================================================= -->
			<section class="step no1">
				<div class="content">
					<fieldset>
						<div class="row">
							<div class="half field">
								<label>
									<span class="lbl"><?= $t[$culture]['clientNo']; ?></span><br>
									<input type="text" name="noClient" class="input short js-validate" placeholder="123456" required />
								</label>
							</div>

							<div class="half field">
								<label>
									<span class="lbl"><?= $t[$culture]['adNo']; ?></span><br>
									<input type="text" name="noAd" class="input short opt js-validate" placeholder="1234567" />
								</label>
							</div>
						</div>

						<div class="row">
							<div class="half field">
								<label>
									<span class="lbl"><?= $t[$culture]['category']; ?></span><br>
									<select name="category" class="select short js-validate" required>
										<option value="deals" selected><?= $t[$culture]['deals']; ?></option>
										<option value="conferences"><?= $t[$culture]['conferences']; ?></option>
										<option value="cruise"><?= $t[$culture]['cruise']; ?></option>
										<option value="adventures"><?= $t[$culture]['adventures']; ?></option>
										<option value="escapades"><?= $t[$culture]['escapades']; ?></option>
										<option value="circuits"><?= $t[$culture]['circuits']; ?></option>
										<option value="packages"><?= $t[$culture]['packages']; ?></option>
										<option value="destinationWorld"><?= $t[$culture]['destinationWorld']; ?></option>
									</select>
								</label>
							</div>

							<div class="half field">
								<label>
									<span class="lbl">Logo</span><br>
									<div class="btn blue file">
										<span class="text"><?= $t[$culture]['uploadImage']; ?></span>
										<input type="file" accept="image/*" capture="camera" name="logo" class="file-input js-validate" required>
									</div>
									<span class="preview"></span>
								</label>
							</div>
						</div>

						<div class="row field format">
							<label class="lbl"><?= $t[$culture]['format']; ?></label><br>
							<input type="radio" name="format" value="480x324" checked />
							<input type="radio" name="format" value="480x152" />
							<input type="radio" name="format" value="230x324" />
							<input type="radio" name="format" value="230x152" />
						</div>
					</fieldset>

					<footer class="footer">
						<div class="btn blue rgt js-nextStep"><?= $t[$culture]['next']; ?></div>
					</footer>
				</div>
			</section>

			<!-- === Step 2 ================================================= -->
			<section class="step no2">
				
				<div class="content">
					<header class="header">
						<input name="screensNbr" type="hidden" value="0" />
						<a href="#" class="btn rgt addScreen"><?= $t[$culture]['addScreen']; ?></a>
					</header>
					<div class="screensList">
						<!-- public/templates/screen-tpl.mustache.html -->
					</div>

					<footer class="footer">
						<div class="btn lft js-previousStep"><?= $t[$culture]['previous']; ?></div>
						<div class="btn blue rgt js-nextStep"><?= $t[$culture]['next']; ?></div>
					</footer>
				</div>
			</section>

			<!-- === Step 3 ================================================= -->
			<section class="step no3">
				<label>
					<span class="lbl"><?= $t[$culture]['legal']; ?></span><br>
					<textarea name="legal" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt risus ultricies diam tristique bibendum. Vestibulum lacinia vehicula auctor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis consectetur felis nec massa pretium pharetra."></textarea>
				</label><br>

				<input type="reset" value="<?= $t[$culture]['cancel']; ?>" class="btn js-reset">
				<input type="submit" value="<?= $t[$culture]['submit']; ?>" class="btn blue js-submit" >
			</section>
		</div>
	</form>

	<footer class="main-footer">
		<div class="legend">
			<span class="color opt"></span> <?= $t[$culture]['optionalField']; ?>
		</div>
	</footer>

	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?= URL ?>public/scripts/min/jquery-1.11.0.min.js"> \x3C/script>')</script>
    <script src="<?= URL ?>public/scripts/min/mustache.min.js"></script>
    <script src="<?= URL ?>public/scripts/min/jquery.validate.min.js"></script>
    <script src="<?= URL ?>public/scripts/min/jquery.mask.min.js"></script>
    <script src="<?= URL ?>public/scripts/min/utilities.min.js"></script>
	<script src="<?= URL ?>public/scripts/min/form.min.js"></script>
	<script>
		$(document).ready(function() {
          _g = new app("<?= $culture ?>", "<?= URL ?>");
        });
	</script>
</body>
</html>
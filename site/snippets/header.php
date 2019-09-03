<!doctype html>
<html lang="en-US">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title><?= $site->title() ?> | <?= $page->title() ?></title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Vollkorn:400,400i,600,600i,700,700i,900,900i&display=swap&subset=latin-ext" />
	<?= css(['assets/css/index.css', '@auto']) ?>

</head>

<body>

	<div class="page">

		<header class="header">
			<a class="logo" href="<?= $site->url() ?>"><?= $site->title() ?></a>

			<nav id="menu" class="menu">
				<?php foreach ($site->children()->listed() as $item): ?>
				<?= $item->title()->link() ?>
				<?php endforeach ?>
			</nav>
		</header>

<?php snippet('header') ?>

<main>
	<header class="intro">
		<h1><?= $page->title() ?></h1>
	</header>

	<div class="notes">
		<?php foreach ($page->children()->listed()->sortBy('date', 'desc') as $drink): ?>
		<article class="note">
			<header class="note-header">
				<a href="<?= $drink->url() ?>">
					<h2><?= $drink->title() ?></h2>
					<time><?= $drink->date()->toDate('d F Y') ?></time>
				</a>
			</header>
		</article>
		<?php endforeach ?>
	</div>

</main>

<?php snippet('footer') ?>

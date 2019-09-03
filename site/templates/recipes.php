<?php snippet('header') ?>

<main>
	<header class="intro">
		<h1><?= $page->title() ?></h1>
	</header>

	<ul class="albums" <?= attr(['data-even' => $page->children()->listed()->isEven()], ' ') ?>>
		<?php foreach ($page->children()->listed() as $recipe): ?>
		<li>
			<a href="<?= $recipe->url() ?>">
				<figure>
					<?php if ($cover = $recipe->cover()): ?>
					<?= $cover->crop(800, 1000) ?>
					<?php endif ?>
					<figcaption><?= $recipe->title() ?></figcaption>
				</figure>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
</main>

<?php snippet('footer') ?>

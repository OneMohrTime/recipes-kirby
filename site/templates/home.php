<?php snippet('header') ?>

<main>
	<header class="intro">
		<h1><?= $site->title() ?></h1>
	</header>

	<ul class="grid">
		<?php foreach (page('recipes')->children()->listed() as $recipe): ?>
		<li>
			<a href="<?= $recipe->url() ?>">
				<figure>
					<?php if ($cover = $recipe->cover()): ?>
					<?= $cover->resize(1024, 1024) ?>
					<?php endif ?>
					<figcaption>
						<span>
							<span class="example-name"><?= $recipe->title() ?></span>
						</span>
					</figcaption>
				</figure>
			</a>
		</li>
		<?php endforeach ?>
	</ul>

</main>

<?php snippet('footer') ?>

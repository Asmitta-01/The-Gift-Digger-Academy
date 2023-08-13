<?php

/**
 * Template part for displaying posts
 *
 * @subpackage Education Insight
 * @since 1.0
 */

if (get_post_type() == 'tgd_course') :
	$amount = floatval(get_post_meta(get_the_ID(), 'tgd_course_amount', true));
	$bought = rand(0, 1) == 0;
?>
	<nav class="breadcrumb">
		<a class="breadcrumb-item font-weight-bold text-decoration-none" href="<?= get_home_url() ?>">Accueil</a>
		<a class="breadcrumb-item font-weight-bold text-decoration-none" href="#">Formations</a>
		<span class="breadcrumb-item active" aria-current="page"><?php the_title() ?></span>
	</nav>
<?php
endif;
?>

<div id="single-post-section" class="single-post-page entry-content">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="postbox smallpostimage">
			<div class="padd-box">
				<h2><?php the_title(); ?></h2>
				<?php the_post_thumbnail(attr: ['style' => 'height: 460px; object-fit: cover;', 'class' => 'w-100']); ?>
				<div class="overlay">
					<?php if (get_post_type() == 'tgd_course') : ?>
						<div class="small grid-post-meta-container p-2">
							<span class="entry-author">
								<?= get_avatar(get_the_author_meta('ID'), 40, '', get_the_author() . " avatar", ['class' => 'rounded-circle mr-1']) ?>
								<a class="text-decoration-none font-weight-bold" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
							</span>
							<span class="p-2">&bullet;</span>
							<span class="entry-category">
								<i class="fas fa-chart-pie mr-1"></i>
								<a class="font-weight-bold text-decoration-none" href="http://"><?= "Dance" ?></a>
							</span>
							<span class="p-2">&bullet;</span>
							<span class="entry-duration">
								<i class="fas fa-clock mr-1"></i>
								<?= random_int(3, 12) . ' heures' ?>
							</span>
						</div>
					<?php else :  ?>
						<div class="date-box">
							<?php if (get_option('education_insight_date', false) != '1') { ?>
								<span><i class="far fa-calendar-alt"></i><?php the_time(get_option('date_format')); ?></span>
							<?php } ?>
							<?php if (get_option('education_insight_admin', false) != '1') { ?>
								<span class="entry-author"><i class="far fa-user"></i><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></span>
							<?php } ?>
							<?php if (get_option('education_insight_comment', false) != '1') { ?>
								<span class="entry-comments"><i class="fas fa-comments"></i> <?php comments_number(__('0 Comments', 'education-insight'), __('0 Comments', 'education-insight'), __('% Comments', 'education-insight')); ?></span>
							<?php } ?>
						</div>
					<?php endif; ?>
				</div>
				<p><?php the_content(); ?></p>
				<div class="">
					<?php if (!$bought) : ?>
						<div class="d-flex justify-content-between alert alert-info">
							<div>
								<span>Coût de la formation</span><br>
								<span>Frais supplémentaires (<?= POURCENTAGE_GISEL_PAY ?>%)</span><br>
								<hr>
								<span class="font-weight-bold">Total</span>
							</div>
							<div class="font-weight-bold">
								<span>XAF <?= $amount ?></span><br>
								<span>XAF <?= $amount * POURCENTAGE_GISEL_PAY / 100 ?></span>
								<hr>
								<span>XAF <?= $amount * (1 + POURCENTAGE_GISEL_PAY / 100) ?></span>
							</div>
						</div>
						<button id="payment-btn">Acheter</button>
					<?php else : ?>
						<div class="alert grid-post-meta-container">Acheté</div>
					<?php endif; ?>
				</div>
				<?php if (get_post_type() == 'tgd_course' && $bought) : ?>
					<?php if (!empty(get_post_meta(get_the_ID(), 'tgd_course_videos'))) : ?>
						<div class="mt-5">
							<h2 class="border-bottom-orange pb-2">Videos</h2>
							<div class="row">
								<?php foreach (get_post_meta(get_the_ID(), 'tgd_course_videos', true) as $video) : ?>
									<?php if (isset($video['title']) && isset($video['path'])) : ?>
										<div class="col-6">
											<div class="card border-0">
												<video class="card-img-top mb-3" controls src="<?= $video['path'] ?>" poster="<?= the_post_thumbnail_url() ?>" controlslist="nodownload" type="<?= $video['type'] ?>">
													Sorry, your browser doesn't support embedded videos.
												</video>
												<div class="card-body">
													<h4 class="card-title"><?= $video['title'] ?></h4>
												</div>
											</div>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<?php
if (!$bought) {
	echo get_js_payment_code(
		[
			'description' => "Achat de la formation: " . get_the_title(),
			'label' => "Achat d'une formation",
			'choice' => get_the_title()
		],
		floatval($amount ?? 0) * (1 + POURCENTAGE_GISEL_PAY / 100)
	);
}
?>
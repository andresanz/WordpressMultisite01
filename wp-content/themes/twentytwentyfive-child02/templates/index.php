<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:query {"queryId":0,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"layout":{"type":"constrained"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default","columnCount":3}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40","margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)">
				<!-- wp:post-featured-image {"isLink":true,"width":"","height":"","style":{"spacing":{"margin":{"bottom":"0"}}}} /-->
				<!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group">
					<!-- wp:post-title {"isLink":true,"style":{"spacing":{"margin":{"top":"0"}},"typography":{"fontFamily":"var:preset|font-family|primary"}}} /-->
					<!-- wp:group {"style":{"spacing":{"blockGap":"8px"},"typography":{"fontSize":"14px"}},"layout":{"type":"flex"}} -->
					<div class="wp-block-group" style="font-size:14px">
						<!-- wp:post-date /-->
						<!-- wp:paragraph -->
						<p>—</p>
						<!-- /wp:paragraph -->
						<!-- wp:post-author-name {"isLink":true} /-->
					</div>
					<!-- /wp:group -->
					<!-- wp:post-excerpt {"moreText":"Read more","showMoreOnNewLine":false,"excerptLength":35,"style":{"typography":{"fontFamily":"var:preset|font-family|primary"}}} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:query -->
</main>
<!-- /wp:group -->

<!-- wp:group {"tagName":"footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"backgroundColor":"secondary","layout":{"type":"constrained"}} -->
<footer class="wp-block-group has-secondary-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontFamily":"var:preset|font-family|primary"}}} -->
    <p class="has-text-align-center" style="font-family:var(--wp--preset--font-family--primary)">© 2025 Your Website. All rights reserved.</p>
    <!-- /wp:paragraph -->
</footer>
<!-- /wp:group -->
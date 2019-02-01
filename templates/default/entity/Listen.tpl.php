<article class="p-listen-of">
	<style>
	.idno-listen .u-photo{
		margin-right: 1em;
		margin-bottom: 1em;
		max-width: 150px;
		}
	.listenArtist{
		 font-style: italic;
		}
	.h-cite{
		border-bottom: 1px solid #ccc;
		}
	</style>
	<h2 class="hidden">Listened to <?= htmlentities(strip_tags($vars['object']->getTitle()), ENT_QUOTES, 'UTF-8'); ?></h2>
    <div class="h-cite clearfix">
        <h2>
	       <?php if (empty($vars['object']->getMediaURL())) { ?>
			<!--Start type icon-->
			<span>
			<?php if ($vars['object']->listenType == 'song') { ?>
			<i class="fas fa-music"></i>
			<?php } else if ($vars['object']->listenType == 'album') { ?>
			<i class="fas fa-music"></i>
			<?php } else if ($vars['object']->listenType == 'soundtrack') { ?>
			<i class="fas fa-film"></i></i>
			<?php } else if ($vars['object']->listenType == 'stream') { ?>
			<i class="fas fa-rss"></i>
			<?php } else if ($vars['object']->listenType == 'podcast') { ?>
			<i class="fas fa-rss"></i>
			<?php } else if ($vars['object']->listenType == 'audiobook') { ?>
			<i class="fas fa-book-reader"></i>
			<?php }; ?>
			</span>
			<!--End type icon-->
	       Listened to
	       <!--Start type description-->
			<span>
			<?php if ($vars['object']->listenType == 'song') { ?>
			the song,
			<?php } else if ($vars['object']->listenType == 'album') { ?>
			the album,
			<?php } else if ($vars['object']->listenType == 'soundtrack') { ?>
			the soundtrack of
			<?php } else if ($vars['object']->listenType == 'stream') { ?>
			the stream of
			<?php } else if ($vars['object']->listenType == 'podcast') { ?>
			the podcast,
			<?php } else if ($vars['object']->listenType == 'audiobook') { ?>
			the audiobook of
			<?php }; ?>
			</span>
			<!--End type description-->
	       <!--Start cover art-->

                <?php
                    if ($attachments = $vars['object']->getAttachments()) {
                        foreach ($attachments as $attachment) {
                            $mainsrc = $attachment['url'];
                            if (!empty($vars['object']->thumbnail_large)) {
                                $src = $vars['object']->thumbnail_large;
                            } else if (!empty($vars['object']->thumbnail)) { // Backwards compatibility
                                $src = $vars['object']->thumbnail;
                            } else {
                                $src = $mainsrc;
                            }

                            // Patch to correct certain broken URLs caused by https://github.com/idno/known/issues/526
                            $src = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\site()->config()->getDisplayURL(), $src);
                            $mainsrc = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\site()->config()->getDisplayURL(), $mainsrc);

                            ?>
                             <a href="<?= $this->makeDisplayURL($mainsrc) ?>"><img src="<?= $this->makeDisplayURL($src) ?>" class="u-photo pull-left"/></a>
                        <?php
                        }
                    }
                ?>
                <!--End cover art-->
	       <span class="p-name"><?= htmlentities(strip_tags($vars['object']->getTitle()), ENT_QUOTES, 'UTF-8'); ?></span>
	       <?php } else { ?>
        <!--Start cover art-->
                <?php
                    if ($attachments = $vars['object']->getAttachments()) {
                        foreach ($attachments as $attachment) {
                            $mainsrc = $attachment['url'];
                            if (!empty($vars['object']->thumbnail_large)) {
                                $src = $vars['object']->thumbnail_large;
                            } else if (!empty($vars['object']->thumbnail)) { // Backwards compatibility
                                $src = $vars['object']->thumbnail;
                            } else {
                                $src = $mainsrc;
                            }

                            // Patch to correct certain broken URLs caused by https://github.com/idno/known/issues/526
                            $src = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\site()->config()->getDisplayURL(), $src);
                            $mainsrc = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\site()->config()->getDisplayURL(), $mainsrc);

                            ?>
                             <a href="<?= $this->makeDisplayURL($mainsrc) ?>"><img src="<?= $this->makeDisplayURL($src) ?>" class="u-photo pull-left"/></a>
                        <?php
                        }

                    }
                ?>
				<!--End cover art-->
    <!--Start type icon-->
    <span>
<?php if ($vars['object']->listenType == 'song') { ?>
<i class="fas fa-music"></i>
<?php } else if ($vars['object']->listenType == 'album') { ?>
<i class="fas fa-music"></i>
<?php } else if ($vars['object']->listenType == 'soundtrack') { ?>
<i class="fas fa-film"></i></i>
<?php } else if ($vars['object']->listenType == 'stream') { ?>
<i class="fas fa-rss"></i>
<?php } else if ($vars['object']->listenType == 'podcast') { ?>
<i class="fas fa-rss"></i>
<?php } else if ($vars['object']->listenType == 'audiobook') { ?>
<i class="fas fa-book-reader"></i>
<?php }; ?>
</span>
<!--End type icon-->
    Listened to
    <!--Start type description-->
			<span>
			<?php if ($vars['object']->listenType == 'song') { ?>
			the song,
			<?php } else if ($vars['object']->listenType == 'album') { ?>
			the album,
			<?php } else if ($vars['object']->listenType == 'soundtrack') { ?>
			the soundtrack of
			<?php } else if ($vars['object']->listenType == 'stream') { ?>
			the stream of
			<?php } else if ($vars['object']->listenType == 'podcast') { ?>
			the podcast,
			<?php } else if ($vars['object']->listenType == 'audiobook') { ?>
			the audiobook of
			<?php }; ?>
			</span>
			<!--End type description-->
<a href="<?= $vars['object']->getMediaURL() ?>" class="p-name"><?= htmlentities(strip_tags($vars['object']->getTitle()), ENT_QUOTES, 'UTF-8'); ?></a>
    <?php
    }
    ?>

</h2>
 <?php
                if (!empty($vars['object']->getListenAuthor())) {
                ?>
                <p class="listenArtist">By  <?= $vars['object']->getlistenAuthor() ?></p>
                <?php
                }
                ?>
            </div>
            <div class="e-content">
				<?= $this->__(['value' => $vars['object']->body, 'object' => $vars['object']])->draw('forms/output/richtext'); ?>
            </div>

            <div class="hidden">
                <p class="h-card vcard p-author">
                    <a href="<?= $vars['object']->getOwner()->getURL(); ?>" class="icon-container">
                        <img class="u-logo logo u-photo photo" src="<?= $vars['object']->getOwner()->getIcon(); ?>"/>
                    </a>
                    <a class="p-name fn u-url url" href="<?= $vars['object']->getOwner()->getURL(); ?>"><?= $vars['object']->getOwner()->getName(); ?></a>
                    <a class="u-url" href="<?= $vars['object']->getOwner()->getURL(); ?>">
                        <!-- This is here to force the hand of your MF2 parser --></a>
                </p>
            </div>
</article>

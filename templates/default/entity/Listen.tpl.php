<article class="p-listen-of">

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

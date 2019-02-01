<?= $this->draw('entity/edit/header'); ?>
<?php

    $autosave = new \Idno\Core\Autosave();
    if (!empty($vars['object']->body)) {
        $body = $vars['object']->body;
    } else {
        $body = $autosave->getValue('listen', 'bodyautosave');
    }
    if (!empty($vars['object']->title)) {
        $title = $vars['object']->title;
    } else {
        $title = $autosave->getValue('listen', 'title');
    }
    if (!empty($vars['object']->listenAuthor)) {
        $listenAuthor = $vars['object']->listenAuthor;
    } else {
        $listenAuthor = $autosave->getValue('listen', 'listenAuthor');
    }
    if (!empty($vars['object']->listenType)) {
        $listenType = $vars['object']->listenType;
    } else {
        $listenType = $autosave->getValue('listen', 'listenType');
    }
    if (!empty($vars['object']->mediaURL)) {
        $mediaURL = $vars['object']->mediaURL;
    } else {
        $mediaURL = $autosave->getValue('listen', 'mediaURL');
    }
    if (!empty($vars['object'])) {
        $object = $vars['object'];
    } else {
        $object = false;
    }

    /* @var \Idno\Core\Template $this */

?>
    <form action="<?= $vars['object']->getURL() ?>" method="post" enctype="multipart/form-data">

        <div class="row">

            <div class="col-md-8 col-md-offset-2 edit-pane">


                <?php

                    if (empty($vars['object']->_id)) {

                        ?>
                        <h4>What did you listen to?</h4>
                    <?php

                    } else {

                        ?>
                        <h4>Edit what you listened to</h4>
                    <?php

                    }

                ?>

                <?php

                    if (empty($vars['object']->_id) || empty($vars['object']->getAttachments())) {

                        ?>
                        <div id="photo-preview"></div>
                        	<p><span class="btn btn-primary btn-file"><i class="fa fa-camera"></i> <span id="photo-filename">Select a image</span> <input type="file" name="photo" id="photo" class="col-md-9 form-control" accept="image/*;capture=camera" onchange="photoPreview(this)"/></span></p>

                    <?php

                    }

                ?>
                <div class="content-form">
                    <style>
                        .listenType-block {
                            margin-bottom: 1em;
                        }
						a.listenType {
                            background-color: #fff;
                            background-image: none;
                            border: 1px solid #cccccc;
                            box-shadow: none;
                            text-shadow: none;
                            color: #555555;
                        }

                        .listenType .caret {
                                border-top: 4px solid #555;
                        }

                    </style>
                    <p><label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Title of the song, podcast, album, etc." value="<?= htmlspecialchars($title) ?>" class="form-control"/></p>

                    <p><label for="mediaURL">Media Link</label>
                    <input type="text" name="mediaURL" id="mediaURL" placeholder="Link to the song, podcast, album, etc." value="<?= htmlspecialchars($mediaURL) ?>" class="form-control"/></p>

                    <p>
                    <label for="listenType">Type</label>
<select class="form-control" name="listenType" id="listenType">
  <option data-listenType="song" value="song" <?php if ($listenType == 'song' ) echo 'selected' ; ?>>song</option>
  <option data-listenType="album" value="album" <?php if ($listenType == 'album' ) echo 'selected' ; ?>>album</option>
  <option data-listenType="soundtrack" value="soundtrack" <?php if ($listenType == 'soundtrack' ) echo 'selected' ; ?>>soundtrack</option>
  <option data-listenType="stream" value="stream" <?php if ($listenType == 'stream' ) echo 'selected' ; ?>>stream</option>
  <option data-listenType="podcast" value="podcast" <?php if ($listenType == 'podcast' ) echo 'selected' ; ?>>podcast</option>
  <option data-listenType="audiobook" value="audiobook" <?php if ($listenType == 'audiobook' ) echo 'selected' ; ?>>audio book</option>
</select></p>







<!-- styled listen type -->
<!--
                    <label for="listenType-id">Type</label>
                    <div class="listenType-block">
                        <input type="hidden" name="listenType" id="listenType-id" value="<?= $listenType ?>">
                        <div id="listenType" class="listenType">
                            <div class="btn-group">
                                <a class="btn dropdown-toggle listenType" data-toggle="dropdown" href="#" id="listenType-button" aria-expanded="false">
                                    Choose <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-listenType="song" class="listenType-option"><i class="fas fa-music"></i>song</a></li>
                                    <li><a href="#" data-listenType="album" class="listenType-option"><i class="fas fa-music"></i>album</a></li>
                                    <li><a href="#" data-listenType="stream" class="listenType-option"><i class="fas fa-rss"></i>stream</a></li>
									<li><a href="#" data-listenType="podcast" class="listenType-option"><i class="fas fa-rss"></i>podcast</a></li>
									<li><a href="#" data-listenType="audioBook" class="listenType-option"><i class="fas fa-book-reader"></i>audio book</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('.listenType-option').each(function () {
                                if ($(this).data('listenType') == $('#listenType-id').val()) {
                                    $('#listenType-button').html($(this).html() + ' <span class="caret"></span>');
                                }
                            })
                        });
                        $('.listenType-option').on('click', function () {
                            $('#listenType-id').val($(this).data('listenType'));
                            $('#listenType-button').html($(this).html() + ' <span class="caret"></span>');
                            $('#listenType-button').click();
                            return false;
                        });

                        $('#listenType-id').on('change', function () {
                        });
                    </script>
                    -->
                    <!-- end styled watch type -->

                    <p><label for="listenAuthor">Artist</label>
                    <input type="text" name="listenAuthor" id="listenAuthor" placeholder="Who is the artist?" value="<?= htmlspecialchars($listenAuthor) ?>" class="form-control"/></p>


                </div>

                <p><label for="body">Summary</label>
                <?= $this->__([
                    'name' => 'body',
                    'value' => $body,
                    'object' => $object,
                    'wordcount' => true
                ])->draw('forms/input/richtext')?>
                <?= $this->draw('entity/tags/input'); ?>

                <?php if (empty($vars['object']->_id)) echo $this->drawSyndication('article'); ?>
                <?php if (empty($vars['object']->_id)) { ?><input type="hidden" name="forward-to" value="<?= \Idno\Core\site()->config()->getDisplayURL() . 'content/all/'; ?>" /><?php } ?>

                <?= $this->draw('content/access'); ?></p>

                <p class="button-bar ">

                    <?= \Idno\Core\site()->actions()->signForm('/listen/edit') ?>
                    <input type="button" class="btn btn-cancel" value="Cancel" onclick="tinymce.EditorManager.execCommand('mceRemoveEditor',false, 'body'); hideContentCreateForm();"/>
                    <input type="submit" class="btn btn-primary" value="Publish"/>

                </p>

            </div>

        </div>
    </form>

    <script>
        //if (typeof photoPreview !== function) {
        function photoPreview(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo-preview').html('<img src="" id="photopreview" style="display:none; width: 400px">');
                    $('#photo-filename').html('Choose different photo');
                    $('#photopreview').attr('src', e.target.result);
                    $('#photopreview').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        //}
    </script>

    <div id="bodyautosave" class="hidden"></div>
<?= $this->draw('entity/edit/footer'); ?>


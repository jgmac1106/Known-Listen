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
    if (!empty($vars['object']->listenauthor)) {
        $listenauthor = $vars['object']->listenauthor;
    } else {
        $listenauthor = $autosave->getValue('listen', 'listenauthor');
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
                        <h4>What is that song or podcast?</h4>
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
                        <p>
                                <span class="btn btn-primary btn-file">
                                        <i class="fa fa-camera"></i> <span
                                        id="photo-filename">Select a photo</span> <input type="file" name="photo"
                                                                                         id="photo"
                                                                                         class="col-md-9 form-control"
                                                                                         accept="image/*;capture=camera"
                                                                                         onchange="photoPreview(this)"/>

                                    </span>
                        </p>

                    <?php

                    }

                ?>
                <div class="content-form">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Title of the song, podcast, album, etc." value="<?= htmlspecialchars($title) ?>" class="form-control"/>

                    <label for="mediaURL">Media Link</label>
                    <input type="text" name="mediaURL" id="mediaURL" placeholder="Link to the song, podcast, album, etc." value="<?= htmlspecialchars($mediaURL) ?>" class="form-control"/>

                    <!-- styled listen type -->
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
                    <!-- end styled watch type -->

                    <label for="listenauthor">Artist</label>
                    <input type="text" name="listenauthor" id="listenauthor" placeholder="Who is the artist?" value="<?= htmlspecialchars($listenauthor) ?>" class="form-control"/>
                </div>

                <label for="body">Summary</label>
                <?= $this->__([
                    'name' => 'body',
                    'value' => $body,
                    'object' => $object,
                    'wordcount' => true
                ])->draw('forms/input/richtext')?>
                <?= $this->draw('entity/tags/input'); ?>

                <?php if (empty($vars['object']->_id)) echo $this->drawSyndication('article'); ?>
                <?php if (empty($vars['object']->_id)) { ?><input type="hidden" name="forward-to" value="<?= \Idno\Core\site()->config()->getDisplayURL() . 'content/all/'; ?>" /><?php } ?>

                <?= $this->draw('content/access'); ?>

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

    <div id="bodyautosave" style="display:none"></div>
<?= $this->draw('entity/edit/footer'); ?>


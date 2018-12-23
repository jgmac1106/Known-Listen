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
    if (!empty($vars['object']->player)) {
        $player = $vars['object']->player;
    } else {
        $player = $autosave->getValue('listen', 'player');
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
                        <h4>Edit what uyou listened to</h4>
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

                    <style>
                        .listenType-block {
                            margin-bottom: 1em;
                        }
                    </style>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="The title of the song, podcast, or album" value="<?= htmlspecialchars($title) ?>" class="form-control"/>                    
                    
                    <label for="title">Media Link</label>
                    <input type="text" name="mediaURL" id="mediaURL" placeholder="Link to song, YouTube, or podcast" value="<?= htmlspecialchars($mediaURL) ?>" class="form-control"/>                    
                    
                    <!-- styled watch type -->
                    <label for="listenType">Movie or TV Show?</label>
                    <div class="listenType-block">
                        <input type="hidden" name="listenType" id="listenType-id" value="<?= $listenType ?>">
                        <div id="listenType" class="listenType">
                            <div class="btn-group">
                                <a class="btn dropdown-toggle listenType" data-toggle="dropdown" href="#" id="listenType-button" aria-expanded="false">
                                    <i class="fa fa-film"></i> Movie <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-listenType="movie" class="listenType-option"><i class="fa fa-film"></i> Movie</a></li>
                                    <li><a href="#" data-listenType="tv" class="listenType-option"><i class="fa fa-tv"></i> TV Show</a></li>
                    <li><a href="#" data-listenType="video" class="listenType-option"><i class="fa fa-video"></i>Video</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <style>
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

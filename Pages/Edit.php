<?php

    namespace IdnoPlugins\Listen\Pages {

        use Idno\Core\Autosave;

        class Edit extends \Idno\Common\Page {

            function getContent() {

                $this->createGatekeeper();    // This functionality is for logged-in users only

                // Are we loading an entity?
                if (!empty($this->arguments)) {
                    $object = \IdnoPlugins\Listen\Listen::getByID($this->arguments[0]);
                } else {
                    $object = new \IdnoPlugins\Listen\Listen();
                }

                $t = \Idno\Core\site()->template();
                $body = $t->__(array(
                    'object' => $object
                ))->draw('entity/Listen/edit');

                if (empty($vars['object']->_id)) {
                    $title = 'What did you listen to?';
                } else {
                    $title = 'Edit what you listend to';
                }

                if (!empty($this->xhr)) {
                    echo $body;
                } else {
                    $t->__(array('body' => $body, 'title' => $title))->drawPage();
                }
            }

            function postContent() {
                $this->createGatekeeper();

                $new = false;
                if (!empty($this->arguments)) {
                    $object = \IdnoPlugins\Listen\Listen::getByID($this->arguments[0]);
                }
                if (empty($object)) {
                    $object = new \IdnoPlugins\Listen\Listen();
                }

                if ($object->saveDataFromInput($this)) {
                    (new \Idno\Core\Autosave())->clearContext('Listen');
                    $forward = $this->getInput('forward-to', $object->getDisplayURL());
                    $this->forward($forward);
                }

            }

        }

    }

<?php

    namespace IdnoPlugins\listen {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                \Idno\Core\site()->addPageHandler('/listen/edit/?', '\IdnoPlugins\listen\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/listen/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\listen\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/listen/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\listen\Pages\Delete');
                \Idno\Core\site()->addPageHandler('/listen/([A-Za-z0-9]+)/.*', '\Idno\Pages\Entity\View');
                
                \Idno\Core\site()->addPageHandler('/listen/webhook/', '\IdnoPlugins\listen\Pages\Endpoint', false);
            }

            /**
             * Get the total file usage
             * @param bool $user
             * @return int
             */
            function getFileUsage($user = false) {

                $total = 0;

                if (!empty($user)) {
                    $search = ['user' => $user];
                } else {
                    $search = [];
                }

                if ($listens = listen::get($search,[],9999,0)) {
                    foreach($listens as $listen) {
                        if ($listen instanceof listen) {
                            if ($attachments = $listen->getAttachments()) {
                                foreach($attachments as $attachment) {
                                    $total += $attachment['length'];
                                }
                            }
                        }
                    }
                }

                return $total;
            }

        }

    }

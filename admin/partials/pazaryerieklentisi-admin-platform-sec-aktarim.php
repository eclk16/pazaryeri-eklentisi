<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link        https://emrecolak.net
 * @since      1.0.0
 *
 * @package    Pazaryerieklentisi
 * @subpackage Pazaryerieklentisi/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<form action="" method="POST" id="pazaryerieklentisi" name="pazaryerieklentisi">
    <div id="poststuff" class="ana-kapsayici">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="postbox-container-1" class="postbox-container">
                <?php require_once('right.php'); ?>
            </div>
            <div id="postbox-container-2" class="postbox-container">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">

                    <?php foreach($platforms as $plat): ?>
                        <?php if(get_option(OPTION_PREFİX.$plat['platform'].'_durum') == 'on'): ?>
                            <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
                                <div id="submitdiv" class="postbox ">
                                    <div class="postbox-header">
                                        <h2 class="hndle ui-sortable-handle"><?=$plat['name']?></h2>
                                    </div>
                                    <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                            <div id="minor-publishing">
                                                <div id="misc-publishing-actions">
                                                    <img src="<?=$plat['logo']?>" style="width: 100%">
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <div id="major-publishing-actions">

                                                <div id="publishing-action">
                                                    <span class="spinner"></span>
                                                    <a class="button button-primary button-large" href="?page=pazaryeri-eklentisi-aktarim&platform=<?=$plat['platform']?>">Seç</a>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach;?>

                </div>
                <div id="advanced-sortables" class="meta-box-sortables ui-sortable empty-container"></div>
            </div>
        </div>
        <br class="clear">
    </div>
</form>
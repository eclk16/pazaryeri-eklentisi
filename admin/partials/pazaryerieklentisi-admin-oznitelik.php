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
                    <table class="wp-list-table widefat fixed striped table-view-list posts">
                        <thead>
                        <tr>
                            <th scope="col" colspan="7" id="title" class=""><a href="?page=pazaryeri-eklentisi">Ayarlar</a> >
                                <a href="?page=pazaryeri-eklentisi-kategori&platform=<?=$platform?>">Kategori Eşleştirme</a> >
                                <a href="?page=pazaryeri-eklentisi-ozellik&platform=<?=$platform?>&kategori=<?=$_GET['kategori']?>"><?=get_term( $_GET['kategori'] )->name?></a> >
                                <?=$_GET['ozellikname']?> >
                                <span><?=strtoupper($platform)?> Öznitelik Eşleştirme</span></th>
                        </tr>
                        </thead>
                        <tbody id="the-list" >
                        <tr style="border-bottom: 1px solid #d3d3d3;">
                            <th colspan="2">Pazaryerindeki Öznitelik</th>
                            <th colspan="5">Buradaki Öznitelik</th>
                        </tr>
                        <?php

                        $tt = '';
                        foreach($terms as $t){
                            $tt .= '<option value="'.$t->term_id.'">'.$t->slug.'</option>';
                        }

                        foreach($oznitelikler as $term) {
                            echo '  <tr>
                                    <td colspan="2" class="colspanchange">'.$term['name'].'</td> 
                                    <td colspan="5" class="colspanchange">
                                        <select class="form-control filterCategory" name="'.OPTION_PREFİX.'oznitelik_'.$platform.'_'.$term['value_id'].'">
                                            <option disabled selected>Seçiniz</option>
                                            '.str_replace('<option value="'.get_option(OPTION_PREFİX.'oznitelik_'.$platform.'_'.$term['value_id']).'">','<option value="'.get_option(OPTION_PREFİX.'oznitelik_'.$platform.'_'.$term['value_id']).'" selected>',$tt).'
                                        </select>
                                    </td> 
                                </tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div id="advanced-sortables" class="meta-box-sortables ui-sortable empty-container"></div>
            </div>
        </div>
        <br class="clear">
    </div>
</form>




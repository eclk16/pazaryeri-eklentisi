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
                            <th scope="col" colspan="7" id="title" class=""><a href="?page=pazaryeri-eklentisi">Ayarlar</a> > <a href="?page=pazaryeri-eklentisi-kategori&platform=<?=$platform?>">Kategori Eşleştirme</a> > <?=get_term( $_GET['kategori'] )->name?> > <span><?=strtoupper($platform)?> Özellik Eşleştirme</span></th>
                        </tr>
                        </thead>
                        <tbody id="the-list" >
                        <tr style="border-bottom: 1px solid #d3d3d3;">
                            <th colspan="2">Pazaryerindeki Özellik</th>
                            <th colspan="4">Buradaki Özellik</th>
                            <th colspan="1">Öznitelik Eşleştirme</th>
                        </tr>
                        <?php
                        $ozellik = '';
                        foreach($ozellikler as $row){
                            if(strstr($row,'pa_')) $ozellik .= '<option value="'.$row.'">'.ucfirst(str_replace('pa_','',$row)).'</option>';
                        }
                        foreach($attributes as $term) {
                            echo '  <tr>
                                    <td colspan="2" class="colspanchange">'.$term['name'].'</td> 
                                    <td colspan="4" class="colspanchange">
                                        <select class="form-control filterCategory" name="'.OPTION_PREFİX.'ozellik_'.$platform.'_'.$term['attribute_id'].'">
                                            <option disabled selected>Seçiniz</option>
                                            '.str_replace('<option value="'.get_option(OPTION_PREFİX.'ozellik_'.$platform.'_'.$term['attribute_id']).'">','<option value="'.get_option(OPTION_PREFİX.'ozellik_'.$platform.'_'.$term['attribute_id']).'" selected>',$ozellik).'
                                        </select>
                                    </td> 
                                    <td colspan="1" class="colspanchange">';
                            if(get_option(OPTION_PREFİX.'ozellik_'.$platform.'_'.$term['attribute_id']) != '') echo '<a class="button" style="float:right;" href="?page=pazaryeri-eklentisi-oznitelik&platform='.$platform.'&kategori='.$_GET['kategori'].'&ozellik='.$term['attribute_id'].'&ozellikname='.$term['name'].'" >Özellikleri Eşleştir</a>'; echo '
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
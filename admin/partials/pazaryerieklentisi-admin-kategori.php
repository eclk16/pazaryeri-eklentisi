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
                    <table class="wp-list-table widefat  striped table-view-list posts">
                            <thead>
                                <tr>
                                    <th colspan="3"><a href="?page=pazaryeri-eklentisi">Ayarlar</a> > <span><?=strtoupper($platform)?> Kategori Eşleştirme</span></th>
                                </tr>
                            </thead>
                            <tbody id="the-list" >
                                <tr style="border-bottom: 1px solid #d3d3d3;">
                                    <th>Buradaki Kategori</th>
                                    <th>Pazaryerindeki Kategori</th>
                                    <th>Özellik Eşleştirme</th>
                                </tr>
                                <?php
                                    
                                    foreach($terms as $id => $term) {
                                        if(get_option(OPTION_PREFİX.'kategori_'.$platform.'_'.$id) >0){
                                            $selected = '<option selected value="'.get_option(OPTION_PREFİX.'kategori_'.$platform.'_'.$id).'">'.
                                                $this->getName(['type' => 'getName','id' => get_option(OPTION_PREFİX.'kategori_'.$platform.'_'.$id),'platform'=>$platform])
                                                .'</option>';
                                        }else{$selected = '';}
                                        echo '  <tr>
                                                    <td>'.$term.'</td> 
                                                    <td>
                                                        <select class="form-control filterCategory2" style="width:100%!important" name="'.OPTION_PREFİX.'kategori_'.$platform.'_'.$id.'">
                                                            <option value="">Seçiniz</option>
                                                            '.$selected.'
                                                        </select>
                                                    </td> 
                                                    <td>';
                                                    if(get_option(OPTION_PREFİX.'kategori_'.$platform.'_'.$id) != '') echo '<a class="button" style="" href="?page=pazaryeri-eklentisi-ozellik&platform='.$platform.'&kategori='.$id.'">Özellikleri Eşleştir</a>'; echo '</td> 
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
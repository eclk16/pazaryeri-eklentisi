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
<?php update_option(OPTION_PREFİX.'pazaryeriEklentisiUrunler',[]); ?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<form method="get" action="">
    <div id="poststuff" class="ana-kapsayici">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="postbox-container-1" class="postbox-container">
                <?php require_once('right.php'); ?>
            </div>
            <div id="postbox-container-2" class="postbox-container">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">


                        <input type="hidden" name="urunler" id="urunler" value="">
                        <input type="hidden" name="platform" value="<?=$pazaryeri?>">
                        <input type="hidden" name="step" value="step2">
                        <input type="hidden" name="page" value="pazaryeri-eklentisi-aktarim">
                        <input type="hidden" name="yon" value="<?=$_GET['yon']?>">
                        <input type="hidden" name="tur" value="<?=$_GET['tur']?>">
                        <input type="hidden" name="guncellemetur" value="<?=$_GET['guncellemetur']?>">
                        <input type="hidden" name="kategori" value="<?=$_GET['kategori']?>">
                        <input type="hidden" name="kural" value="<?=$_GET['kural']?>">
                        <input type="hidden" name="komisyon" value="<?=$_GET['komisyon']?>">
                        <input type="hidden" name="gorsel" value="<?=$_GET['gorsel']?>">
                        <input type="hidden" name="next" value="<?=$_GET['next']?>">
                        <table class="wp-list-table widefat fixed striped table-view-list posts">
                            <thead>
                            <tr>
                                <th style="width:30px;" scope="col" id="title" class=""><span>#</span></th>
                                <th scope="col" id="title" class=""><span>Ürün Görsel</span></th>
                                <th scope="col" id="title" class=""><span>Ürün Adı</span></th>
                                <th scope="col" id="title" class=""><span>Ürün Fiyatları</span></th>
                                <th scope="col" id="title" class=""><span>Ürün Kodu</span></th>
                                <th scope="col" id="title" class=""><span>Ürün Kategori</span></th>
                            </tr>
                            </thead>
                            <tbody id="the-list" >

                            <?php
                            $echo = '';
                            if($_GET['yon'] == 'Getir'):
                                $urunler = $this->getProducts($setConfig);
                                foreach($urunler['data']['content'] as $urun):
                                    $bk = get_option(OPTION_PREFİX.$pazaryeri.'_kategori_'.$urun['pimCategoryId']) ?? '';
                                    if($bk) $bk = get_term($bk)->name;
                                    $echo .= '  <tr id="edit-1" class="" style="">
                                            <td style="width:30px;" class="colspanchange"><input type="checkbox" value="'.$urun['id'].'" checked class="form-control urunler"></td>
                                            <td  class="colspanchange"><img style="width:auto;height:75px;" src="'.$urun['images'][0]['url'].'"></td>
                                            <td  class="colspanchange">'.$urun['title'].'</td>
                                            <td  class="colspanchange">'.$urun['salePrice'].'</td>
                                            <td  class="colspanchange">'.$urun['barcode'].'</td>
                                            <td  class="colspanchange"><b>Pazaryeri</b> : '.$urun['categoryName'].'<br><b>Site</b> : '.$bk.'</td>
                                        </tr>';
                                endforeach;
                            else:
                                $keys = $this->getWcApiKey();
                                $store_url = get_site_url();
                                $woocommerce = new Automattic\WooCommerce\Client(
                                    $store_url,
                                    $keys['consumer_key'],
                                    $keys['consumer_secret'],
                                    [
                                        'wp_api' => true,
                                        'version' => 'wc/v3',
                                        'query_string_auth' => true
                                    ]
                                );
                                $urunler = $woocommerce->get('products');
                                foreach($urunler as $urun):
                                    $bk = get_option(OPTION_PREFİX.'kategori_'.$pazaryeri.'_'.$urun->categories[0]->id) ?? '';
                                    $echo .= '  <tr id="edit-1" class="" style="">
   <td style="width:30px;" class="colspanchange"><input type="checkbox" checked value="'.$urun->id.'" class="form-control urunler"></td>
                                            <td  class="colspanchange"><img style="width:auto;height:75px;" src="'.$urun->images[0]->src.'"></td>
                                            <td  class="colspanchange">'.$urun->name.'</td>
                                            <td  class="colspanchange">'.$urun->price.'</td>
                                            <td  class="colspanchange">'.$urun->sku.'</td>
                                            <td  class="colspanchange"><b>Pazaryeri</b> : '.$this->getName(['type' => 'getName','id' => $bk,'platform'=>$_GET['platform']]).'<br><b>Site</b> : '.$urun->categories[0]->name.'</td>
                                        </tr>';
                                endforeach;
                            endif;
                            ?>
                            <?=$echo?>

                            </tbody>
                        </table>
                        <div id="major-publishing-actions">

                            <div id="publishing-action">
                                <span class="spinner"></span>
                                <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Sayfa 1">
                            </div>
                            <div class="clear"></div>
                        </div>



                </div>
                <div id="advanced-sortables" class="meta-box-sortables ui-sortable empty-container"></div>
            </div>
        </div>
        <br class="clear">
    </div>
</form>

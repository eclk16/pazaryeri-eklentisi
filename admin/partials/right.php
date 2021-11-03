<div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
    <div id="submitdiv" class="postbox ">
        <div class="postbox-header">
            <h2 class="hndle ui-sortable-handle">Kayıt/Güncelleme</h2>
        </div>
        <div class="inside">
            <div class="submitbox" id="submitpost">
                <div id="minor-publishing">
                    <div id="misc-publishing-actions">
                        <div class="misc-pub-section misc-pub-post-status">Durum: <span id="post-status-display"><?=$durum?> </span></div>
                    </div>
                    <?php if($durum == 'Pasif') : ?>
                    <div id="misc-publishing-actions">
                        <div class="misc-pub-section misc-pub-post-status">Lisans Al: <span id="post-status-display"><a href="https://pazaryerieklentisi.com">TIKLA</a> </span></div>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($_GET['platform']) && isset($setConfig)): ?>
                    <div id="misc-publishing-actions">
                        <div class="misc-pub-section misc-pub-post-status">Platform: <span id="post-status-display"><?=$setConfig['name']?><img style="width: 100%" src="<?=$setConfig['logo']?>"></span></div>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($islem)): ?>
                    <div id="misc-publishing-actions">
                        <div class="misc-pub-section misc-pub-post-status">İşlem: <span id="post-status-display"><?=$islem?></span></div>
                    </div>
                    <?php endif; ?>
                    <hr>
                    <div id="misc-publishing-actions">
                        <div class="misc-pub-section misc-pub-post-status">Geliştirici: <span id="post-status-display"><a href="https://pazaryerieklentisi.com">Pazaryeri Eklentisi</a></span></div>
                    </div>
                    <div id="misc-publishing-actions">
                        <div class="misc-pub-section misc-pub-post-status">Versiyon: <span id="post-status-display"><?=PAZARYERIEKLENTISI_VERSION?></span></div>
                    </div>
                    <div id="misc-publishing-actions">
                        <div class="misc-pub-section misc-pub-post-status">Destek: <span id="post-status-display"><a href="https://pazaryerieklentisi.com">TIKLA</a></span></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div id="major-publishing-actions">

                    <div id="publishing-action">
                        <span class="spinner"></span>
                        <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Güncelle">
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
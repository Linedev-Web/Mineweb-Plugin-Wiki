<?= $this->Html->css('Lwiki.style.css') ?>
<div id="page--lwiki" class="container plugin-lwiki">
    <div class="container-background">
        <img src="/theme/Custom/img/vote/vote.png" alt="shop" classe="img-responsive">
    </div>
    <div class="row">
        <div class="col-md-12 text-left">
            <h1 class="page--title">Skyhell</h1>
            <p>Retrouvez toutes les réponses à vos questions regroupées sur ce wiki.</p>
            <div class="row contenu-wiki">
                <div class="col-md-3">
                    <div id="accordion">
                        <ul class="list-group">
                            <?php foreach ($types as $key => $type) { ?>
                                <li class="list-group-item">
                                    <a class="" data-action="type"
                                       href="#"><?= $type['Ltypes']['name'] ?></a>
                                    <?php if ($type['Lcategory'] != "undefined"): ?>
                                        <?php foreach ($type['Lcategory'] as $key1 => $category) { ?>
                                            <?php if ($category['display'] == 0): ?>
                                                <a class="click-element" data-action="category"
                                                   data-toggle="collapse" role="button" aria-expanded="false"
                                                   data-id="<?= $category['id'] ?>"
                                                   href="#category-<?= $category['id'] ?>">
                                                    <?php if ($category['litem_count']): ?>
                                                        <div class="icon-triangle"></div>
                                                    <?php endif ?>
                                                    <?= $category['name'] ?></a>
                                                <div class="collapse" id="category-<?= $category['id'] ?>">
                                                    <?php if ($category['Litem'] != "undefined"): ?>
                                                        <?php foreach ($category['Litem'] as $key2 => $item) { ?>
                                                            <?php if ($item['display'] == 0): ?>
                                                                <a class="click-element" data-action="item"
                                                                   data-id="<?= $item['id'] ?>"
                                                                   href="#category-<?= $item['id'] ?>"><?= $item['name'] ?></a>
                                                            <?php endif; ?>
                                                        <?php } ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php } ?>
                                    <?php endif; ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="replace-element">
                        <?= $text ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $button = $('.click-element')
    $button.on('click', function (event) {
        event.preventDefault()
        $('a').removeClass('active')
        $(this).addClass('active')
        let element = {};
        element['id'] = $(this).data('id')
        element['action'] = $(this).data('action')
        if ($(this).data('action') === 'item') {
            $.post("<?= $this->Html->url(array('controller' => 'litem', 'action' => 'getWiki', 'plugin' => 'lwiki')) ?>", element, function (data) {
                if (data.statut) {
                    history.pushState({}, null, '/wiki/' + element['action'] + '&' + string_to_slug(data.slug) + '&' + element['id']);
                    $('.replace-element').html(data.content)
                } else if (!data.statut) {
                    $('.ajax-msg').empty().html('');
                } else {
                    $('.ajax-msg').empty().html('');
                }
            });
        }

        if ($(this).data('action') === 'category') {
            $.post("<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'getWiki', 'plugin' => 'lwiki')) ?>", element, function (data) {
                if (data.statut) {
                    history.pushState({}, null, '/wiki/' + element['action'] + '&' + string_to_slug(data.slug) + '&' + element['id']);
                    if (data.content.length > 1) {
                        $('.replace-element').html(data.content)
                    }
                } else if (!data.statut) {
                    $('.ajax-msg').empty().html('');
                } else {
                    $('.ajax-msg').empty().html('');
                }
            });
        }

        return true
    })
</script>
<?= $this->Html->script('Lwiki.script.js') ?>

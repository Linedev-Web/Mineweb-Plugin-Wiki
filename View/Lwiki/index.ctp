<?= $this->Html->css('Lwiki.style.css') ?>
<?php if (isset($color) && !empty($color)): ?>
    <style>
        #page--lwiki .list-group .list-group-item,
        #page--lwiki .replace-element {
            background-color: <?= $color["color_background"]?>;
            color: <?= $color["color_text"]?>;
        }

        #page--lwiki .replace-element p {
            color: <?= $color["color_text"]?>;
        }

        #page--lwiki a {
            color: <?= $color["color_text"]?>
        }

        #page--lwiki a:not([data-action=type]).active {
            background-color: <?= $color["color_button"]?>;
            color: <?= $color["color_button_text"]?>

        }

        #page--lwiki a:not([data-action=type]):active,
        #page--lwiki a:not([data-action=type]):focus,
        #page--lwiki a:not([data-action=type]):hover {
            background-color: <?= $color["color_hover"]?>;
            color: <?= $color["color_hover_text"]?>;
        }
    </style>
<?php endif ?>
<div id="page--lwiki" class="container plugin-lwiki">
    <div class="row">
        <div class="col-md-12">
            <div class="text-<?= $config['position'] ?>">
                <h1 class="page--title"><?= $config['title'] ?></h1>
                <p><?= $config['content'] ?></p>
            </div>
            <?php if (isset($types) && !empty($types)): ?>
                <div class="row contenu-wiki">
                    <div class="col-md-3">
                        <div id="accordion">
                            <ul class="list-group text-left">
                                <?php foreach ($types as $key => $type) { ?>
                                    <li class="list-group-item">
                                        <a data-action="type"
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
                                                        <span><?= $category['name'] ?></span>
                                                    </a>
                                                    <div class="collapse" id="category-<?= $category['id'] ?>">
                                                        <?php if ($category['Litem'] != "undefined"): ?>
                                                            <?php foreach ($category['Litem'] as $key2 => $item) { ?>
                                                                <?php if ($item['display'] == 0): ?>
                                                                    <a class="click-element" data-action="item"
                                                                       data-id="<?= $item['id'] ?>"
                                                                       href="#category-<?= $item['id'] ?>">
                                                                        <span><?= $item['name'] ?></span>
                                                                    </a>
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
                    <?php if (isset($text) && !empty($text)): ?>
                        <div class="col-md-9">
                            <div class="replace-element">
                                <?= $text ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <p>Votre wiki ne contient aucune information</p>
                </div>
            <?php endif ?>
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

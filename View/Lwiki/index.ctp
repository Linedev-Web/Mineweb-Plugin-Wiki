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
                                    <a class=""
                                       href="#type-<?= $type['Ltypes']['id'] ?>"><?= $type['Ltypes']['name'] ?></a>
                                    <ul class="ml-3">
                                        <?php foreach ($type['Lcategory'] as $key1 => $category) { ?>
                                            <li class="mt-3">
                                                <a class="click-element" data-action="category"
                                                   data-id="<?= $category['id'] ?>"
                                                   href="#category-<?= $category['id'] ?>"><?= $category['name'] ?></a>
                                                <ul class="ml-3">
                                                    <?php foreach ($category['Litem'] as $key2 => $item) { ?>
                                                        <li class="p-1 m-1">
                                                            <a class="click-element" data-action="item"
                                                               data-id="<?= $item['id'] ?>"
                                                               href="#category-<?= $item['id'] ?>"><?= $item['name'] ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                    </ul>
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
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <script>
        $('.click-element').on('click', function (event) {
            event.preventDefault()
            let element = {};
            element['id'] = $(this).data('id')
            if ($(this).data('action') === 'item') {
                $.post("<?= $this->Html->url(array('controller' => 'litem', 'action' => 'getWiki', 'plugin' => 'lwiki')) ?>", element, function (data) {
                    if (data.statut) {
                        $('.replace-element').html(data.content)
                    } else if (!data.statut) {
                        $('.ajax-msg').empty().html('');
                    } else {
                        $('.ajax-msg').empty().html('');
                    }
                });
            }

            if ($(this).data('action') === 'category') {

            }

            return true
        })
    </script>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.1/dist/sweetalert2.all.min.js"></script>
<?= $this->Html->css('Lwiki.admin_wiki.css') ?>
<section class="container wiki  sortable-type">
    <div class="row">
        <div class="col-md-12 col--type">
            <form action="" class="form-inline" method="post" data-ajax="true"
                  data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'admin' => true)) ?>">
                <div class="form-group">
                    <i class="fa fa-folder" style="margin-right: 1rem"></i>
                    <input type="text" name="name" class="form-control" placeholder="Ajouter une catégorie" required/>
                </div>
                <div class="form-group">
                    <button type="submit" class="icon--custom">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </form>
            <div class="sortable-category">
                <?php $t = -1;
                foreach ($types as $key => $type): $t++ ?>
                    <div class="col--drag-type" id="<?= $type['Ltypes']['name'] ?>-<?= $t ?>">
                        <?php if (count($type["Ltypes"]) > 1) { ?>
                            <div class="icon">
                                <i class="fa fa-arrows"></i>
                            </div>
                        <?php } ?>
                        <blockquote>
                            <form action="<?= $this->Html->url(array('controller' => 'Lwiki', 'action' => 'edit_types', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                  data-redirect-url="<?= $this->Html->url(array('controller' => 'Lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                  method="post" data-ajax="true" class="form-inline">
                                <div class="form-group">
                                    <input class="form-control transparent-input" name="name"
                                           type="text"
                                           value="<?= $type["Ltypes"]["name"] ?>"/>
                                    <input type="hidden" name="id" value="<?= $type["Ltypes"]["id"] ?>">
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="icon--custom">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <a onclick="confirmDel('<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'delete/' . $type['Ltypes']['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>')"
                                       class="icon--custom">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <a onclick="collapse(<?= $type['Ltypes']["id"] ?>, event)"
                                       class="icon--custom type <?php if (!$type['Ltypes']['collapse']): ?>collapsed<?php endif; ?>"
                                       data-parent="#accordion" data-toggle="collapse"
                                       href="#collapse-type-<?= $type["Ltypes"]["id"] ?>">
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                </div>
                            </form>
                        </blockquote>

                        <div id="collapse-type-<?= $type["Ltypes"]["id"] ?>"
                             class="collapse <?php if (!$type["Ltypes"]['collapse']): ?> in<?php endif; ?>">
                            <div class="col--category">
                                <form action="<?= $this->Html->url(array('controller' => 'Lwiki', 'action' => 'add_category')) ?>"
                                      data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'admin' => true)) ?>"
                                      method="post" data-upload-image="true" data-ajax="true"
                                      class="form-inline">
                                    <div class="form-group">
                                        <i class="fa fa-folder-open" style="margin-right: 1rem"></i>
                                        <input class="form-control" type="text" name="name"
                                               placeholder="Ajouter une sous-catégorie" required>
                                        <input class="form-control" type="hidden" name="type"
                                               value="<?= $type["Ltypes"]["id"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <button class="icon--custom" type="submit">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </form>

                                <div class="col--drag-category fixed"></div>
                                <div class="sortable-item">
                                    <?php $c = -1;
                                    if (count($type['Lcategory']) > 1) {
                                        $countCategory = true;
                                    } else {
                                        $countCategory = false;
                                    };
                                    foreach ($type['Lcategory'] as $key2 => $category): $c++ ?>
                                        <div class="col--drag-category" id="<?= $category['name'] ?>-<?= $c ?>">
                                            <?php if ($countCategory) { ?>
                                                <div class="icon">
                                                    <i class="fa fa-arrows"></i>
                                                </div>
                                            <?php } ?>
                                            <blockquote>
                                                <form class="form-inline">
                                                    <div class="form-group">
                                                        <?= $category["name"] ?>
                                                    </div>
                                                </form>
                                                <a href="#" class="icon--custom element-display"
                                                   data-id="<?= $category['id'] ?>"
                                                   data-action="category">
                                                    <i class="
                                                           fa <?php if (!$category['display']) { ?> fa-eye <?php } else { ?>
                                                           fa-eye-slash <?php } ?>"></i>
                                                </a>
                                                <a class="icon--custom" type="submit"
                                                   href="<?= $this->Html->url(array('controller' => 'Lcategory', 'action' => 'edit/' . $category['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a onclick="confirmDel('<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'delete/' . $category['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>')"
                                                   class="icon--custom"><i class="fa fa-trash-o"></i></a>
                                                <a onclick="collapse(<?= $category["id"] ?>, event)"
                                                   class="icon--custom category <?php if (!$category['collapse']): ?>collapsed<?php endif; ?>"
                                                   data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse-category-<?= $category["id"] ?>">
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                            </blockquote>

                                            <div id="collapse-category-<?= $category["id"] ?>"
                                                 class="collapse <?php if (!$category['collapse']): ?> in<?php endif; ?>">
                                                <div class="col--item">
                                                    <div class="box-header box-col-header">
                                                        <i class="fa fa-file"></i>
                                                        <h3 class="box-title">Ajouter un article</h3>
                                                        <a href="<?= $this->Html->url(array('controller' => 'litem', 'action' => 'add/' . $category['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                                           class="icon--custom">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col--drag-item fixed"></div>
                                                    <?php $i = -1;
                                                    foreach ($category['Litem'] as $key3 => $item): $i++ ?>
                                                        <div class="col--drag-item" id="<?= $item['name'] ?>-<?= $i ?>">
                                                            <?php if (count($category['Litem'][$i]) > 1) { ?>
                                                                <div class="icon">
                                                                    <i class="fa fa-arrows"></i>
                                                                </div>
                                                            <?php } ?>
                                                            <blockquote>
                                                                <form class="form-inline">
                                                                    <div class="form-group">
                                                                        <?= $item['name'] ?>
                                                                    </div>
                                                                </form>
                                                                <a href="#" class="icon--custom element-display"
                                                                   data-id="<?= $item['id'] ?>"
                                                                   data-action="item">
                                                                    <i class="
                                                                           fa <?php if (!$item['display']) { ?> fa-eye <?php } else { ?>
                                                                           fa-eye-slash <?php } ?>"></i>
                                                                </a>
                                                                <a href="<?= $this->Html->url(array('controller' => 'litem', 'action' => 'edit/' . $item['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                                                   class="icon--custom">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <a onclick="confirmDel('<?= $this->Html->url(array('controller' => 'litem', 'action' => 'delete/' . $item['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>')"
                                                                   class="icon--custom">
                                                                    <i class="fa fa-trash-o"></i></a>
                                                            </blockquote>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="ajax-msg"></div>
</section>

<script>
    $(function () {
        $(".sortable-item").sortable({
            axis: 'y',
            delay: 300,
            items: '.col--drag-item',
            revert: true,
            stop: function (event, ui) {
                let itemId = $(ui['item'][0]['id'])
                let inputs = {};

                inputs['wiki_item_order'] = $(this).sortable('serialize');
                inputs['wiki_item_name_selected'] = itemId.selector
                inputs['wiki_category_name'] = $(ui['item'][0]['offsetParent']).attr(('id'))
                inputs['data[_Token][key]'] = '<?= $csrfToken ?>';

                $.post("<?= $this->Html->url(array('controller' => 'litem', 'action' => 'save_ajax', 'admin' => true)) ?>", inputs, function (data) {
                    if (data.statut) {
                        editElementToast('success', 'Modification enregistrée')
                    } else {
                        editElementToast('error', 'Une erreur vient de se produire')
                    }
                });
            }
        });

        $(".sortable-category").sortable({
            axis: 'y',
            delay: 300,
            items: '.col--drag-category',
            revert: true,
            stop: function (event, ui) {
                let categoryId = $(ui['item'][0]['id'])
                let inputs = {};

                inputs['wiki_category_order'] = $(this).sortable('serialize');
                inputs['wiki_category_name_selected'] = categoryId.selector
                inputs['wiki_type_name'] = $(ui['item'][0]['offsetParent']).attr(('id'))
                inputs['data[_Token][key]'] = '<?= $csrfToken ?>';

                $.post("<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'save_ajax', 'admin' => true)) ?>", inputs, function (data) {
                    if (data.statut) {
                        editElementToast('success', 'Modification enregistrée')
                    } else {
                        editElementToast('error', 'Une erreur vient de se produire')
                    }
                });
            }
        });
        $(".sortable-type").sortable({
            axis: 'y',
            delay: 300,
            items: '.col--drag-type',
            revert: true,
            stop: function (event, ui) {
                let inputs = {};

                inputs['wiki_type_order'] = $(this).sortable('serialize');
                inputs['data[_Token][key]'] = '<?= $csrfToken ?>';

                $.post("<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'save_ajax', 'admin' => true)) ?>", inputs, function (data) {
                    if (data.statut) {
                        editElementToast('success', 'Modification enregistrée')
                    } else {
                        editElementToast('error', 'Une erreur vient de se produire')
                    }
                });
            }
        });

        $('.element-display').on('click', function (event) {
            event.preventDefault()
            let selectId = {};
            let button = {}
            selectId['id'] = $(this).data('id')
            button = $(this)
            let element = $(this).data('action')
            if (element == "category") {
                $.post("<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'edit_display_ajax', 'admin' => true)) ?>", selectId, function (data) {
                    if (data.statut) {
                        if (data.display) {
                            $(button).html('<i class="fa fa-eye"></i>')
                        } else {
                            $(button).html('<i class="fa fa-eye-slash"></i>')
                        }
                        editElementToast('success', 'Modification enregistré')
                    } else {
                        editElementToast('error', 'Une erreur vient de se produire')
                    }
                    return true
                });
            }
            if (element == "item") {
                $.post("<?= $this->Html->url(array('controller' => 'litem', 'action' => 'edit_display_ajax', 'admin' => true)) ?>", selectId, function (data) {
                    if (data.statut) {
                        if (data.display) {
                            $(button).html('<i class="fa fa-eye"></i>')
                        } else {
                            $(button).html('<i class="fa fa-eye-slash"></i>')
                        }
                        editElementToast('success', 'Modification enregistré')
                    } else {
                        editElementToast('error', 'Une erreur vient de se produire')
                    }
                    return true
                });
            }
        })
    });

    function collapse(id, event) {
        let selectId = {};
        selectId['id'] = id
        let bouton = $(event['path'][1]['classList'][1])
        if (bouton.selector === 'category') {
            $.post("<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'edit_collapse_ajax', 'admin' => true)) ?>", selectId, function (data) {
                if (data.statut) {
                    editElementToast('success', 'Modification enregistrée')
                } else {
                    editElementToast('error', 'Une erreur vient de se produire')
                }
                return true
            });
        }
        if (bouton.selector === 'type') {
            $.post("<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'edit_collapse_ajax', 'admin' => true)) ?>", selectId, function (data) {
                if (data.statut) {
                    editElementToast('success', 'Modification enregistrée')
                } else {
                    editElementToast('error', 'Une erreur vient de se produire')
                }
            });
            return true
        }
    }


    function editElementToast(icon, title) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-right',
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                popup: 'popup-class',
            },
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: title
        })
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.1/dist/sweetalert2.all.min.js"></script>

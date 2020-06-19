<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__add__categorie') ?></h3>&nbsp;&nbsp;<a href="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                       class="btn btn-success"><?= $Lang->get('GLOBAL__ADD') ?></a>

                </div>
                <div class=" box-body">
                    <?php if ($categorys): ?>
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th><?= $Lang->get('WIKI__categorie') ?></th>
                                <th><?= $Lang->get('WIKI__type') ?></th>
                                <th><?= $Lang->get('WIKI__icon') ?></th>
                                <th class="right"><?= $Lang->get('GLOBAL__ACTIONS') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($categorys as $category): ?>
                                <tr>
                                    <td>
                                        <?= $category["Lcategory"]["name"] ?>
                                    </td>
                                    <td>
                                        <?= $category["Ltypes"]['name'] ?>
                                    <td>
                                        <img src="<?= $category["Lcategory"]["icon"] ?>"
                                             title="<?= $category["Lcategory"]["name"] ?>"
                                             alt="<?= $category["Lcategory"]["name"] ?>"
                                             style="width: 50px;height: 50px;object-fit: contain">
                                    </td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href="<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'edit/' . $category['Lcategory']['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                           type="submit"><?= $Lang->get('GLOBAL__EDIT') ?></a>
                                        <a onclick="confirmDel('<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'delete/' . $category['Lcategory']['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>')"
                                           class="btn btn-danger"><?= $Lang->get('GLOBAL__DELETE') ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <small><?= $Lang->get('WIKI__not__type') ?></small>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>

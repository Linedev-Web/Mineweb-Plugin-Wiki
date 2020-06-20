<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__add__type') ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="" method="post" data-ajax="true"
                                  data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'admin' => true)) ?>">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"
                                           placeholder="<?= $Lang->get('WIKI__add__type'); ?>" required/>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                            class="btn btn-primary center-block"><?= $Lang->get('GLOBAL__SUBMIT'); ?></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <?php if ($types): ?>
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th><?= $Lang->get('WIKI__type') ?></th>
                                        <th class="right"><?= $Lang->get('GLOBAL__ACTIONS') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($types as $type): ?>
                                        <tr>
                                            <td>
                                                <form action="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'edit_types')) ?>"
                                                      data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'admin' => true)) ?>"
                                                      method="post" data-ajax="true">
                                                    <input class="form-control transparent-input" name="name"
                                                           type="text"
                                                           value="<?= $type["Ltypes"]["name"] ?>"/>
                                                    <input type="hidden" name="id" value="<?= $type["Ltypes"]["id"] ?>">
                                            </td>
                                            <td>
                                                <button class="btn btn-primary"
                                                        type="submit"><?= $Lang->get('GLOBAL__UPDATE') ?></button>
                                                <a onclick="confirmDel('<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'delete/' . $type['Ltypes']['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>')"
                                                   class="btn btn-danger"><?= $Lang->get('GLOBAL__DELETE') ?></a>
                                                </form>
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
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $Lang->get('WIKI__add__categorie') ?></h3>
                            </div>
                            <form action="<?= $this->Html->url(array('controller' => 'Lwiki', 'action' => 'add_category')) ?>"
                                  data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'admin' => true)) ?>"
                                  method="post" data-upload-image="true" data-ajax="true">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="type"><?= $Lang->get('WIKI__name') ?></label>
                                        <input class="form-control" type="text" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="type"><?= $Lang->get('WIKI__type') ?></label>
                                        <select class="form-control" name="type">
                                            <?php foreach ($types as $type): ?>
                                                <option value="<?= $type["Ltypes"]['id'] ?>"><?= $type["Ltypes"]['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary"
                                                type="submit"><?= $Lang->get('GLOBAL__SUBMIT') ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
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
                                    <td><?= $category['Ltypes']['name'] ?></td>
                                    <td><img src="<?= $category["Lcategory"]["icon"] ?>"
                                             title="<?= $category["Lcategory"]["name"] ?>"
                                             alt="<?= $category["Lcategory"]["name"] ?>"
                                             style="width: 50px;height: 50px;object-fit: contain">
                                    </td>
                                    <td>
                                        <a href="<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'edit/' . $category['Lcategory']['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                           class="btn btn-primary"><?= $Lang->get('GLOBAL__EDIT') ?></a>
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

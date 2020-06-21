<style>
    .box-col-header {
        font-weight: bold;
        margin-left: -30px;
    }

    .box-col-header .box-title {
        font-weight: bold;
    }

    .col--type {
        background-color: #fdfdfd;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        margin: 1rem 0;
        padding: 1rem 15px;
        position: relative
    }

    .col--type .box-header {

    }

    .col--category {
        margin-top: 1rem;
        margin-bottom: 1rem;
        padding: 1rem 15px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    .fa-arrows {
        font-size: 20px;
        cursor: pointer
    }

    .icon {
        height: 45px;
        line-height: 45px;
        text-align: center;
        display: inline-block;
        width: 45px;
        position: absolute;
        top: 0;
        left: -45px
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__add__type') ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post" data-ajax="true"
                                  data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'admin' => true)) ?>">
                                <div class="form-group">
                                    <label for="type"><?= $Lang->get('WIKI__name') ?></label>
                                    <input type="text" name="name" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                            class="btn btn-primary"><?= $Lang->get('GLOBAL__SUBMIT'); ?></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <?php if ($types): ?>
                                <div class="row" style="font-weight: bold;padding-bottom: 1rem">
                                    <div class="col-md-4"><?= $Lang->get('WIKI__type') ?></div>
                                    <div class="col-md-4"><?= $Lang->get('GLOBAL__ACTIONS') ?></div>
                                </div>
                                <?php foreach ($types as $type): ?>
                                    <form action="<?= $this->Html->url(array('controller' => 'Lwiki', 'action' => 'edit_types', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                          data-redirect-url="<?= $this->Html->url(array('controller' => 'Lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                          method="post" data-ajax="true">
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <input class="form-control transparent-input" name="name"
                                                       type="text"
                                                       value="<?= $type["Ltypes"]["name"] ?>"/>
                                                <input type="hidden" name="id" value="<?= $type["Ltypes"]["id"] ?>">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <button class="btn btn-primary"
                                                        type="submit"><?= $Lang->get('GLOBAL__UPDATE') ?></button>
                                                <a onclick="confirmDel('<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'delete/' . $type['Ltypes']['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>')"
                                                   class="btn btn-danger"><?= $Lang->get('GLOBAL__DELETE') ?></a>
                                            </div>
                                        </div>
                                    </form>
                                <?php endforeach; ?>
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
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__add__categorie') ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
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
                                    <div class="col-md-12 form-group">
                                        <button class="btn btn-primary"
                                                type="submit"><?= $Lang->get('GLOBAL__SUBMIT') ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <?php if ($categorys): ?>
                                <div class="row" style="font-weight: bold;padding-bottom: 1rem">
                                    <div class="col-md-4"><?= $Lang->get('WIKI__categorie') ?></div>
                                    <div class="col-md-4"><?= $Lang->get('WIKI__type') ?></div>
                                    <div class="col-md-4"><?= $Lang->get('GLOBAL__ACTIONS') ?></div>
                                </div>
                                <?php foreach ($categorys as $category): ?>
                                    <form action="<?= $this->Html->url(array('controller' => 'Lwiki', 'action' => 'edit_category', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                          data-redirect-url="<?= $this->Html->url(array('controller' => 'Lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                          method="post" data-ajax="true">
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <input class="form-control" name="name" type="text"
                                                       value="<?= $category['Lcategory']["name"] ?>"/>
                                                <input type="hidden" name="id"
                                                       value="<?= $category["Lcategory"]["id"] ?>">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <select class="form-control" name="type">
                                                    <option value="<?= $category['Ltypes']['id'] ?>"><?= $category['Ltypes']['name'] ?></option>
                                                    <?php foreach ($types as $type): ?>
                                                        <option value="<?= $type["Ltypes"]['id'] ?>"><?= $type["Ltypes"]['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <button class="btn btn-primary"
                                                        type="submit"><?= $Lang->get('GLOBAL__UPDATE') ?></button>
                                                <a onclick="confirmDel('<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'delete/' . $category['Lcategory']['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>')"
                                                   class="btn btn-danger"><?= $Lang->get('GLOBAL__DELETE') ?></a>
                                            </div>
                                        </div>
                                    </form>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <small><?= $Lang->get('WIKI__not__type') ?></small>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="box-header box-col-header">
                                <h3 class="box-title"><?= $Lang->get('WIKI__type') ?></h3>
                            </div>
                            <?php foreach ($types as $key => $type): ?>
                                <div class="col-md-12 col--type">
                                    <div class="icon">
                                        <i class="fa fa-arrows"></i>
                                    </div>
                                    <blockquote style="display: inline-block">
                                        <?= $type['Ltypes']['name'] ?>
                                    </blockquote>
                                    <div class="row">
                                        <div class="col-md-11 col-md-offset-1">
                                            <div class="box-header box-col-header">
                                                <h3 class="box-title"><?= $Lang->get('WIKI__categorie') ?></h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php foreach ($type['Lcategory'] as $key2 => $category): ?>
                                                <div class="col-md-10 col-md-push-1 col--category">
                                                    <div class="icon">
                                                        <i class="fa fa-arrows"></i>
                                                    </div>
                                                    <blockquote style="display: inline-block">
                                                        <?= $category['name'] ?>
                                                        <?= $category['id'] ?>
                                                    </blockquote>
                                                    <a href="<?= $this->Html->url(array('controller' => 'litem', 'action' => 'add/' . $category['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                                       class="btn btn-primary"><?= $Lang->get('GLOBAL__ADD') ?></a>

                                                    <div class="row">
                                                        <div class="col-md-9 col-md-push-2">
                                                            <div class="box-header box-col-header">
                                                                <h3 class="box-title"><?= $Lang->get('WIKI__article') ?></h3>
                                                            </div>
                                                        </div>
                                                        <?php foreach ($category['Litem'] as $key3 => $item): ?>
                                                            <div class="col-md-9 col-md-push-2 col--category">

                                                                <div class="icon">
                                                                    <i class="fa fa-arrows"></i>
                                                                </div>
                                                                <blockquote style="display: inline-block">
                                                                    <?= $item['name'] ?>
                                                                </blockquote>

                                                                <a href="<?= $this->Html->url(array('controller' => 'litem', 'action' => 'edit/' . $item['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>"
                                                                   class="btn btn-primary"><?= $Lang->get('GLOBAL__EDIT') ?></a>
                                                                <a onclick="confirmDel('<?= $this->Html->url(array('controller' => 'litem', 'action' => 'delete/' . $item['id'], 'plugin' => 'lwiki', 'admin' => true)) ?>')"
                                                                   class="btn btn-danger"><?= $Lang->get('GLOBAL__DELETE') ?></a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
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
        </div>
    </div>
</section>

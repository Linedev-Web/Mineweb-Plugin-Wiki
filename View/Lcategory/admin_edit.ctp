<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__edit__categorie') ?></h3>
                </div>
                <div class="box-body">
                    <?php if ($category): ?>
                        <?= var_dump($category['filename']) ?>
                        <form action="<?= $this->Html->url(array('controller' => 'Lcategory', 'action' => 'edit_ajax')) ?>"
                              data-redirect-url="<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                              method="post" data-upload-image="true" data-ajax="true">
                            <div class="form-group">
                                <input class="form-control" name="name" type="text" value="<?= $category["name"] ?>"/>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="type">
                                    <option value="<?= $category['ltype_id'] ?>"><?= $category['name'] ?></option>
                                    <?php foreach ($types as $type): ?>
                                        <option value="<?= $type["Ltypes"]['id'] ?>"><?= $type["Ltypes"]['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?= $category["id"] ?>">

                            <button class="btn btn-primary" type="submit"><?= $Lang->get('GLOBAL__UPDATE') ?></button>
                        </form>
                    <?php else: ?>
                        <small class="text-center"><?= $Lang->get('WIKI__not__type') ?></small>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__edit__categorie') ?></h3>
                </div>
                <div class="box-body">
                    <form action="<?= $this->Html->url(array('controller' => 'litem', 'action' => 'edit_ajax', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          method="post" data-ajax="true">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <div class="form-group">
                            <label for="type"><?= $Lang->get('WIKI__type') ?></label>
                            <input class="form-control" name="name" type="text" value="<?= $item['name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="type"><?= $Lang->get('WIKI__type') ?></label>
                            <select class="form-control" name="lcategory_id">
                                <option value="<?= $item['id'] ?>"><?= $ltypeId['name'] ?></option>
                                <?php foreach ($categories as $categorie): ?>
                                    <option value="<?= $categorie["Lcategory"]['id'] ?>"><?= $categorie["Lcategory"]['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="display: block" for="type"><?= $Lang->get('WIKI__type') ?></label>
                            <textarea name="text">
                            <?= $item['text'] ?>
                            </textarea>
                        </div>

                        <button class="btn btn-primary" type="submit"><?= $Lang->get('GLOBAL__UPDATE') ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

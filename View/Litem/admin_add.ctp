<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__edit__categorie') ?></h3>
                </div>
                <div class="box-body">
                    <form action="<?= $this->Html->url(array('controller' => 'litem', 'action' => 'add_ajax', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          method="post" data-ajax="true">
                        <input type="hidden" name="lcategorie_id" value="<?= $lcategorie_id ?>">
                        <div class="form-group">
                            <input class="form-control" name="name" type="text""/>
                        </div>
                        <div class="form-group">
                            <textarea name="text">

                            </textarea>
                        </div>

                        <button class="btn btn-primary" type="submit"><?= $Lang->get('GLOBAL__UPDATE') ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

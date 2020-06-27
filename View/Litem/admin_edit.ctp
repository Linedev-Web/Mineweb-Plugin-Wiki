<section class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__EDIT_ARTICLE') ?></h3>
                </div>
                <div class="box-body">
                    <form action="<?= $this->Html->url(array('controller' => 'litem', 'action' => 'edit_ajax', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          method="post" data-ajax="true">
                        <div class="ajax-msg"></div>
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <div class="form-group">
                            <label for="type"><?= $Lang->get('WIKI__NAME') ?></label>
                            <input class="form-control" name="name" type="text" value="<?= $item['name'] ?>">
                        </div>
                        <?= $this->Html->script('admin/tinymce/tinymce.min.js') ?>
                        <script type="text/javascript">
                            tinymce.init({
                                selector: "textarea",
                                height: 300,
                                width: '100%',
                                language: 'fr_FR',
                                plugins: "textcolor code image link",
                                toolbar: "fontselect fontsizeselect bold italic underline strikethrough image link forecolor backcolor alignleft aligncenter alignright alignjustify cut copy paste bullist numlist outdent indent blockquote code"
                            });
                        </script>
                        <div class="form-group">
                            <label style="display: block" for="type"><?= $Lang->get('WIKI__DESCRIPTION') ?></label>
                            <textarea id="editor" name="text" cols="30" rows="10">
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


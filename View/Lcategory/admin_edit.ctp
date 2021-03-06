<style>
    :root {
        --color-primary: "#dfb449"
    }

    h1 {
        color: red !important;
    }
</style>
<section class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__EDIT_CATEGORY') ?></h3>
                </div>
                <div class="box-body">
                    <form action="<?= $this->Html->url(array('controller' => 'lcategory', 'action' => 'edit_ajax', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          data-redirect-url="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          method="post" data-ajax="true">
                        <div class="ajax-msg"></div>
                        <input type="hidden" name="id" value="<?= $category['id'] ?>">
                        <div class="form-group">
                            <label for="type"><?= $Lang->get('WIKI__NAME') ?></label>
                            <input class="form-control" name="name" type="text" value="<?= $category['name'] ?>">
                        </div>
                        <?= $this->Html->script('admin/tinymce/tinymce.min.js') ?>
                        <script type="text/javascript">
                            tinymce.init({
                                selector: "textarea",
                                height: 300,
                                width: '100%',
                                language: 'fr_FR',
                                plugins: "textcolor code image link table importcss",
                                custom_colors: false,
                                content_css: '/lwiki/css/root.css',
                                importcss_file_filter: '/lwiki/css/root.css',
                                importcss_append: true,
                                toolbar: "fontsizeselect bold italic underline strikethrough image link alignleft aligncenter alignright alignjustify cut copy paste bullist numlist outdent indent blockquote code",

                                style_formats: [
                                    {title: 'Primary text', inline: 'span', styles: {color: 'var(--color-primary)'}},
                                    {title: 'Black text', inline: 'span', styles: {color: 'var(--color-contrast-higher)'}},
                                    {title: 'Red text', inline: 'span', styles: {color: 'var(--color-error)'}},
                                    {title: 'Green text', inline: 'span', styles: {color: 'var(--color-success)'}},
                                    {title: 'Blue text', inline: 'span', styles: {color: 'var(--color-info)'}},
                                ],
                            });
                        </script>
                        <div class="form-group">
                            <label style="display: block" for="type"><?= $Lang->get('WIKI__DESCRIPTION') ?></label>
                            <textarea id="editor" name="text" cols="30" rows="10">
                            <?= $category['text'] ?>
                            </textarea>
                        </div>

                        <button class="btn btn-primary" type="submit"><?= $Lang->get('GLOBAL__UPDATE') ?></button>
                        <a class="btn btn-danger"
                           href="<?= $this->Html->url(array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"><?= $Lang->get('GLOBAL__PREVIOUS') ?></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
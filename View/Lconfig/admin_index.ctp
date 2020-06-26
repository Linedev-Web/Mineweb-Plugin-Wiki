<?= $this->Html->css('Lwiki.admin_config.css') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Information du wiki</h3>
                </div>
                <div class="box-body">
                    <form action="<?= $this->Html->url(array('controller' => 'Lconfig', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          data-redirect-url="<?= $this->Html->url(array('controller' => 'Lconfig', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          method="post" data-ajax="true">
                        <div class="form-group">
                            <label for="text">Titre</label>
                            <input class="form-control" id="text" name="title" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="content">Description</label>
                            <textarea class="form-control" rows="5" id="content" style="w"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary"><?= $Lang->get('GLOBAL__ADD') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class=" col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Modifier les couleurs du thèmes du wiki</h3>
                </div>
                <div class="box-body">
                    <form action="<?= $this->Html->url(array('controller' => 'Lconfig', 'action' => 'color', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          data-redirect-url="<?= $this->Html->url(array('controller' => 'Lconfig', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          method="post" data-ajax="true" class="row">

                        <div class="form-group col-md-2">
                            <label for="color_text">Text</label>
                            <input class="form-control" id="color_text" value="#3c3c3c" name="color_text" type="color"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="color_background">Fond</label>
                            <input class="form-control" id="color_background" value="#efefef" name="color_background"
                                   type="color"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="color_button">Boutton</label>
                            <input class="form-control" id="color_button" value="#c1c1c1" name="color_button"
                                   type="color"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="color_hover">Font au survol</label>
                            <input class="form-control" id="color_hover" value="#606060" name="color_hover"
                                   type="color"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="color_hover-text">Text au survol</label>
                            <input class="form-control" id="color_hover-text" value="#ffffff" name="color_hover_text"
                                   type="color"/>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary"><?= $Lang->get('GLOBAL__EDIT') ?></button>
                            <button type="submit" class="btn btn-danger"><?= $Lang->get('GLOBAL__RESET') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="container" id="canva-wiki">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <li class="list-group-item color--background">
                                <span class="color--text" data-action="type">Catégorie 1</span>
                                <span class="click-element" data-action="category"
                                      data-toggle="collapse" role="button" aria-expanded="false">
                                    <span class="color--text">Sous-catégorie 1</span>
                                </span>
                                <span class="click-element color--hover" data-action="category"
                                      data-toggle="collapse" role="button" aria-expanded="false">
                                    <span class="color--hover-text">Sous-catégorie 2</span>
                                </span>
                                <span class="click-element" data-action="category"
                                      data-toggle="collapse" role="button" aria-expanded="false">
                                    <span class="color--text">Sous-catégorie 3</span>
                                </span>
                                <span class="color--text" data-action="type">Catégorie 2</span>
                                <span class="click-element" data-action="category"
                                      data-toggle="collapse" role="button" aria-expanded="false">
                                    <span class="color--text">Sous-catégorie 1</span>
                                </span>
                                <span class="click-element color--button" data-action="category"
                                      data-toggle="collapse" role="button" aria-expanded="true">
                                    <span class="color--text">
                                        <div class="icon-triangle"></div>Sous-catégorie 2</span>
                                </span>
                                <div class="collapse show">
                                    <span class="click-element" data-action="item">
                                    <span class="color--text">Article 1</span>
                                    </span>
                                    <span class="click-element" data-action="item">
                                    <span class="color--text">Article 1</span>
                                    </span>
                                    <span class="click-element" data-action="item">
                                    <span class="color--text">Article 1</span>
                                    </span>
                                </div>
                                <span class="click-element" data-action="category"
                                      data-toggle="collapse" role="button" aria-expanded="false">
                                    <span class="color--text">Sous-catégorie 3</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9 color--background replace-element">
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                        <div class="block-text"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let colorBackground, colorText, colorButton, colorHover, colorHoverText;

    window.addEventListener("load", startup, false);

    function startup() {
        // Color for colorBackground
        colorBackground = document.querySelector("#color_background");
        colorBackground.addEventListener("input", updateColorBackground, false);
        colorBackground.select();

        // Color for colorText
        colorText = document.querySelector("#color_text");
        colorText.addEventListener("input", updateColorText, false);
        colorText.select();

        // Color for colorButton
        colorButton = document.querySelector("#color_button");
        colorButton.addEventListener("input", updateColorButton, false);
        colorButton.select();

        // Color for colorHover
        colorHover = document.querySelector("#color_hover");
        colorHover.addEventListener("input", updateColorHover, false);
        colorHover.select();

        // Color for colorHoverText
        colorHoverText = document.querySelector("#color_hover-text");
        colorHoverText.addEventListener("input", updateColorHoverText, false);
        colorHoverText.select();
    }

    function updateColorBackground(event) {
        document.querySelectorAll('.color--background').forEach(function (element) {
            element.style.background = event.target.value;
        });
    }

    function updateColorText(event) {
        document.querySelectorAll('.color--text').forEach(function (element) {
            element.style.color = event.target.value;
        });
    }

    function updateColorButton(event) {
        document.querySelectorAll('.color--button').forEach(function (element) {
            element.style.background = event.target.value;
        });
    }

    function updateColorHover(event) {
        document.querySelectorAll('.color--hover').forEach(function (element) {
            element.style.background = event.target.value;
        });
    }

    function updateColorHoverText(event) {
        document.querySelectorAll('.color--hover-text').forEach(function (element) {
            element.style.color = event.target.value;
        });
    }
</script>
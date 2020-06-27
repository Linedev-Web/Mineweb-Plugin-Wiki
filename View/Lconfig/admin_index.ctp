<?= $this->Html->css('Lwiki.admin_config.css') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__CONFIG') ?></h3>
                </div>
                <div class="box-body">
                    <form action="<?= $this->Html->url(array('controller' => 'lconfig', 'action' => 'edit_info', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          data-redirect-url="<?= $this->Html->url(array('controller' => 'lconfig', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          method="post" data-ajax="true">
                        <div class="form-group">
                            <label for="title"><?= $Lang->get('WIKI__NAME') ?></label>
                            <input class="form-control" id="title" name="title" type="text"
                                   value="<?php if ($config['title']) echo $config['title'] ?>"/>

                        </div>
                        <div class="form-group">
                            <label for="content"><?= $Lang->get('WIKI__DESCRIPTION') ?></label>
                            <textarea class="form-control" rows="5" id="content"
                                      name="content"><?php if ($config['content']) echo $config['content'] ?></textarea>
                        </div>
                        <label for="position"><?= $Lang->get('WIKI__CONFIG_ALIGNEMENT') ?></label>
                        <select class="form-control" name="position" id="position">
                            <?php if ($config['position']) : ?>
                                <option value="<?= $config["position"] ?>"><?= $config["position"] ?></option>
                            <?php endif ?>
                            <option value="center">Center</option>
                            <option value="right">Droit</option>
                            <option value="left">Gauche</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary"><?= $Lang->get('GLOBAL__EDIT') ?></button>
                    </form>
                </div>
            </div>
        </div>
        <div class=" col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('WIKI__CONFIG_COLOR') ?></h3>
                </div>
                <div class="box-body">
                    <form action="<?= $this->Html->url(array('controller' => 'Lconfig', 'action' => 'color', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          data-redirect-url="<?= $this->Html->url(array('controller' => 'Lconfig', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                          method="post" data-ajax="true" class="row">

                        <div class="form-group col-md-2">
                            <label for="color_background"><?= $Lang->get('WIKI__CONFIG_FOND') ?></label>
                            <input class="form-control" id="color_background" name="color_background"
                                   type="color"
                                   value="<?php if ($color['color_background']) {
                                       echo $color['color_background'];
                                   } else {
                                       '#efefef';
                                   }; ?>"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="color_text"><?= $Lang->get('WIKI__CONFIG_TEXT') ?></label>
                            <input class="form-control" id="color_text" name="color_text" type="color"
                                   value="<?php if ($color['color_text']) {
                                       echo $color['color_text'];
                                   } else {
                                       '#3c3c3c';
                                   }; ?>"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="color_button"><?= $Lang->get('WIKI__CONFIG_BUTTON') ?></label>
                            <input class="form-control" id="color_button" name="color_button" type="color"
                                   value="<?php if ($color['color_button']) {
                                       echo $color['color_button'];
                                   } else {
                                       '#c1c1c1';
                                   }; ?>"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="color_button_text"><?= $Lang->get('WIKI__CONFIG_BUTTON_TEXT') ?></label>
                            <input class="form-control" id="color_button_text" name="color_button_text" type="color"
                                   value="<?php if ($color['color_button_text']) {
                                       echo $color['color_button_text'];
                                   } else {
                                       '#000000';
                                   }; ?>"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="color_hover"><?= $Lang->get('WIKI__CONFIG_FONT_HOVER') ?></label>
                            <input class="form-control" id="color_hover" name="color_hover" type="color"
                                   value="<?php if ($color['color_hover']) {
                                       echo $color['color_hover'];
                                   } else {
                                       '#606060';
                                   }; ?>"/>
                        </div>
                        <div class=" form-group col-md-2">
                            <label for="color_hover-text"><?= $Lang->get('WIKI__CONFIG_FONT_HOVER_TEXT') ?></label>
                            <input class="form-control" id="color_hover_text" name="color_hover_text" type="color"
                                   value="<?php if ($color['color_hover_text']) {
                                       echo $color['color_hover_text'];
                                   } else {
                                       '#ffffff';
                                   }; ?>"/>
                        </div>
                        <div class=" form-group col-md-12">
                            <a href="#" class="btn btn-primary element-color"><?= $Lang->get('GLOBAL__EDIT') ?></a>
                            <a href="" class="btn btn-danger element-color-reset"><?= $Lang->get('GLOBAL__RESET') ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="container" id="canva-wiki">
                <div class="row">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= $Lang->get('WIKI__CONFIG_DEMO') ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="position--block">
                                <h1 class="page--title"><?= $config['title'] ?></h1>
                                <p><?= $config['content'] ?></p>
                            </div>
                            <div class="contenu-wiki">
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
                                    <span class="color--button-text">
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
        </div>
    </div>
</div>
<script>
    $(function () {
        $(document).ready(function () {
            $('.color--background').css('background', '<?php if ($color['color_background']) {
                echo $color['color_background'];
            } else {
                #efefef;
            }; ?>')
            $('.color--text').css('color', '<?php if ($color['color_text']) {
                echo $color['color_text'];
            } else {
                #3c3c3c;
            }; ?>')
            $('.color--button').css('background', '<?php if ($color['color_button']) {
                echo $color['color_button'];
            } else {
                #c1c1c1;
            }; ?>')
            $('.color--button-text').css('color', '<?php if ($color['color_button_text']) {
                echo $color['color_button_text'];
            } else {
                #000000;
            }; ?>')
            $('.color--hover').css('background', '<?php if ($color['color_hover']) {
                echo $color['color_hover'];
            } else {
                #ffffff;
            }; ?>')
            $('.color--hover-text').css('color', '<?php if ($color['color_hover_text']) {
                echo $color['color_hover_text'];
            } else {
                #efefef;
            }; ?>')
            $('.position--block').css('text-align', '<?php if ($config['position']) {
                echo $config['position'];
            }?>')
        })

        $('.element-color').on('click', function (event) {
            event.preventDefault()
            let color = {};
            color['color_background'] = $('#color_background').val()
            color['color_text'] = $('#color_text').val()
            color['color_button'] = $('#color_button').val()
            color['color_button_text'] = $('#color_button_text').val()
            color['color_hover'] = $('#color_hover').val()
            color['color_hover_text'] = $('#color_hover_text').val()
            console.log(color)

            $.post("<?= $this->Html->url(array('controller' => 'lconfig', 'action' => 'edit_color', 'admin' => true)) ?>", color, function (data) {
                console.log(data)
                if (data.statut) {
                    editElementToast('success', data.msg)
                } else {
                    editElementToast('error', data.msg)
                }
                return true
            });
        })
        $('.element-color-reset').on('click', function (event) {
            event.preventDefault()
            let color = {};
            color['color_background'] = "#efefef"
            color['color_text'] = "#3c3c3c"
            color['color_button'] = "#c1c1c1"
            color['color_button_text'] = "#000000"
            color['color_hover'] = "#606060"
            color['color_hover_text'] = "#ffffff"
            console.log(color)

            $.post("<?= $this->Html->url(array('controller' => 'lconfig', 'action' => 'edit_color', 'admin' => true)) ?>", color, function (data) {
                console.log(data)
                if (data.statut) {
                    $('#color_background').val(color['color_background'])
                    $('#color_text').val(color['color_text'])
                    $('#color_button').val(color['color_button'])
                    $('#color_button_text').val(color['color_button_text'])
                    $('#color_hover').val(color['color_hover'])
                    $('#color_hover_text').val(color['color_hover_text'])
                    $('.color--background').css('background', color['color_background'])
                    $('.color--text').css('color', color['color_text'])
                    $('.color--button').css('background', color['color_button'])
                    $('.color--button-text').css('color', color['color_button_text'])
                    $('.color--hover').css('background', color['color_hover'])
                    $('.color--hover-text').css('color', color['color_hover_text'])

                    editElementToast('success', data.msg)
                } else {
                    editElementToast('error', data.msg)
                }
                return true
            });
        })
    })

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

        // Color for colorButtonText
        colorButton = document.querySelector("#color_button_text");
        colorButton.addEventListener("input", updateColorButtonText, false);
        colorButton.select();

        // Color for colorHover
        colorHover = document.querySelector("#color_hover");
        colorHover.addEventListener("input", updateColorHover, false);
        colorHover.select();

        // Color for colorHoverText
        colorHoverText = document.querySelector("#color_hover_text");
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

    function updateColorButtonText(event) {
        document.querySelectorAll('.color--button-text').forEach(function (element) {
            element.style.color = event.target.value;
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
<?= $this->Html->css('Lwiki.admin_config.css') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="<?= $this->Html->url(array('controller' => 'Lconfig', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                  data-redirect-url="<?= $this->Html->url(array('controller' => 'Lconfig', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true)) ?>"
                  method="post" data-ajax="true">
                <div class="form-group">
                    <label for="text"> Text</label>
                    <input class="form-control" id="text" name="name" type="text"/>
                </div>
                <div class="form-group">
                    <label for="content">Description</label>
                    <textarea class="form-control" rows="5" id="content" style="w"></textarea>
                </div>
                <div class="form-group">
                    <label for="color_text">Couleur Text</label>
                    <input class="form-control" id="color_text" name="color_text" type="color"/>
                </div>
                <div class="form-group">
                    <label for="color_background">Couleur background</label>
                    <input class="form-control" id="color_background" name="color_background" type="color"/>
                </div>
                <div class="form-group">
                    <label for="color_survol">Couleur au survol</label>
                    <input class="form-control" id="color_survol" name="color_survol" type="color"/>
                </div>
                <div class="form-group float-right">
                    <button type="submit" class="icon--custom">
                        <i class="fa fa-pencil"></i>
                    </button>
                </div>
            </form>
            <div id="canva-wiki">
                <div class="row">
                    <div class="col-md-3 color--background">
                        <div class="color--block"><span class="color--text">intellectual</span></div>
                        <div class="color--block"><span class="color--text">metrics</span></div>
                        <div class="color--block color--survol"><span class="color--text">capital</span></div>
                        <div class="color--block"><span class="color--text"> real-time</span></div>
                        <div class="color--block"><span class="color--text">aggregate</span></div>
                    </div>
                    <div class="col-md-9 color--background block--random">
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
    let colorBackground, colorText, colorHover;
    defaultColorBackground = "#0000ff";

    window.addEventListener("load", startup, false);

    function startup() {
        // Color for Background
        colorBackground = document.querySelector("#color_background");
        colorBackground.value = defaultColorBackground;
        colorBackground.addEventListener("input", updateColor('.color--background', event), false);
        colorBackground.select();
    }

    function updateColor(element, event) {
        document.querySelectorAll(element).forEach(function (background) {
            console.log(event.target.value)
            background.style.background = event.target.value;
        });
    }
</script>
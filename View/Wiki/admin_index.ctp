<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $Lang->get('TUTORIAL__ADD') ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post" data-ajax="true">
                                <div class="form-group">
                                    <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary center-block"><?= $Lang->get('GLOBAL__SUBMIT'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive dataTable">
                                <thead>
                                <tr>
                                    <th><?= $Lang->get('TUTORIAL__PSEUDO') ?></th>
                                    <th><?= $Lang->get('TUTORIAL__DATE') ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datas as $data): ?>
                                        <tr>
                                            <td><?= $data['Info']['pseudo']; ?></td>
                                            <td><?= $this->Time->format($data['Info']['date'], '%H:%M, %e %B %Y'); ?></td>
                                            <td><a onclick="confirmDel('/admin/tutorial/tutorial/delete/<?= $data['Info']['id']; ?>')" class="btn btn-danger"><?= $Lang->get('GLOBAL__DELETE') ?></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
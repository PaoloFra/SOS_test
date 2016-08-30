<div class="row">
    <div class="col-md-1">
        <a href="?reset=1" class="nohoverdec">
            <button class="btn btn-link" type="button">
                <span class="glyphicon glyphicon-eye-close"></span>
            </button>
        </a>
    </div>
    <div class="col-md-4">
        <?php echo $this->tag->form(array('', 'id' => 'search-form', 'class' => 'form-inline')); ?>
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <div class="input-group">
                        <?php echo $this->tag->textField(array('term', 'class' => 'form-control', 'placeholder' => 'title 1')); ?>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->tag->endForm(); ?>
    </div>
    <div class="col-md-2"><a href="/" class="btn btn-info">ORM</a> </div>
    <div class="col-md-2"><a href="/index/sql" class="btn btn-info">SQL</a> </div>
    <div class="col-md-2"><a href="/index/ormc" class="btn btn-info">ORM cached</a> </div>
</div>
<div class="row" id="svli">
    <div class="col-md-3"><h2><?php echo $mode; ?></h2></div>
    <div class="col-md-4" id="errmsg"><hr>time elapsed: <?php echo $timer; ?> sec.<hr></div>
</div>

<table class="table table-bordered table-striped" align="center" id="msglist">
    <thead>
    <tr>
        <?php foreach ($headings as $head) { ?>
            <th>
                <?php if ($head['sort'] == false) { ?>
                    <a href="?sort=<?php echo $head['field']; ?>&order=desc"><?php echo $head['name']; ?></a>
                <?php } else { ?>
                    <a href="?sort=<?php echo $head['field']; ?>&order=<?php echo $head['sort']; ?>"><?php echo $head['name'] . $head['arrow']; ?></a>
                <?php } ?>
            </th>
        <?php } ?>

    </tr>
    </thead>
    <tbody>
    <?php if ($page->items) { ?>
        <?php foreach ($page->items as $msg) { ?>
            <tr >
                <td><input type="text" placeholder="Имя" class="form-control" id="name<?php echo $msg->id; ?>" value="<?php echo $msg->id; ?>. <?php echo $msg->cx; ?>" disabled="disabled"></td>
                <td><input type="text" placeholder="телефон" class="form-control" id="phone<?php echo $msg->id; ?>" value="<?php echo $msg->rx; ?>" disabled="disabled"></td>
                <td><input type="text" placeholder="email" class="form-control" id="mail<?php echo $msg->id; ?>" value="<?php echo $msg->title; ?>" disabled="disabled"></td>
                <td><?php if ($msg->TbRel) { ?>
                        <?php foreach ($msg->TbRel as $rel) { ?>
                        <div><?php echo $rel->ndc; ?></div>
                        <?php } ?>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>

</table>

<ul class="pagination">
    <li class=""><a href="?page=1">Первая</a></li>
    <li class=""><a href="?page=<?php echo $page->before; ?>">&#8592;</a></li>
    <li class=""><a href="?page=<?php echo $page->next; ?>">&#8594;</a></li>
    <li class=""><a href="?page=<?php echo $page->last; ?>">Последняя</a></li>
    <li class="disabled"><a href="#"><?php echo $page->current; ?> / <?php echo $page->total_pages; ?></a></li>
</ul>





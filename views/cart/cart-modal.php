<?php use yii\helpers\Html; ?>
<?php if(!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($session['cart'] as $id => $item):?>
                <tr>
                    <td><?= Html::img("@web/images/products/" . $item['img'], ['alt' => $item['name']]); ?></td>
                    <td><?= $item['name']?></td>
                    <td>
                     <input  type="number" name="qty" id="qty" class="form-control" value="<?= $item['qty']?>" placeholder="1">

						<button type="button" class="btn btn-default">
						  <span data-id="<?= $id ?>" class="glyphicon glyphicon-refresh add-to-cart" aria-hidden="true"></span></button>
                    </td>
                    <td><?= $item['price']?></td>
                    <td><span data-id="<?php echo $id; ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                </tr>
            <?php endforeach?>
                <tr>
                    <td colspan="4">Итого: </td>
                    <td><?= $session['cart.qty']?></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму: </td>
                    <td><?= $session['cart.sum']?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif;?>
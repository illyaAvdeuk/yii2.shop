<div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
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
                    <td><?= $item['qty'] * $item['price']?></td>
                </tr>
            <?php endforeach?>
                <tr>
                    <td colspan="5">Итого: </td>
                    <td><?= $session['cart.qty']?></td>
                </tr>
                <tr>
                    <td colspan="5">На сумму: </td>
                    <td><?= $session['cart.sum']?></td>
                </tr>
            </tbody>
        </table>
    </div>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">TOTAL VENDA</h5>
                <h1 class="card-subtitle mb-2 text-muted">R$ <span id="total-products"><?php echo $datas['sum_products'] ?></span></h1>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">TOTAL IMPOSTOS</h5>
                <h1 class="card-subtitle mb-2 text-muted">R$ <span id="total-tax"><?php echo $datas['sum_tax'] ?></span></h1>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Valor Unitário</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Subtotal</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $key => $value) { ?>
                    <tr>
                        <td><?=$value['product_name'] ?></td>
                        <td><?=$value['product_type_name'] ?></td>
                        <td><?=$value['value_product'] ?></td>
                        <td><?=$value['quantity'] ?></td>
                        <td><?=$value['subtotal'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>
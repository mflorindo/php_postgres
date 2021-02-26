<div class="row">
    <div class="col-md-12">
        <input type="hidden" id="id_" value="<?php echo $id_ ?>">

        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="product" class="col-4 col-form-label">Produto</label>
                    <div class="col-8">
                        <select name="product_id" class="form-control" id="product_id">
                            <option value="">Selecione um produto</option>
                            <?php foreach ($products as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] . ' - ' . number_format($value['price'], 2, ',', '.') ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">Quantidade</label>
                    <div class="col-8">
                        <input id="quantity" name="quantity" type="number" required="required" class="form-control" value="1">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <div class="btn-group" role="group" aria-label="button group">
                            <button type="button" onclick="save()" class="btn btn-primary">Incluir Produto</button>
                            <a type="button" href="/sales" class="btn btn-secondary">Finalizar/Voltar</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">TOTAL VENDA</h5>
                <h1 class="card-subtitle mb-2 text-muted">R$ <span id="total-products">0,00</span></h1>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">TOTAL IMPOSTOS</h5>
                <h1 class="card-subtitle mb-2 text-muted">R$ <span id="total-tax">0,00</span></h1>
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
            <tbody id="body-table">
            </tbody>
        </table>

    </div>
</div>

<script>
    $(function() {});

    function save() {
        let product_id = $('#product_id').val();
        let quantity = $('#quantity').val();
        let id_ = $('#id_').val();

        if (product_id == '') {
            alert('Favor selecionar um produto');
            return false;
        }
        $.post("/sales/store", {
                product_id: product_id,
                quantity: quantity,
                id_: id_
            })
            .done(function(data) {

                let line = '';
                $('#id_').val(data.id_);
                $('#total-products').html(data.sum_products);
                $('#total-tax').html(data.sum_tax);
                $('#body-table').html('');
                data.products.forEach(element => {

                    line = '';
                    line = "<tr>" +
                        "<td>" + element.product_name + "</td>" +
                        "<td>" + element.product_type_name + "</td>" +
                        "<td>" + element.value_product + "</td>" +
                        "<td>" + element.quantity + "</td>" +
                        "<td>" + element.subtotal + "</td>" +
                        "</tr>";
                    $('#body-table').append(line);
                });

                alert('Produto inserido com sucesso');
            });

    }
</script>
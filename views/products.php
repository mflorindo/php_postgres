
<?php if (isset($id_)) {?>
    <form method="post" action="/products/update">
<?php } else {?>
    <form method="post" action="/products/store">
<?php }?>

 <input type="hidden" name="id" value="<?php if (isset($id_)) {
    echo $id_;
}
?>">
  <div class="form-group row">
    <label for="name" class="col-4 col-form-label">Produto</label>
    <div class="col-8">
      <input id="name" name="name" type="text" required="required" class="form-control" value="<?php if (isset($name_)) {
    echo $name_;
}
?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="tax" class="col-4 col-form-label">Valor do Produto</label>
    <div class="col-8">
    <input id="price" data-thousands="." data-decimal="," name="price" type="text" required="required" class="form-control currency" value="<?php if (isset($price_)) { echo $price_; }?>">
    </div>
  </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="tax" class="col-4 col-form-label">Tipo de Produto</label>
    <div class="col-8">
      <select name="product_type_id" class="form-control" id="product_type_id">
          <option value="">Selecione um tipo</option>
          <?php foreach ($productsTypes as $key => $value) {?>
            <option value="<?=$value['id']?>"  <?php if ($value['id'] == $product_type_id_) {echo "selected";}?>><?=$value['name']?></option>
         <?php }?>
      </select>

    </div>
  </div>
  <div class="form-group row">
    <div class="offset-4 col-8">
      <div class="btn-group" role="group" aria-label="button group">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a type="button" href="/products" class="btn btn-secondary">Cancelar</a>
      </div>
    </div>
  </div>
</form>



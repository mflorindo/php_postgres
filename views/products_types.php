
<?php if (isset($id_)) {?>
    <form method="post" action="/products-types/update">
<?php } else {?>
    <form method="post" action="/products-types/store">
<?php }?>

 <input type="hidden" name="id" value="<?php if (isset($id_)) {
    echo $id_;
}
?>">
  <div class="form-group row">
    <label for="name" class="col-4 col-form-label">Tipo de Produto</label>
    <div class="col-8">
      <input id="name" name="name" type="text" required="required" class="form-control" value="<?php if (isset($name_)) {
    echo $name_;
}
?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="tax" class="col-4 col-form-label">Valor do imposto</label>
    <div class="col-8">
      <input id="tax" data-thousands="." data-decimal="," name="tax" type="text" class="form-control currency" maxlength="5" value="<?php if (isset($tax_)) {
    echo $tax_;
}
?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-4 col-8">
      <div class="btn-group" role="group" aria-label="button group">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a type="button" href="/products-types" class="btn btn-secondary">Cancelar</a>
      </div>
    </div>
  </div>
</form>



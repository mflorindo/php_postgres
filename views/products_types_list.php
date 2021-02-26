<div class="card">
    <div class="card-body">
        <h5 class="card-title">Consulta Tipos de Produtos <a href="/products-types/new" type="button" class="btn btn-primary btn-sm float-right">Novo Tipo de Produto</a> </h5>
        <hr>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Imposto</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $key => $value) {?>
              <tr>
                <th scope="row"><?=$value['id']?></th>
                <td><?=$value['name']?></td>
                <td><?=number_format($value['tax'], 2, ',', '.')?></td>
                <td>
                    <a type="button" href="/products-types/<?php echo $value['id']; ?>/edit" class="btn btn-sm btn-warning">Alterar</a>
                    <button onclick="deleteRegister(<?=$value['id']?>)" type="button" class="btn btn-sm btn-danger">Excluir</button>
                </td>
              </tr>
                <?php }?>
            </tbody>
          </table>
    </div>
</div>

<script>
  function deleteRegister(id){
    if (confirm('Deseja excluir o item selecionado?')){
      window.location="/products-types/delete/"+id;
    }
  }
</script>
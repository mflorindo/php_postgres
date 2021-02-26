<div class="card">
    <div class="card-body">
        <h5 class="card-title">Consulta Vendas <a href="/sales/new" type="button" class="btn btn-primary btn-sm float-right">Nova Venda</a> </h5>
        <hr>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Data/Hora Venda</th>
                <th scope="col">Quantidade de Produtos</th>
                <th scope="col">Valor dos Produtos</th>
                <th scope="col">Valor dos Impostos</th>                
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $key => $value) {?>
              <tr>
                <td scope="row"><?=$value['id']?></td>                
                <td><?=$value['purchase_date']?></td>
                <td align="right"><?=$value['count_products']?></td>
                <td align="right"><?=$value['sum_products']?></td>
                <td align="right"><?=$value['sum_tax']?></td>
                <td>
                    <a type="button" href="/sales/show/<?php echo $value['id']; ?>" class="btn btn-sm btn-warning">Visualizar</a>
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
      window.location="/sales/delete/"+id;
    }
  }
</script>
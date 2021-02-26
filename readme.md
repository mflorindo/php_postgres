# Projeto Mercado

## Apresentação
### Desenvolvimento de um teste de sistema utilizando PHP 7.4 + Postgres 9.4

## Rodando a aplicação:

### Rode aplicação com o seguinte código: php -S localhost:8000
Detalhe: **Vale frisar que o PHP utilizado no teste foi o 7.4**

## Criando a Base de Dados
### Para fazer a importação da estrutura e de dados exemplos você deverá abrir a pasta dump_database.
Há dois arquivos:<br>
**base.txt**: Para utilização do pg_restore<br>
**base.sql**: Para utilização do psql. <br>
**Crie a base de dados e o schema "public"**

## Alterando os dados de conexão ##
### Para alterar os dados de conexão acesse o arquivo na raiz database.ini e preencha os dados de configuração do seu banco.

## Sobre a pasta database
### Para este projeto teste utilizamos o docker com o postgres 9.4. A pasta database é o volume dos dados. Se for usar um docker com postgres 9.4, aponte o volume para esta pasta e já estará com o banco de dados ativo.

# Agora é testar! :)


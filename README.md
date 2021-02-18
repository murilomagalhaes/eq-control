# <p align="center">EQ Control </p>

O **EQ Control** é um sistema para gerenciamento de entrada e saída de equipamentos para manutenção. 

Com o EQ Control é possívlel registrar a entrada dos equipamentos informando os problemas apresentados, cliente, data de previsão, e mais! O sistema também conta com comprovantes de entrega, e relatórios que podem ser visualizados, impressos, e exportados em excel (.xlsx).


[Demo](https://eqcontrol.murilomagalhaes.tech/)
User: admin
Password: admin@eq_control


## Recursos:

 - Cadastros de clientes, usuários, marcas e tipos de equipamentos.
 - Registros com um ou mais equipamentos simultaneamente.
 - Impressão de comprovantes de entradas e saídas de equipamentos.
 - Visualização, Impressão, e exportação de relatórios.

## Screenshots:

![Alt text](screenshots.png?raw=true "Screenshots")

## Requisitos:

 - PHP ^7.4
 - Extensões PHP requeridas pelo Laravel.

## Instalação:

- Clone o repositório em um diretório de sua preferência.
- Crie um novo arquivo .env baseado no .env.example, alterando as configurações de conexão com o banco de dados. (Sinta-se livre para mudar também os parâmetros de APP_DEBUG, APP_ENV, e Usuário/senha padrões).
- Execute 'composer install --no-dev', 'npm install', e 'npm run prod'. (Ou 'composer install', 'npm install', e 'npm run dev' caso você não esteja em um ambiente de produção).
- Por ultimo, execute 'php artisan key:generate' e 'php artisan migrate:fresh --seed'

## Dicas de operação do sistema:
 - Primeiramente, é importante realizar os cadastros de clientes, marcas, e tipos de equipamentos antes de registrar uma entrada, pois essas informações serão obrigatórias.
 - Ao incluir um registro, preencha as informações necessárias. Note que o 'Nome' e 'Telefone' são referentes a pessoa responsável pela entrega do(s) equipamento(s) naquele momento. 
 - Caso o sistema não esteja imprimindo os comprovantes ou relatórios, certifique-se de que o bloqueador de pop-ups do seu navegador não esteja ativo para o sistema!
 

## Observações:

**Aplicação testada apenas com bancos de dados MySQL**

---
### <p align='center'> Murilo M. Barreto @ 2021  </p>



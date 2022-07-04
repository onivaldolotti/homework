<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Tray</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <script src="../js/script.js"></script>
</head>
<body>
    <header>
        <h1>Teste Tray</h1>
    </header>
    <div class="horizontal-menu">
        <ul>
            <li><a href="" id='menu1' onclick="show('register_seller')">Cadastro de Vendedor</a></li>
            <li><a href="" id='menu2' onclick="show('register_sale')">Cadastro de Vendas</a></li>
            <li><a href="" id='menu3' onclick="show('sellers')">Vendedores</a></li>
            <li><a href="" id='menu4' onclick="show('seller_sales')">Vendas por Vendedor</a></li>
        </ul>
    </div>
    <div id="loader" class="loader" style="display: none"></div>
    <main id='main'>
        
        <div class="card" id="register_seller_card">
            <div class="title">
                <h2>Cadastro de Vendedor</h2>
            </div>
            <div class="lineInput">
                <label>Nome</label>
                <input type="text" id="name" placeholder="nome do vendedor" required>
            </div>
            <div class="lineInput">
                <label>Email</label>
                <input type="email" id="email" placeholder="email do vendedor" required>
            </div>

            <button type="button" onclick="storeSeller()">Cadastrar</button>
        </div>

        <div class="card" id="register_sale_card" style="display: none">
            <div class="title">
                <h2>Cadastro de Venda</h2>
            </div>
            <div class="lineInput">
                <label>Vendedores</label>
                <select id="sellers">
            
                </select>
            </div>
            <div class="lineInput">
                <label>Valor da venda</label>
                <input type="text" id="value" placeholder="valor da venda" required>
            </div>

            <button type="button" onclick="storeSale()">Cadastrar</button>
        </div>

        <div class="card" id="sellers_card" style="display: none">
            <div class="title">
                <h2>Vendedores</h2>
            </div>
            <div class="content">
                <table>
                    <thead>
                        <th class="center">ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Comissão</th>
                    </thead>
                    <tbody id="sellers_body">
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card" id="seller_sales_card" style="display: none">
            <div class="title">
                <h2>Venda do Vendedor</h2>
            </div>
            <div class="lineInput">
                <label>Vendedores</label>
                <select id="seller_sales_select">
            
                </select>
            </div>
            
            <button type="button" onclick="listSellerSales()">Buscar</button>
            
            <div class="content" id="table_sales" style="display: none">
                <table>
                    <thead>
                        <th class="center">ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Comissão</th>
                        <th>Valor da venda</th>
                        <th>Data da venda</th>
                    </thead>
                    <tbody id="sales_body">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
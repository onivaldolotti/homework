const baseUrl = 'http://localhost:8090';

async function storeSale() {
    loader();
    const seller_id = +document.getElementById('sellers').value;
    const value = document.getElementById('value').value.replace('.', '').replace(',','.');

    if(validaCampos('sale', {seller_id, value})) {
        const body = {
            value,
            seller_id
        }
        const res = await fetch(`${baseUrl}/api/sales`, {
            method: 'post',
            body: JSON.stringify(body),
            headers: {"Content-type": "application/json;"}
        })
        const sale = await res.json();
        if(response.success) {
            alert(`Venda cadastrada com Sucesso.\n 
                id: ${sale.data.id}\n
                nome: ${sale.data.name}\n
                email: ${sale.data.email}\n
                comissão: ${sale.data.commission}\n
                data da venda: ${new Date(sale.data.created_at).toLocaleString('pt-br')}
            `);
            document.getElementById('value').value = '';
        }else {
            alert(`Erro no servidor, verifique os dados e tente novamente`) 
            console.log(response.errors);
        }
    }

    loader(false);
}

async function storeSeller() {
    loader();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;

    if(validaCampos('seller', {name, email})) {
        const body = {
            name,
            email
        };

        const res = await fetch(`${baseUrl}/api/sellers`, {
            method: 'post',
            body: JSON.stringify(body),
            headers: {"Content-type": "application/json;"}
        });

        const seller = await res.json();

        if(response.success) {
            alert(`Vendedor cadastrado com Sucesso.\n 
                id: ${sale.data.id}\n
                nome: ${sale.data.name}\n
                email: ${sale.data.email}\n
            `);
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
        }else {
            alert(`Erro no servidor, verifique os dados e tente novamente`) 
            console.log(response.errors);
        }
    }

    
    loader(false);
}

async function listSellers() {
    loader();
    const res = await fetch(`${baseUrl}/api/sellers`)
    const sellers = await res.json();
   
    const sellersTableBody = document.getElementById('sellers_body');
    sellersTableBody.innerText = '';

    for(const seller of sellers.data) {
        let tr = sellersTableBody.insertRow();

        let id = tr.insertCell();
        let name = tr.insertCell();
        let email = tr.insertCell();
        let commission = tr.insertCell();

        id.innerText = seller.id;
        name.innerText = seller.name;
        email.innerText = seller.email;
        commission.innerText = `R$ ${seller.commission.replace('.',',')}`;

        id.classList.add('center');
    };
    loader(false);
}

async function listSellerSales() {
    loader(true);
    const seller_id = +document.getElementById('seller_sales_select').value;

    if(validaCampos('seller_sales',{seller_id})){
        const res = await fetch(`${baseUrl}/api/sales/${seller_id}`)
        const sales = await res.json();

        if(!sales.success) {
            alert(JSON.stringify(sellers.errors));
            // loader(false);
            return;
        }
    
        const id = sales.data.seller_id;
        const name = sales.data.name;
        const email = sales.data.email;

        const salesTableBody = document.getElementById('sales_body');
        salesTableBody.innerHTML = '';

        document.getElementById('table_sales').style.display = 'block';

        for(const sale of sales.data.sales) {
            let tr = salesTableBody.insertRow();

            let id_cell = tr.insertCell();
            let name_cell = tr.insertCell();
            let email_cell = tr.insertCell();
            let commission = tr.insertCell();
            let value = tr.insertCell();
            let date = tr.insertCell();

            id_cell.innerText = id;
            name_cell.innerText = name;
            email_cell.innerText = email;
            commission.innerText = `R$ ${sale.commission.replace('.',',')}`;
            value.innerText = `R$ ${sale.value.replace('.',',')}`;
            date.innerText = new Date(sale.created_at).toLocaleString('pt-br');

            id_cell.classList.add('center');
        };
    }

    loader(false);
}

document.addEventListener("DOMContentLoaded",async function(){
   const menu1 = document.getElementById('menu1');
   const menu2 = document.getElementById('menu2');
   const menu3 = document.getElementById('menu3');
   const menu4 = document.getElementById('menu4');

   menu1.addEventListener("click", (event) => {
    event.preventDefault();
   })

   menu2.addEventListener("click", (event) => {
    event.preventDefault();
   })

   menu3.addEventListener("click", (event) => {
    event.preventDefault();
   })

   menu4.addEventListener("click", (event) => {
    event.preventDefault();
   })
})

function loader(show = true){
    if(show) {
        document.getElementById('main').style.display = "none";
        document.getElementById('loader').style.display = "block";
    }else {
        document.getElementById('main').style.display = "block";
        document.getElementById('loader').style.display = "none";
    }
}

function show(menu) {
    switch(menu) {
        case "register_seller":
            document.getElementById('register_seller_card').style.display = "block";
            document.getElementById('register_sale_card').style.display = "none";
            document.getElementById('sellers_card').style.display = "none";
            document.getElementById('seller_sales_card').style.display = "none";
            break;
        case "register_sale":
            document.getElementById('register_seller_card').style.display = "none";
            document.getElementById('register_sale_card').style.display = "block";
            document.getElementById('sellers_card').style.display = "none";
            document.getElementById('seller_sales_card').style.display = "none";
            mountSellersSelect('sellers');
            break;
        case "sellers":
            document.getElementById('register_seller_card').style.display = "none";
            document.getElementById('register_sale_card').style.display = "none";
            document.getElementById('sellers_card').style.display = "block";
            document.getElementById('seller_sales_card').style.display = "none";
            listSellers();
            break;
        case "seller_sales":
            document.getElementById('register_seller_card').style.display = "none";
            document.getElementById('register_sale_card').style.display = "none";
            document.getElementById('sellers_card').style.display = "none";
            document.getElementById('seller_sales_card').style.display = "block";
            mountSellersSelect('seller_sales_select');
            break;
        default:    
            break;
    }
}

function validaCampos(tela,campos){
    let msg = '';

    if(tela == 'seller') {
        if(campos['name'] == '' ) {
            msg+= 'Informe o nome do vendedor.\n';
        }

        if(campos['email'] == '' ) {
            msg+= 'Informe o email do vendedor.';
        }

        let emailRegex = /\S+@\S+\.\S+/;
        if(!emailRegex.test(campos['email'])) {
            msg+= 'Formato de email invalido';
        }
    }

    if(tela == 'sale') {
        if(campos['seller_id'] == '' || campos['seller_id'] <= 0) {
            msg+= 'Informe o vendedor, caso não exista nenhum, cadastre antes de usar essa funcionalidade.\n';
        }

        if(campos['value'] == '' ) {
            msg+= 'Informe o valor da venda.';
        }
    }

    if(tela == 'seller_sales') {
        if(campos['seller_id'] == '' || campos['seller_id'] <= 0) {
            msg+= 'Informe o vendedor, caso não exista nenhuma, cadastre antes de usar essa funcionalidade.';
        }
    }

    if(msg != '') {
        alert(msg);
        return false;
    }

    return true;
}

async function mountSellersSelect(menu) {
    loader();
    const res = await fetch(`${baseUrl}/api/sellers`)
    const sellers = await res.json();
    loader(false);
    if(!sellers.success) {
        alert(JSON.stringify(sellers.errors));
        return;
    }

    const select = document.getElementById(menu);
    select.innerHTML = '';

    if(sellers.data.lenght < 1) {
        select.append(new Option('Nenhum vendedor cadastrado',0));
    }else {
        sellers.data.forEach(function(element, key) {
            select.append(new Option(element.name,element.id));
        });
    }
}
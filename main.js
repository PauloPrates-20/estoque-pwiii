// Form inputs
const inputProduto = document.getElementById('produto');
const inputPreco = document.getElementById('preco');
const inputQuantidade = document.getElementById('qtd');

// Submit button
const submitButton = document.getElementById('submit');

// Product list
const productList = document.getElementById('lista-produtos');

/* Requests */
// Read database
function getProducts() {
    console.log('Lendo produtos...');

    const request = new XMLHttpRequest();
    request.open('GET', 'read.php', true);

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            let products = JSON.parse(this.responseText);
            let html = '';

            products.forEach(product => {
                html += `
                    <li>
                        ${product.nome} - R$${parseFloat(product.preco).toFixed(2)} - ${product.qtd}
                        <span>
                            <span class="delete action" id="del${product.id}">Deletar</span>
                            <span class="edit action" id="edit${product.id}">Editar</span>
                        </span>
                    </li>
                `;
            });

            productList.innerHTML = html;

            // Delete event listener
            for (const element of document.getElementsByClassName('delete')) {
                element.addEventListener('click', function () {
                    const id = parseInt(this.getAttribute('id').replace('del', ''));
                    deleteProduct({ id: id });
                });
            }
        }
    }

    request.send();
}

// Insert into database
function insertProduct(data) {
    const request = new XMLHttpRequest();
    request.open('POST', 'create.php', true);
    request.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            console.log(this.responseText);
            getProducts();
        }
    }

    request.send(JSON.stringify(data));

}

// Delete from database
function deleteProduct(id) {
    const request = new XMLHttpRequest();
    request.open('POST', 'delete.php', true);
    request.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            console.log(this.responseText);
            getProducts();
        }
    }

    request.send(JSON.stringify(id));

}

/* Event Listeners */

// Submit event listener
submitButton.addEventListener('click', () => {
    const produto = inputProduto.value;
    const preco = parseFloat(inputPreco.value);
    const qtd = parseInt(inputQuantidade.value);

    const data = {produto: produto, preco: preco, qtd: qtd };

    insertProduct(data);

    inputProduto.value  = '';
    inputPreco.value = '';
    inputQuantidade.value = '';
});

// Initial load
window.onload = () => {
    getProducts();
}
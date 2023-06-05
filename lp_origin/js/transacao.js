var loginInput = document.querySelector(".modal-link");

// Seleciona a div overlay e o modal
var overlay = document.querySelector(".overlay");
var modal = document.querySelector(".modal");

// Adiciona um ouvinte de evento de clique ao link "Login"
loginInput.addEventListener("click", function (event) {
    event.preventDefault(); // Evita o comportamento padrão do link

    // Exibe a overlay e o modal
    overlay.style.display = "block";
    modal.style.display = "block";
});

const modalInputs = document.querySelectorAll('.modal-link input');
const forms = document.querySelectorAll('.modal form');

modalInputs.forEach((input, index) => {
    input.addEventListener('click', (e) => {
        e.preventDefault();
        forms.forEach((form) => {
            form.style.display = 'none';
        });
        forms[index].style.display = 'block';
    });
});

function fecharModal() {
    var modal = document.querySelector('.modal');
    var overlay = document.querySelector('.overlay');
    modal.style.display = 'none'; // Oculta o modal
    overlay.style.display = 'none'; // Oculta o overlay
}

// Seleciona os elementos relevantes
const cartaoCreditoForm = document.getElementById('cartao-credito-form');
const cartaoDebitoForm = document.getElementById('cartao-debito-form');
const paymentMethods = document.querySelector('.payment_methods');

// Adiciona um ouvinte de evento de alteração à seção de métodos de pagamento
paymentMethods.addEventListener('change', function() {
    if (document.getElementById('cartao-credito-form').checked) {
        cartaoCreditoForm.style.display = 'block';
        cartaoDebitoForm.style.display = 'none';
    } else if (document.getElementById('cartao-debito-form').checked) {
        cartaoCreditoForm.style.display = 'none';
        cartaoDebitoForm.style.display = 'block';
    } else {
        cartaoCreditoForm.style.display = 'none';
        cartaoDebitoForm.style.display = 'none';
    }
});

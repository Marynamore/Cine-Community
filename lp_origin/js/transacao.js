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

var paymentMethodSelect = document.getElementById('payment-method');
var forms = document.querySelectorAll('.modal form');

paymentMethodSelect.addEventListener('change', function() {
    var selectedOption = paymentMethodSelect.options[paymentMethodSelect.selectedIndex].value;
    forms.forEach(function(form) {
        form.style.display = 'none';
    });
    document.getElementById(selectedOption + '-form').style.display = 'block';
});

function fecharModal() {
    var modal = document.querySelector('.modal');
    var overlay = document.querySelector('.overlay');
    modal.style.display = 'none'; // Oculta o modal
    overlay.style.display = 'none'; // Oculta o overlay
}


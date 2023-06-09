var loginInput = document.querySelector(".modal-link");
var overlay = document.querySelector(".overlay");
var modal = document.querySelector(".modal");

loginInput.addEventListener("click", function (event) {
  event.preventDefault();
  overlay.style.display = "block";
  modal.style.display = "block";
});

var paymentMethodSelect = document.getElementById('payment-method');
var forms = document.querySelectorAll('.modal form');

paymentMethodSelect.addEventListener('change', function () {
  var selectedOption = paymentMethodSelect.value;
  forms.forEach(function (form) {
    form.style.display = 'none';
  });
  document.getElementById(selectedOption + '-form').style.display = 'block';
});

function fecharModal() {
  modal.style.display = 'none';
  overlay.style.display = 'none';
}


const quantityButtons = document.querySelectorAll('.quantity-button');
const quantityInput = document.querySelector('.quantity-input');

quantityButtons.forEach(button => {
  button.addEventListener('click', () => {
    let quantity = parseInt(quantityInput.value);
    if (button.classList.contains('decrease') && quantity > 1) {
      quantity--;
    } else if (button.classList.contains('increase')) {
      quantity++;
    }
    quantityInput.value = quantity;
  });
});
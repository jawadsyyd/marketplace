const quantity_input = document.querySelectorAll('.quantity-input');
const increase = document.querySelectorAll('.increase');
const decrease = document.querySelectorAll('.decrease');

for (let i = 0; i < quantity_input.length; i++) {
  increase[i].addEventListener('click', () => {
    let currentValue = parseInt(quantity_input[i].value);
    quantity_input[i].value = currentValue + 1;
  });

  decrease[i].addEventListener('click', () => {
    let currentValue = parseInt(quantity_input[i].value);
    if (currentValue > 0) {
      quantity_input[i].value = currentValue - 1;
    }
  });
}
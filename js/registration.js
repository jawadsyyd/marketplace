var phone = document.getElementById('phone'),
  address = document.getElementById('address'),
  role = document.getElementById('role'),
  labelPhone = document.querySelector('.lPhone'),
  lAddress = document.querySelector('.lAddress');

role.addEventListener('change', () => {
  if (role.value === 'Costumer') {
    document.getElementById('phone').classList.toggle('d-none');
    document.getElementById('address').classList.toggle('d-none');
    document.querySelector('.lPhone').classList.toggle('d-none');
    document.querySelector('.lAddress').classList.toggle('d-none');
  } else {
    document.getElementById('phone').classList.toggle('d-none');
    document.getElementById('address').classList.toggle('d-none');
    document.querySelector('.lPhone').classList.toggle('d-none');
    document.querySelector('.lAddress').classList.toggle('d-none');
  }
});
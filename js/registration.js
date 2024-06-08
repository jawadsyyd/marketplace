var phone = document.getElementById('phone'),
  address = document.getElementById('address'),
  role = document.getElementById('role'),
  labelPhone = document.querySelector('.lPhone'),
  lAddress = document.querySelector('.lAddress');

role.addEventListener('change', () => {
  if (role.value === 'Costumer') {
    phone.classList.remove('d-none');
    address.classList.remove('d-none');
    labelPhone.classList.remove('d-none');
    lAddress.classList.remove('d-none');
  } else {
    phone.classList.add('d-none');
    address.classList.add('d-none');
    labelPhone.classList.add('d-none');
    lAddress.classList.add('d-none');
  }
});
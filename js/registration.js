var phone = document.getElementById('phone'),
  address = document.getElementById('address'),
  role = document.getElementById('role'),
  labelphone = document.querySelector('.lphone'),
  laddress = document.querySelector('.laddress');

if (role.value === 'Customer') {
  phone.classList.remove('d-none');
  address.classList.remove('d-none');
  labelphone.classList.remove('d-none');
  laddress.classList.remove('d-none');
} else {
  phone.classList.add('d-none');
  address.classList.add('d-none');
  labelphone.classList.add('d-none');
  laddress.classList.add('d-none');
}

role.addEventListener('change', () => {
  if (role.value === 'Costumer') {
    phone.classList.remove('d-none');
    address.classList.remove('d-none');
    labelphone.classList.remove('d-none');
    laddress.classList.remove('d-none');
  } else {
    phone.classList.add('d-none');
    address.classList.add('d-none');
    labelphone.classList.add('d-none');
    laddress.classList.add('d-none');
  }
});
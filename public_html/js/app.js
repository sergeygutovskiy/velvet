const modalOpenBtn = document.querySelector('#modal-open-btn');
const modalCloseBtn = document.querySelector('#modal-close-btn');

const modalWrapper = document.querySelector('#modal-wrapper');
const modal = document.querySelector('#modal');

const content = document.querySelector('#content');
const backImg = document.querySelector('#background-img');

if ( modalOpenBtn && modalWrapper && modal && content && backImg ) {
  modalOpenBtn.addEventListener('click', () => {
    content.classList.add('hidden');
    modalWrapper.classList.add('active');
  });

  modalWrapper.addEventListener('click', e => {
    if ( e.target !== modalWrapper ) return;

    content.classList.remove('hidden');
    modalWrapper.classList.remove('active');
  });

  modalCloseBtn.addEventListener('click', e => {
    content.classList.remove('hidden');
    modalWrapper.classList.remove('active');
  });
}

// 

const pricePlusBtn = document.querySelector('#plus-btn');
const priceMinusBtn = document.querySelector('#minus-btn');

const priceInput = document.querySelector('#price-input');
const priceTotal = document.querySelector('#price-total');
const oldPriceTotal = document.querySelector('#price-total-old');

const PRICE = Number.parseInt(document.querySelector('#price')?.value);
const PRICE_DISCOUNT = Number.parseInt(document.querySelector('#price-discount')?.value);
const DISCOUNT_MIN_QUANTITY = 3;

if ( pricePlusBtn && priceMinusBtn && priceInput && priceTotal && PRICE && PRICE_DISCOUNT && oldPriceTotal ) {
  pricePlusBtn.addEventListener('click', () => {
    const quantity = Number.parseInt(priceInput.value); 
    
    priceInput.value = quantity + 1;
    priceMinusBtn.removeAttribute('disabled');

    const currentQuantity = quantity + 1;
    updateSumLabel(currentQuantity);
  });

  priceMinusBtn.addEventListener('click', () => {
    const quantity = Number.parseInt(priceInput.value); 
    
    priceInput.value = quantity - 1;
    if ( quantity - 1 === 1) priceMinusBtn.setAttribute('disabled', 'true');
    
    const currentQuantity = quantity - 1;
    updateSumLabel(currentQuantity);
  });

  priceInput.addEventListener('change', e => {
    if ( e.target.value !== '' ) return;
    e.target.value = 1;
  });

  const updateSumLabel = quantity => {
    if ( quantity >= DISCOUNT_MIN_QUANTITY ) {
      oldPriceTotal.innerText = quantity * PRICE;
      oldPriceTotal.classList.add('active');
      
      priceTotal.innerText = `${quantity * PRICE_DISCOUNT} РУБ`;

      return;
    }

    oldPriceTotal.classList.remove('active');
    priceTotal.innerText = `${quantity * PRICE} РУБ`;
  };
}

// 

const updateAppHeight = () => {
  const doc = document.documentElement;
  doc.style.setProperty('--app-height', `${window.innerHeight}px`);
};

window.addEventListener('resize', updateAppHeight);
updateAppHeight();

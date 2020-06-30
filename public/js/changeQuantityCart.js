let quantity = 1;
const input = document.getElementById('quantity');
input.value = quantity;

const decrement = document.getElementById('decrementQuan');
const increment = document.getElementById('incrementQuan');

increment.addEventListener('click', () => {
    quantity += 1;
    input.value = quantity;
});

decrement.addEventListener('click', () => {
    if(quantity == 1) {
        return;
    }

    quantity -= 1;
    input.value = quantity;
});

input.addEventListener('change', () => {
    const testString = /[a-zA-Z]/g;
    let value = parseInt(input.value);

    if(value < 1) {
        input.value = quantity;
    }
    if(testString.test(input.value)) {
        input.value = quantity;
    }
});
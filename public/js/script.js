const element = document.getElementById('phone');
const maskOptions = {
    mask: '+{} (000) 00-000-00-00'
};
const mask = IMask(element, maskOptions);
const moneyInput = document.getElementById('payment');

moneyInput.addEventListener('keydown', function(event) {
    const value = moneyInput.value;

    // Запрещаем ввод нуля в начале числа
    if (value === '0' && event.key !== 'Backspace' && event.key !== 'Delete') {
        event.preventDefault();
    }

    if (event.key === '+' || event.key === '-') {
        event.preventDefault();
    }
});


const checkBox = document.querySelector('#flexCheckChecked');
const disabled = document.querySelectorAll('.hidden');

checkBox.addEventListener('change', ()=>{
    disabled.forEach(element => {
        input = element.querySelector('input');
        if(checkBox.checked){
            element.classList.add('on');
            input.disabled = true;
            console.log(element);
        }else{
            element.classList.remove('on');
            console.log('off');
            input.disabled = false;


        }
    });
})


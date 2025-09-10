const button = document.getElementById('throw');
const countValues = document.getElementsByClassName('count-value');

console.log('Hello world!');

function rollDice(){
    let count = {
        1: 0,
        2: 0,
        3: 0,
        4: 0,
        5: 0,
        6: 0,
    };
    let rolledDice = [];
    for (let i = 0; i < 8; i++) {
        let diceRoll = Math.floor(Math.random() * 6) + 1;
        count[diceRoll] ++;
        rolledDice.push(diceRoll);
    }
    console.log(rolledDice);
    console.table(count);

    for (let i = 0; i < countValues.length; i++){
        countValues[i].innerHTML = count[i+1];
    }

}

button.addEventListener('click', rollDice);
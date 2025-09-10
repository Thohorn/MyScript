const button = document.getElementById("throw");
const throwResults = document.getElementsByClassName("throw-result");


function simulateThrow() {
    let diceRolls = [];
    for (let i = 0; i < 5; i++) {
        let diceRoll = Math.floor(Math.random() * 6) + 1;
        diceRolls.push(diceRoll);
        throwResults[i].innerHTML = diceRoll;
    }
    console.log(diceRolls);
}


button.addEventListener('click', simulateThrow);
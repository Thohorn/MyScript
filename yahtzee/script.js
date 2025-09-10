const button = document.getElementById("throw");
const throwResults = document.getElementsByClassName("throw-result");

const scoreFirstGame = document.getElementsByClassName("first-game");

const indexTable = {
    'ones': 0,
    'twos': 1,
    'threes': 2,
    'fours': 3,
    'fives': 4,
    'sixes': 5,
    'total p1 without bonus': 6,
    'bonus': 7,
    'total p1 top': 8,
    'three of a kind': 9,
    'carre': 10,
    'full house': 11,
    'small street': 12,
    'big street': 13,
    'topscore': 14,
    'chance': 15,
    'total p2': 16,
    'total p1 bottom': 17,
    'total total': 18
}


function simulateThrows() {
    let myThrows = {
        1: 0,
        2: 0,
        3: 0,
        4: 0,
        5: 0,
        6: 0,
    };
    for (let i = 0; i < 5; i++) {
        let diceRoll = Math.floor(Math.random() * 6) + 1;
        throwResults[i].innerHTML = diceRoll;
        myThrows[diceRoll]++;
    }
    return myThrows;
}

function calculateTotalP1(throws) {
    let newTotal = 0;
    for (let singlethrow in throws) {
        newTotal += (throws[singlethrow] * singlethrow);
    }

    return newTotal;
}


function fillInScoreBlockPart1(throws) {
    scoreFirstGame[indexTable['ones']].innerHTML = throws[1] * 1;
    scoreFirstGame[indexTable['twos']].innerHTML = throws[2] * 2;
    scoreFirstGame[indexTable['threes']].innerHTML = throws[3] * 3;
    scoreFirstGame[indexTable['fours']].innerHTML = throws[4] * 4;
    scoreFirstGame[indexTable['fives']].innerHTML = throws[5] * 5;
    scoreFirstGame[indexTable['sixes']].innerHTML = throws[6] * 6;

    let newTotal = calculateTotalP1(throws);
    scoreFirstGame[indexTable['total p1 without bonus']].innerHTML = newTotal;

    if (newTotal > 63) {
        scoreFirstGame[indexTable['bonus']].innerHTML = 35;
        newTotal += 35;
    } else {
        scoreFirstGame[indexTable['bonus']].innerHTML = 0;
    }

    scoreFirstGame[indexTable['total p1 top']].innerHTML = newTotal;
}


function fillInScoreBlock() {
    let throws = simulateThrows();
    fillInScoreBlockPart1(throws);
    fillInScoreBlockPart2(throws);

}

button.addEventListener('click', fillInScoreBlock);
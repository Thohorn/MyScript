const button = document.getElementById("throw");
const throwResults = document.getElementsByClassName("throw-result");

const scoreFirstGame = document.getElementsByClassName("first-game");
const scoreSecondGame = document.getElementsByClassName("second-game");
const scoreThirdGame = document.getElementsByClassName("third-game");
const scoreFourthGame = document.getElementsByClassName("fourth-game");
const scoreFifthGame = document.getElementsByClassName("fifth-game");
const scoreSixthGame = document.getElementsByClassName("sixth-game");

const possibleGames = document.getElementsByClassName("game");

const throws = {
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0,
    6: 0,
};

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
    'small straight': 12,
    'large straight': 13,
    'topscore': 14,
    'chance': 15,
    'total p2': 16,
    'total p1 bottom': 17,
    'total total': 18
}

const gameTable = {
    'first-game': scoreFirstGame,
    'second-game': scoreSecondGame,
    'third-game': scoreThirdGame,
    'fourth-game': scoreFourthGame,
    'fifth-game': scoreFifthGame,
    'sixth-game': scoreSixthGame
}

function checkGame() {
    for (let game in possibleGames) {
        if (possibleGames[game].checked) {
            return possibleGames[game].value
        }
    }
}

function cleanThrows() {
    for (let singlethrow in throws) {
        throws[singlethrow] = 0;
    }
}

function simulateThrows() {
    for (let i = 0; i < 5; i++) {
        let diceRoll = Math.floor(Math.random() * 6) + 1;
        throwResults[i].innerHTML = diceRoll;
        throws[diceRoll]++;
    }
}

function calculateThrowTotal() {
    let newTotal = 0;
    for (let singlethrow in throws) {
        newTotal += (throws[singlethrow] * singlethrow);
    }

    return newTotal;
}

function fillInScoreBlockPart1(game) {
    gameTable[game][indexTable['ones']].innerHTML = throws[1] * 1;
    gameTable[game][indexTable['twos']].innerHTML = throws[2] * 2;
    gameTable[game][indexTable['threes']].innerHTML = throws[3] * 3;
    gameTable[game][indexTable['fours']].innerHTML = throws[4] * 4;
    gameTable[game][indexTable['fives']].innerHTML = throws[5] * 5;
    gameTable[game][indexTable['sixes']].innerHTML = throws[6] * 6;

    let newTotal = calculateThrowTotal(throws);
    gameTable[game][indexTable['total p1 without bonus']].innerHTML = newTotal;

    if (newTotal > 63) {
        gameTable[game][indexTable['bonus']].innerHTML = 35;
        newTotal += 35;
    } else {
        gameTable[game][indexTable['bonus']].innerHTML = 0;
    }

    gameTable[game][indexTable['total p1 top']].innerHTML = newTotal;

    return newTotal;
}

function checkXOfAKind(targetValue) {
    for (let singlethrow in throws) {
        if (throws[singlethrow] >= targetValue) {
            return true;
        }
    }
    return false;

}

function checkFullHouse() {
    for (let singlethrow in throws) {
        if (throws[singlethrow] === 2 && checkXOfAKind(3)) {
            return true;
        }
    }
    return false;
}

function checkStraight(straightLength) {
    let counter = 0;
    for (let singlethrow in throws) {
        if (throws[singlethrow] >= 1) {
            counter++;
        } else {
            counter = 0;
        }
        if (counter >= straightLength) {
            return true;
        }
    }
    return false;
}

function calculateTotalP2(game) {
    let newTotal = 0;
    for (let i = 9; i < 16; i++) {
        newTotal += parseInt(gameTable[game][i].innerHTML);
    }
    return newTotal;
}

function fillInScoreBlockPart2(game, p1Score) {
    let throwTotal = calculateThrowTotal();

    gameTable[game][indexTable['three of a kind']].innerHTML = checkXOfAKind(3) ? throwTotal : 0;
    gameTable[game][indexTable['carre']].innerHTML = checkXOfAKind(4) ? throwTotal : 0;
    gameTable[game][indexTable['full house']].innerHTML = checkFullHouse() ? 25 : 0;
    gameTable[game][indexTable['small straight']].innerHTML = checkStraight(4) ? 30 : 0;
    gameTable[game][indexTable['large straight']].innerHTML = checkStraight(5) ? 40 : 0;
    gameTable[game][indexTable['topscore']].innerHTML = checkXOfAKind(5) ? 50 : 0;
    gameTable[game][indexTable['chance']].innerHTML = throwTotal;

    let totalP2 = calculateTotalP2(game);
    gameTable[game][indexTable['total p2']].innerHTML = totalP2;
    gameTable[game][indexTable['total p1 bottom']].innerHTML = p1Score;
    gameTable[game][indexTable['total total']].innerHTML = totalP2 + p1Score;
}


function fillInScoreBlock() {
    let game = checkGame();
    cleanThrows();
    let throws = simulateThrows();
    let p1Score = fillInScoreBlockPart1(game, throws);
    fillInScoreBlockPart2(game, p1Score);

}

button.addEventListener('click', fillInScoreBlock);
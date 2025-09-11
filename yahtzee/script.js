const button = document.getElementById("throw");
const throwResults = document.getElementsByClassName("throw-result");

const scoreFirstGame = document.getElementsByClassName("first-game");
const scoreSecondGame = document.getElementsByClassName("second-game");
const scoreThirdGame = document.getElementsByClassName("third-game");
const scoreFourthGame = document.getElementsByClassName("fourth-game");
const scoreFifthGame = document.getElementsByClassName("fifth-game");
const scoreSixthGame = document.getElementsByClassName("sixth-game");

const possibleGames = document.getElementsByClassName("game");

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

function calculateThrowTotal(throws) {
    let newTotal = 0;
    for (let singlethrow in throws) {
        newTotal += (throws[singlethrow] * singlethrow);
    }

    return newTotal;
}


function fillInScoreBlockPart1(game, throws) {
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

function checkThreeOfAKind(throws) {
    for (let singlethrow in throws) {
        if (throws[singlethrow] >= 3) {
            return true;
        }
    }
    return false;
}

function checkCarre(throws, threeofAKind) {
    if (!threeofAKind) {
        return false;
    }

    for (let singlethrow in throws) {
        if (throws[singlethrow] >= 4) {
            return true;
        }
    }
    return false;
}

function checkFullHouse(throws, threeofAKind) {
    if (!threeofAKind) {
        return false;
    }
    for (let singlethrow in throws) {
        if (throws[singlethrow] === 2) {
            return true;
        }
    }
    return false;
}

function checkSmallStraight(throws) {
    if (throws[3] != 1) {
        return false;
    } else if (throws[1] === 1 && throws[2] === 1 && throws[3] === 1 && throws[4] === 1) {
        return true;
    } else if (throws[2] === 1 && throws[3] === 1 && throws[4] === 1 && throws[5] === 1) {
        return true;
    } else if (throws[3] === 1 && throws[4] === 1 && throws[5] === 1 && throws[6] === 1) {
        return true;
    } else {
        return false;
    }
}

function checkLargeStraight(throws, smallStraight) {
    if (smallStraight === false) {
        return false;
    } else if (throws[1] === 1 && throws[2] === 1 && throws[3] === 1 && throws[4] === 1 && throws[5] === 1) {
        return true;
    } else if (throws[2] === 1 && throws[3] === 1 && throws[4] === 1 && throws[5] === 1 && throws[6] === 1) {
        return true;
    } else {
        return false;
    }
}

function checkTopScore(throws, carre) {
    if (carre === false) {
        return false;
    } else if (throws[1] === 5 || throws[2] === 5 || throws[3] === 5 || throws[4] === 5 || throws[5] === 5 || throws[6] === 5) {
        return true;
    } else {
        return false;
    }
}

function fillInScoreBlockPart2(game, throws, p1Score) {
    let totalP2 = 0;
    let throwTotal = calculateThrowTotal(throws);
    let threeofAKind = checkThreeOfAKind(throws);
    if (threeofAKind) {
        gameTable[game][indexTable['three of a kind']].innerHTML = throwTotal;
        totalP2 += throwTotal;
    } else {
        gameTable[game][indexTable['three of a kind']].innerHTML = 0;
    }
    let carre = checkCarre(throws, threeofAKind);
    if (carre) {
        gameTable[game][indexTable['carre']].innerHTML = throwTotal;
        totalP2 += throwTotal;
    } else {
        gameTable[game][indexTable['carre']].innerHTML = 0;
    }
    let fullHouse = checkFullHouse(throws, threeofAKind);
    if (fullHouse) {
        gameTable[game][indexTable['full house']].innerHTML = 25;
        totalP2 += 25;
    } else {
        gameTable[game][indexTable['full house']].innerHTML = 0;
    }
    let smallStraight = checkSmallStraight(throws);
    if (smallStraight) {
        gameTable[game][indexTable['small straight']].innerHTML = 30;
        totalP2 += 30;
    } else {
        gameTable[game][indexTable['small straight']].innerHTML = 0;
    }
    let LargeStraight = checkLargeStraight(throws, smallStraight);
    if (LargeStraight) {
        gameTable[game][indexTable['large straight']].innerHTML = 40;
        totalP2 += 40;
    } else {
        gameTable[game][indexTable['large straight']].innerHTML = 0;
    }
    let topScore = checkTopScore(throws, carre);
    if (topScore) {
        gameTable[game][indexTable['topscore']].innerHTML = 50;
        totalP2 += 50;
    } else {
        gameTable[game][indexTable['topscore']].innerHTML = 0;
    }
    gameTable[game][indexTable['chance']].innerHTML = throwTotal;
    totalP2 += throwTotal;
    gameTable[game][indexTable['total p2']].innerHTML = totalP2;
    gameTable[game][indexTable['total p1 bottom']].innerHTML = p1Score;
    gameTable[game][indexTable['total total']].innerHTML = totalP2 + p1Score;
}


function fillInScoreBlock() {
    let game = checkGame();
    let throws = simulateThrows();
    let p1Score = fillInScoreBlockPart1(game, throws);
    fillInScoreBlockPart2(game, throws, p1Score);

}

button.addEventListener('click', fillInScoreBlock);
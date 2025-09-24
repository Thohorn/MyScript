const startButton = document.getElementById("start-game");
const startGameDiv = document.getElementById("start-game-div");

const otherButtons = document.getElementById("buttons-game");
otherButtons.style.display = "none"
const hitButton = document.getElementById("hit");
const passButton = document.getElementById("pass");

const elementDealerCards = document.getElementById("dealer-cards");
const elementPlayerCards = document.getElementById("player-cards");

const dealerPoints = document.getElementById("dealer-points");
const playerPoints = document.getElementById("player-points");

const endGameMessage = document.getElementById("end-game-message");

class Card {
    constructor(name, value, back = false) {
        this._name = name;
        this._value = value;
        this._back = back;
        this._path = `images/${name}.png`;
        this._element = this.cardElement();
    }

    set value(value) {
        this._value = value;
    }

    get value() {
        return this._value;
    }

    /**
     * @param {boolean} value
     */
    set back(value) {
        this._back = value;
        this.updateElementSource();
    }

    get path() {
        return this._path;
    }

    get element() {
        return this._element;
    }

    cardElement() {
        let cardElement = document.createElement("img");
        cardElement.className = "card";
        cardElement.src = this._back ? "images/card-back.png" : this._path;
        return cardElement;
    }

    updateElementSource() {
        this._element.src = this._back ? "images/card-back.png" : this._path;
    }
}

class Deck {
    constructor() {
        this._deck = this.createDeck();
    }

    get deck() {
        return this._deck;
    }

    createDeck() {
        let cardNumbers = [2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K", "A"];
        let cardSuits = ["Spades", "Hearts", "Clovers", "Diamonds"];

        let deck = [];

        for (let suit = 0; suit < cardSuits.length; suit++) {
            for (let number = 0; number < cardNumbers.length; number++) {
                if (["J", "Q", "K"].includes(cardNumbers[number])) {
                    deck.push(new Card(`${cardNumbers[number]}-${cardSuits[suit]}`, 10))
                } else if (cardNumbers[number] === "A") {
                    deck.push(new Card(`${cardNumbers[number]}-${cardSuits[suit]}`, 11))
                } else {
                    deck.push(new Card(`${cardNumbers[number]}-${cardSuits[suit]}`, cardNumbers[number]))
                }
            }
        }
        return deck;
    }

    shuffleDeck() {
        for (let i = 0; i < this._deck.length; i++) {
            let newRandomPos = Math.floor(Math.random() * this._deck.length);
            let temp = this._deck[i];
            this._deck[i] = this._deck[newRandomPos];
            this._deck[newRandomPos] = temp;
        }
    }

    drawCard() {
        return this._deck.pop();
    }

}

const myDeck = new Deck();

const playerCards = [];
const dealerCards = [];

const totalCardsDrawn = playerCards.length + dealerCards.length;

function clearHands() {
    playerCards.length = 0;
    dealerCards.length = 0;
}

function changeButtons() {
    startGameDiv.style.display != "none" ? startGameDiv.style.display = "none" : startGameDiv.style.display = "block";
    otherButtons.style.display != "none" ? otherButtons.style.display = "none" : otherButtons.style.display = "block";
}

function clearScreen() {
    elementPlayerCards.innerHTML = "";
    elementDealerCards.innerHTML = "";
    playerPoints.innerHTML = "";
    dealerPoints.innerHTML = "";
    endGameMessage.innerHTML = "";
}

function drawCards(target, initial = false) {
    if (initial) {
        dealerCards.push(myDeck.drawCard());
        dealerCards.push(myDeck.drawCard());

        playerCards.push(myDeck.drawCard());
        playerCards.push(myDeck.drawCard());
    } else if (target === "player") {
        playerCards.push(myDeck.drawCard());
    } else if (target === "dealer") {
        dealerCards.push(myDeck.drawCard());
    }
}

function showCards(target, initial = false) {
    if (initial) {
        dealerCards[0].back = true;
        for (let i = 0; i < 2; i++) {
            elementDealerCards.appendChild(dealerCards[i].element);
            elementPlayerCards.appendChild(playerCards[i].element);
        }
    } else if (target === "player") {
        elementPlayerCards.appendChild(playerCards[playerCards.length - 1].element);
    } else if (target === "dealer") {
        dealerCards[0].back = false;
        elementDealerCards.appendChild(dealerCards[dealerCards.length - 1].element);
    }
}

function checkAceValue(hand) {
    let value = 0;
    let aces = [];
    for (let i = 0; i < hand.length; i++) {
        if (hand[i].value === 11 || hand[i].value === 1) {
            aces.push(hand[i]);
        }
        value += hand[i].value;
    }
    if (value > 21) {
        let newValue = value;
        for (let i = 0; i < aces.length; i++) {
            newValue -= (aces[i].value - 1);
            if (newValue < 21) {
                aces[i].value = 1;
                return;
            }
        }
    }
}

function youLose() {
    endGameMessage.innerHTML = "Je hebt verloren";
    endGameMessage.style.color = "red";
    changeButtons();
}

function youWon() {
    endGameMessage.innerHTML = "Je hebt Gewonnen!";
    endGameMessage.style.color = "green";
    changeButtons();
}

function checkDealerBlackJack() {
    showCards("dealer");
    updatePoints("dealer");
    if (dealerCards[0].value + dealerCards[1].value === 21) {
        youLose();
    } else {
        youWon();
    }
}

function checkWinner() {
    let playerScore = 0;
    let dealerScore = 0;
    for (let i = 0; i < playerCards.length; i++) {
        playerScore += playerCards[i].value;
    }
    for (let i = 0; i < dealerCards.length; i++) {
        dealerScore += dealerCards[i].value;
    }

    if (dealerScore > 21) {
        youWon();
    } else if (playerScore > dealerScore) {
        youWon();
    } else {
        youLose();
    }
}

function updatePoints(target, initial = false) {
    if (initial) {
        dealerPoints.innerHTML = dealerCards[1].value;
    }
    if (target === "player") {
        playerPoints.innerHTML = "";
        let playerScore = 0;
        for (let i = 0; i < playerCards.length; i++) {
            if (playerCards[i].value === 11 || playerCards[i].value === 1) {
                checkAceValue(playerCards);
            }
            playerScore += playerCards[i].value;
        }
        playerPoints.innerHTML = playerScore;
        if (playerScore > 21) {
            youLose();
        } else if (playerScore === 21) {
            checkDealerBlackJack();
        }
    } else if (target === "dealer") {
        let dealerScore = 0;
        for (let i = 0; i < dealerCards.length; i++) {
            if (dealerCards[i].value === 11 || dealerCards[i].value === 1) {
                checkAceValue(dealerCards);
            }
            dealerScore += dealerCards[i].value;
        }
        dealerPoints.innerHTML = dealerScore;
        return dealerScore;
    }
}

function gameSetup() {
    myDeck.createDeck();
    myDeck.shuffleDeck();
    clearScreen();
    clearHands();
    changeButtons();
    drawCards("player", true);
    showCards("player", true);
    updatePoints("player", true);
}

function hit() {
    drawCards("player");
    showCards("player");
    updatePoints("player");
}

function pass() {
    showCards("dealer");
    let dealerScore = updatePoints("dealer");
    let playerScore = updatePoints("player");
    if (playerScore === 16 && dealerScore === 16) {
        checkWinner();
    } else if (dealerScore <= 16) {
        drawCards("dealer");
        pass();
    } else {
        checkWinner();
    }

}

startButton.addEventListener('click', gameSetup);

hitButton.addEventListener('click', hit);
passButton.addEventListener('click', pass);
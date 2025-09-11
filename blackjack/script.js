const button = document.getElementById("hit");

class Card {
    constructor(name, value) {
        this._name = name;
        this._value = value;
        this._path = `images/${name}.png`
    }

    set value(value) {
        this._value = value;
    }

    get value() {
        return this._value;
    }

    get path() {
        return this._path;
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

}

const myDeck = new Deck();

const playerCards = [];
const dealerCards = [];


// button.addEventListener('click', createDeck);
<script setup>
    import { computed } from 'vue';

    const dice = defineModel();

    const sumSingleValue = (singleValue) => {
        let ones = dice.value.filter((element) => {return element === singleValue})
        return ones.reduce((sum, num) => sum + num, 0);
    }

    const sumOnes = computed(() => sumSingleValue(1));
    const sumTwos = computed(() => sumSingleValue(2));
    const sumThrees = computed(() => sumSingleValue(3));
    const sumFours = computed(() => sumSingleValue(4));
    const sumFives = computed(() => sumSingleValue(5));
    const sumSixes = computed(() => sumSingleValue(6));

    const sumOfDice = computed(() => dice.value.reduce((sum, num) => sum + num, 0));
    const bonus = computed(() => sumOfDice.value > 63 ? 35 : 0);
    const p1Total = computed(() => sumOfDice.value + bonus.value);

    const checkXOfAKind = (targetCount, sortedDice = dice.value.sort((a, b) => a - b)) => {
        if(dice.value[0] === 0){
            return false;
        }
        let count = 1;
        for (let i = 0; i < sortedDice.length; i++){
            if (i+1 !== sortedDice.length){
                if(sortedDice[i] === sortedDice[i+1]){
                    count++;
                    if (count === targetCount){
                        return true;
                    }
                } else {
                    count = 1;
                }
            }
        }
        return false;        
    }

    const checkFullHouse = () => {
        let sortedDice = dice.value.sort((a, b) => a - b);
        let threedice = sortedDice.slice(2);
        let twodice = sortedDice.slice(0, 2);
        if (checkXOfAKind(3, threedice) && checkXOfAKind(2, twodice)){
            return true;
        }
        return false;
            
    }

    const threeOfAKind = computed(() => checkXOfAKind(3) ? sumOfDice.value : 0);
    const carre = computed(() => checkXOfAKind(4) ? sumOfDice.value : 0);
    const Topscore = computed(() => checkXOfAKind(5) ? 50 : 0);

    const fullHouse = computed(() => checkFullHouse() ? 25: 0);



</script>

<template>
    <table id="score">
        <thead>
            <tr>
                <th><strong>Deel 1</strong></th>
                <th>Punten telling</th>
                <th>
                    <input type="radio" id="first-game-radio" class="game" name="game" value="first-game" checked>
                    <label for="first-game-radio">1e spel</label>
                </th>
                <th>
                    <input type="radio" id="second-game-radio" class="game" name="game" value="second-game">
                    <label for="second-game-radio">2e spel</label>
                </th>
                <th>
                    <input type="radio" id="third-game-radio" class="game" name="game" value="third-game">
                    <label for="third-game-radio">3e spel</label>
                </th>
                <th>
                    <input type="radio" id="fourth-game-radio" class="game" name="game" value="fourth-game">
                    <label for="fourth-game-radio">4e spel</label>
                </th>
                <th>
                    <input type="radio" id="fifth-game-radio" class="game" name="game" value="fifth-game">
                    <label for="fifth-game-radio">5e spel</label>
                </th>
                <th>
                    <input type="radio" id="sixth-game-radio" class="game" name="game" value="sixth-game">
                    <label for="sixth-game-radio">6e spel</label>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="line" colspan="8"></td>
            </tr>
            <tr>
                <td>Enen</td>
                <td>Tel alle Enen</td>
                <td class="first-game">{{ sumOnes }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Tweeën</td>
                <td>Tel alle Tweeën</td>
                <td class="first-game">{{ sumTwos }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Drieën</td>
                <td>Tel alle Drieën</td>
                <td class="first-game">{{ sumThrees }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Vieren</td>
                <td>Tel alle Vieren</td>
                <td class="first-game">{{ sumFours }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Vijven</td>
                <td>Tel alle Vijven</td>
                <td class="first-game">{{ sumFives }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Zessen</td>
                <td>Tel alle Zessen</td>
                <td class="first-game">{{ sumSixes }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Totaal aantal punten</td>
                <td>-></td>
                <td class="first-game">{{ sumOfDice }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Bonus</td>
                <td>35 punten</td>
                <td class="first-game">{{ bonus }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Totaal van de bovenste helft</td>
                <td>-></td>
                <td class="first-game">{{ p1Total }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td id="top-bottom-divider" colspan="8"><strong>Deel 2</strong></td>
            </tr>
            <tr>
                <td class="line" colspan="8"></td>
            </tr>
            <tr>
                <td>Three of a kind</td>
                <td>Totaal v.d. 5 stenen</td>
                <td class="first-game">{{ threeOfAKind }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Carré</td>
                <td>Totaal v.d. 5 stenen</td>
                <td class="first-game">{{ carre }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Full House</td>
                <td>25 punten</td>
                <td class="first-game">{{ fullHouse }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Kleine straat</td>
                <td>30 punten</td>
                <td class="first-game">0</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Grote straat</td>
                <td>40 punten</td>
                <td class="first-game">0</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Topscore</td>
                <td>50 punten</td>
                <td class="first-game">{{ Topscore }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Chance</td>
                <td>Totaal v.d. 5 stenen</td>
                <td class="first-game">{{ sumOfDice }}</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Totaal Onderste helft</td>
                <td>-></td>
                <td class="first-game">0</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Totaal van de bovenste helft</td>
                <td>-></td>
                <td class="first-game">0</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
            <tr>
                <td>Totaal alles</td>
                <td>-></td>
                <td class="first-game">0</td>
                <td class="second-game">0</td>
                <td class="third-game">0</td>
                <td class="fourth-game">0</td>
                <td class="fifth-game">0</td>
                <td class="sixth-game">0</td>
            </tr>
        </tbody>
    </table>

</template>

<style scoped>
    #top-bottom-divider {
        height: 80px;
        vertical-align: bottom;
    }

    .line {
        border-bottom: 2px solid;
    }
</style>

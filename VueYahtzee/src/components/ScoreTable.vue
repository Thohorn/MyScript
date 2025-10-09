<script setup>
    import { computed } from 'vue';
    
    const props = defineProps(['dice'])

    const dice = props.dice;

    const countThrows = computed(() => {
        let mycountThrows = {
                        1: 0,
                        2: 0,
                        3: 0,
                        4: 0,
                        5: 0,
                        6: 0,
                    };
        for (let value in dice){
            mycountThrows[dice[value]]++;
        }
        return mycountThrows;
    });

    const sumSingleValue = (singleValue) => {
        let ones = dice.filter((element) => {return element === singleValue});
        return ones.reduce((sum, num) => sum + num, 0);
    }

    const sumOnes = computed(() => sumSingleValue(1));
    const sumTwos = computed(() => sumSingleValue(2));
    const sumThrees = computed(() => sumSingleValue(3));
    const sumFours = computed(() => sumSingleValue(4));
    const sumFives = computed(() => sumSingleValue(5));
    const sumSixes = computed(() => sumSingleValue(6));


    const sumOfDice = computed(() => dice.reduce((sum, num) => sum + num, 0));
    const bonus = computed(() => sumOfDice.value > 63 ? 35 : 0);
    const p1Total = computed(() => sumOfDice.value + bonus.value);

    const checkXOfAKind = (targetCount) => {
        for (let value in countThrows.value){
            if(countThrows.value[value] >= targetCount){
                return true;
            }
        }
        return false;        
    }

    const checkFullHouse = () => {
        for (let singlethrow in countThrows.value) {
        if (countThrows.value[singlethrow] === 2 && checkXOfAKind(3)) {
            return true;
        }
        }
        return false;
    }

    const checkStraight = (straightLength) => {
        let counter = 0;
        for (let singlethrow in countThrows.value) {
            if (countThrows.value[singlethrow] >= 1) {
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

    const threeOfAKind = computed(() => checkXOfAKind(3) ? sumOfDice.value : 0);
    const fourOfAKind = computed(() => checkXOfAKind(4) ? sumOfDice.value : 0);
    const topScore = computed(() => checkXOfAKind(5) ? 50 : 0);

    const fullHouse = computed(() => checkFullHouse() ? 25: 0);
    const smallStraight = computed(() => checkStraight(4) ? 30 : 0);
    const largeStraight = computed(() => checkStraight(5) ? 40 : 0);
    const p2Total = computed(() =>  threeOfAKind.value + fourOfAKind.value + topScore.value + 
                                    fullHouse.value + smallStraight.value + largeStraight.value + 
                                    sumOfDice.value);

    const gameTotal = computed(() => p2Total.value + p1Total.value);


</script>

<template>
    <table id="score">
        <thead>
            <tr>
                <th><strong>Deel 1</strong></th>
                <th>Punten telling</th>
                <th>
                    1e spel
                </th>
                <th>
                    2e spel
                </th>
                <th>
                    3e spel
                </th>
                <th>
                    4e spel
                </th>
                <th>
                    5e spel
                </th>
                <th>
                    6e spel
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
                <td>{{ sumOnes }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Tweeën</td>
                <td>Tel alle Tweeën</td>
                <td>{{ sumTwos }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Drieën</td>
                <td>Tel alle Drieën</td>
                <td>{{ sumThrees }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Vieren</td>
                <td>Tel alle Vieren</td>
                <td>{{ sumFours }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Vijven</td>
                <td>Tel alle Vijven</td>
                <td>{{ sumFives }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Zessen</td>
                <td>Tel alle Zessen</td>
                <td>{{ sumSixes }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Totaal aantal punten</td>
                <td>-></td>
                <td>{{ sumOfDice }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Bonus</td>
                <td>35 punten</td>
                <td>{{ bonus }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Totaal van de bovenste helft</td>
                <td>-></td>
                <td>{{ p1Total }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
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
                <td>{{ threeOfAKind }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Carré</td>
                <td>Totaal v.d. 5 stenen</td>
                <td>{{ fourOfAKind }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Full House</td>
                <td>25 punten</td>
                <td>{{ fullHouse }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Kleine straat</td>
                <td>30 punten</td>
                <td>{{ smallStraight }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Grote straat</td>
                <td>40 punten</td>
                <td>{{ largeStraight }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>topScore</td>
                <td>50 punten</td>
                <td>{{ topScore }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Chance</td>
                <td>Totaal v.d. 5 stenen</td>
                <td>{{ sumOfDice }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Totaal Onderste helft</td>
                <td>-></td>
                <td>{{ p2Total }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Totaal van de bovenste helft</td>
                <td>-></td>
                <td>{{ p1Total }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Totaal alles</td>
                <td>-></td>
                <td>{{ gameTotal }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
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
    
    th {
        min-width: 60px;
    }
</style>

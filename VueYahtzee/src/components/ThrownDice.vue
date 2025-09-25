<script setup>
    const dice = defineModel();

    const rollDice = () => {
        for (let i = 0; i < 5; i++) {
            let diceRoll = Math.floor(Math.random() * 6) + 1;
            dice.value[i] = diceRoll;
        };
    }

</script>

<template>
    <table>
        <tbody>
            <tr>
                <td class="throw-result">{{ dice[0] }}</td>
                <td class="throw-result">{{ dice[1] }}</td>
                <td class="throw-result">{{ dice[2] }}</td>
                <td class="throw-result">{{ dice[3] }}</td>
                <td class="throw-result">{{ dice[4] }}</td>
            </tr>
        </tbody>
    </table>

    <button @click="rollDice">Gooien!</button>

</template>

<style scoped>
    .throw-result {
        width: 80px;
        border: 2px solid black;
        text-align: center;
    }
</style>

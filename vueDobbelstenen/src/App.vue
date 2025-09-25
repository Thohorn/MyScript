<script setup>
  import { ref } from 'vue';

  const count = ref({ 1: 0,
                      2: 0,
                      3: 0,
                      4: 0,
                      5: 0,
                      6: 0,
                  });

  const rollDice = () => {
    resetCount();
    for (let i = 0; i < 8; i++) {
        let diceRoll = Math.floor(Math.random() * 6) + 1;
        count.value[diceRoll] ++;
    }
  }

  const resetCount = () => {
    for (let valueCount in count.value) {
      count.value[valueCount] = 0;
    }
  }

</script>

<template>
  <button @click="rollDice">Gooi!</button>

  <table>
      <thead>
          <tr>
              <th>Getal</th>
              <th>Aantal</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>1</td>
              <td>{{ count[1] }}</td>
          </tr>
          <tr>
              <td>2</td>
              <td>{{ count[2] }}</td>
          </tr>
          <tr>
              <td>3</td>
              <td>{{ count[3] }}</td>
          </tr>
          <tr>
              <td>4</td>
              <td>{{ count[4] }}</td>
          </tr>
          <tr>
              <td>5</td>
              <td>{{ count[5] }}</td>
          </tr>
          <tr>
              <td>6</td>
              <td>{{ count[6] }}</td>
          </tr>
      </tbody>
  </table>

</template>

<style scoped>

</style>

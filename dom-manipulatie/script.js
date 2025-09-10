const myName = "Meint";
const colours = ['green', 'blue', 'purple', 'pink', 'black']

const button = document.getElementById('click-me');
const h1Name = document.getElementById('h1-name');

h1Name.style.display = 'none';

function updateH1Name() {
    if (h1Name.style.display === 'none'){
        h1Name.style.display = 'block';
        let colour = colours[Math.floor(Math.random() * 5)];
        h1Name.style.color = colour;
        h1Name.innerHTML = myName;
    }else {
        h1Name.style.display = 'none';
    }
}

button.addEventListener('click', updateH1Name);
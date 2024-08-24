function getNumero1() {
    return parseFloat(document.getElementById("numero1").value);
}

function getNumero2() {
    return parseFloat(document.getElementById("numero2").value);
}

function soma() {
    var resultado = getNumero1() + getNumero2();
    informaResultado(resultado);
}
function menos() {
    var resultado = getNumero1() - getNumero2();
    informaResultado(resultado)
}
function mult() {
    var resultado = getNumero1() * getNumero2();
    informaResultado(resultado)
}
function div() {
    var resultado = getNumero1() / getNumero2();
    informaResultado(resultado)
}

function informaResultado(resultado) {
    var elResultado = document.getElementById("resultado");
    elResultado.value = resultado;
    if (resultado < 0) {
        elResultado.style.backgroundColor = "red";
    } else if (resultado > 0) {
        elResultado.style.backgroundColor = "green";
    } else {
        elResultado.style.backgroundColor = "gray";
    }
}

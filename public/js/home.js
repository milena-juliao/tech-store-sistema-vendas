const nomeEmpresa = "TECH STORE";
const nomeEmpresaElemento = document.getElementById("nome");
const btn = document.getElementById("btn");

let index = 0;
let isLooping = true;

function loopTexto() {
    if (isLooping) {
        nomeEmpresaElemento.textContent.length == nomeEmpresa.length ? nomeEmpresaElemento.textContent = "" : nomeEmpresaElemento.textContent += nomeEmpresa[index];
        index = index == nomeEmpresa.length ? index = 0 : (index + 1) % nomeEmpresa.length;
        setTimeout(() => {
            loopTexto();
        }, 200);
    }
    console.log(index);
}

loopTexto()

nomeEmpresaElemento.addEventListener("click", () => {
    isLooping = false;
    nomeEmpresaElemento.textContent = "";
    btn.style.display = "block";
});

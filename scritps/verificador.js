const btnLogin = document.getElementById('btn-login')
const userLogin = document.getElementById('user')
const userPass = document.getElementById('key')
let emailValido, senhaValida

userLogin.addEventListener('keyup', function () {
    emailValido = validaEmail(this.value)
    verificaformulario()
})

userPass.addEventListener('keyup', function () {
    senhaValida = validaSenha(this.value)
    verificaformulario()
})

function validaEmail(email) {
    let emailInserido = /\S+@\S+\.\S+/
    return emailInserido.test(email)
}

function validaSenha(senha) {
    let senhaInserida = senha.length
    if (senhaInserida >= 8) return true
    else return false
}


function verificaformulario() {
    if ((senhaValida == true) && (emailValido == true)) {
        btnLogin.removeAttribute("disabled")
    } else {
        btnLogin.setAttribute("disabled", "")
    }
}
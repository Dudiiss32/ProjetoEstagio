document.addEventListener('DOMContentLoaded', function () {
    const inputValor = document.getElementById('valor');
    const inputTelefone = document.getElementById('telefone');
    const inputIndicacaoTelefone = document.getElementById('indicacao_telefone');

    if (inputValor) {
        IMask(inputValor, {
            mask: 'R$ num',
            blocks: {
                num: {
                    mask: Number,
                    thousandsSeparator: '.',
                    radix: ',',
                    scale: 2,
                    padFractionalZeros: true
                }
            }
        });
    }
    if (inputTelefone) {
        IMask(inputTelefone, {
            mask: [
                { mask: '(00) 0000-0000' },
                { mask: '(00) 00000-0000' }
            ]
        });
    }
    if (inputIndicacaoTelefone) {
        IMask(inputIndicacaoTelefone, {
            mask: [
                { mask: '(00) 0000-0000' },
                { mask: '(00) 00000-0000' }
            ]
        });
    }
});
document.getElementById('menu').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
    document.body.classList.toggle('sidebar-hidden');
});
const wrapper = document.getElementById('indicacoes-wrapper')
const add_indicacao = document.getElementById('add-indicacao')
let count = 1

add_indicacao.addEventListener('click', function(){

        if(count>=10){
            alert('Você pode adicionar no máximo 10 indicações')
            return;
        }
        let divNome = document.createElement('div')
        divNome.classList = 'col-md-6'
        divNome.innerHTML = `
            <label class="form-label">Nome da indicação:</label>
            <input type="text" name="indicacoes${count}[nome]" class="form-control">
        `

        let divTelefone = document.createElement('div')
        divTelefone.classList = 'col-md-6'
        divTelefone.innerHTML = `
            <label class="form-label">Telefone da indicação:</label>
            <input type="text" name="indicacoes${count}[telefone]" class="form-control" id="indicacao_telefone">
        `
        wrapper.appendChild(divNome)
        wrapper.appendChild(divTelefone)

        count++

})
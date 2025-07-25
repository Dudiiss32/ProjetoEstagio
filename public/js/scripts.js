document.addEventListener('DOMContentLoaded', function () {
    const inputValor = document.getElementById('valor');
    const inputTelefone = document.getElementById('telefone');
    const inputsTelefone =  document.getElementsByClassName('telefone');

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
    if (inputsTelefone.length > 0) {
        // Converter a coleção HTMLCollection para um array
        Array.from(inputsTelefone).forEach(input => {
            IMask(input, {
                mask: [
                    { mask: '(00) 0000-0000' },
                    { mask: '(00) 00000-0000' }
                ]
            });
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

    const menu = document.getElementById('menu');
    if (menu) {
        menu.addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.classList.toggle('hidden');
                document.body.classList.toggle('sidebar-hidden');
            }
        });
    }

    const wrapper = document.getElementById('indicacoes-wrapper');
    const add_indicacao = document.getElementById('add-indicacao');
    let count = 1;

    if (add_indicacao && wrapper) {
        add_indicacao.addEventListener('click', function () {
            if (count >= 10) {
                alert('Você pode adicionar no máximo 10 indicações');
                return;
            }

            let divNome = document.createElement('div');
            divNome.classList = 'col-md-6';
            divNome.innerHTML = `
                <label class="form-label">Nome da indicação:</label>
                <input type="text" name="indicacoes[${count}][nome]" class="form-control">
            `;

            let divTelefone = document.createElement('div');
            divTelefone.classList = 'col-md-6';
            divTelefone.innerHTML = `
                <label class="form-label">Telefone da indicação:</label>
                <input type="text" name="indicacoes[${count}][telefone]" class="form-control" id="indicacao_telefone${count}">
            `;

            wrapper.appendChild(divNome);
            wrapper.appendChild(divTelefone);

            // Aplicar máscara no novo telefone
            const novoTelefone = document.getElementById(`indicacao_telefone${count}`);
            if (novoTelefone) {
                IMask(novoTelefone, {
                    mask: [
                        { mask: '(00) 0000-0000' },
                        { mask: '(00) 00000-0000' }
                    ]
                });
            }

            count++;
        });
    }
});

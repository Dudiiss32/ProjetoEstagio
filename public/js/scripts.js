document.addEventListener('DOMContentLoaded', function () {
    const inputValor = document.getElementById('valor');
    const inputTelefone = document.getElementById('telefone');

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
});
document.getElementById('menu').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
    document.body.classList.toggle('sidebar-hidden');
});

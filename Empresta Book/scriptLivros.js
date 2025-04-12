document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('toggle-list');
    const autorList = document.getElementById('autor-list');
    const autorInput = document.getElementById('autor-input');
    const autorItems = document.querySelectorAll('.autor-item');
    const selectedAutores = new Set();

   
    toggleButton.addEventListener('click', function () {
        if (autorList.style.display === 'none') {
            autorList.style.display = 'block';
        } else {
            autorList.style.display = 'none';
        }
    });

   
    autorItems.forEach(item => {
        item.addEventListener('click', function(){
            const id = this.dataset.id;
            const nome = this.dataset.nome;

          
            if (selectedAutores.has(id)) {
                selectedAutores.delete(id);
                this.classList.remove('active');
            } else {
                selectedAutores.add(id);
                this.classList.add('active');
            }

          
            autorInput.value = Array.from(selectedAutores).map(id => {
                const item = document.querySelector(`.autor-item[data-id="${id}"]`);
                return item.dataset.nome;
            }).join(', ');
        });
    });
});


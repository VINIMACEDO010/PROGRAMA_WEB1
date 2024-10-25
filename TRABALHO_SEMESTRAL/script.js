document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    let errorMessage = document.getElementById('error-message');
    
    // Verifique se a mensagem de erro está no DOM, caso contrário, crie-a
    if (!errorMessage) {
        errorMessage = document.createElement('p');
        errorMessage.id = 'error-message';
        errorMessage.textContent = "Por favor, responda todas as perguntas antes de enviar.";
        errorMessage.style.color = 'red';
        errorMessage.style.marginTop = '10px';
        errorMessage.style.fontWeight = 'bold';
        errorMessage.style.display = 'none'; // Ocultar inicialmente
        form.insertAdjacentElement('beforebegin', errorMessage);
    }

    function validateForm() {
        const questions = document.querySelectorAll('.question-block');
        let allAnswered = true;

        questions.forEach(question => {
            const checkedOption = question.querySelector('input[type="radio"]:checked');
            if (!checkedOption) {
                allAnswered = false;
                question.style.border = '1px solid red'; // Destacar perguntas não respondidas
            } else {
                question.style.border = 'none'; // Remover o destaque se já foi respondido
            }
        });

        return allAnswered;
    }

    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Impede o envio do formulário
            errorMessage.style.display = 'block'; // Mostrar mensagem de erro
            errorMessage.scrollIntoView({ behavior: 'smooth' }); // Focar na mensagem de erro
        } else {
            errorMessage.style.display = 'none'; // Ocultar mensagem de erro se todas as perguntas foram respondidas
        }
    });
});
